<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http; // Use Laravel's HTTP Facade (wrapper for Guzzle)
use Throwable;

class TranslateStrings extends Command {
    // Usage: php artisan translations:translate de
    protected $signature = 'translations:translate {lang : The ISO 639-1 language code to translate to (e.g., "es", "de")}';
    protected $description = 'Translate the extracted JSON file to a specified language using an LLM.';

    public function handle() {
        $inputFile = base_path('translations_output.txt');
        if (!File::exists($inputFile)) {
            $this->error("Input file not found: {$inputFile}");
            $this->info("Please run 'php artisan translations:extract' first.");
            return 1;
        }

        // $apiKey = config('services.openrouter.key'); // A safer way to get the key
        $apiKey = "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"; // A safer way to get the key

        if (!$apiKey) {
            $this->error('OpenRouter API key not found. Please set OPENROUTER_API_KEY in your .env file.');
            $this->info("And add it to config/services.php: 'openrouter' => ['key' => env('OPENROUTER_API_KEY')]");
            return 1;
        }

        // Get the target language from the command argument
        $targetLang = $this->argument('lang');
        $this->info("🌐 Translating strings to '{$targetLang}'...");

        $sourceJson = File::get($inputFile);
        $sourceData = json_decode($sourceJson, true);

        if (empty($sourceData)) {
            $this->info("✅ No strings to translate.");
            return 0;
        }

        // LLM Prompt Engineering is key!
        // We give it a clear instruction and the JSON to translate.
        $prompt = "You are an expert translator. Translate the JSON values from English to the language with code '{$targetLang}'.
        Respond ONLY with the translated JSON object. Do not include any explanations, markdown, or any text other than the valid JSON.
        The keys should remain unchanged. The values should be the translation.

        Example for 'fr':
        Input:
        {
            \"Hello World\": \"\",
            \"Go to Dashboard\": \"\"
        }
        Output:
        {
            \"Hello World\": \"Bonjour le monde\",
            \"Go to Dashboard\": \"Aller au tableau de bord\"
        }

        Now, translate this JSON:
        {$sourceJson}";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                // Choose a fast, free model. Check OpenRouter for current free models.
                'model' => 'mistralai/mistral-7b-instruct:free',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if (!$response->successful()) {
                $this->error("API request failed: " . $response->body());
                return 1;
            }

            // The LLM's response is a JSON string within the API's JSON response.
            $llmContent = $response->json('choices.0.message.content');

            // Sometimes the LLM might still wrap the JSON in ```json ... ```
            $llmContent = trim(str_replace(['```json', '```'], '', $llmContent));

            $translatedData = json_decode($llmContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error("Failed to decode the LLM's JSON response. Error: " . json_last_error_msg());
                $this->line("LLM Raw Response:\n" . $llmContent);
                return 1;
            }

            // Save to Laravel's standard language file structure
            $outputDir = base_path("resources/lang");
            $outputFile = "{$outputDir}/{$targetLang}.json";

            if (!File::isDirectory($outputDir)) {
                File::makeDirectory($outputDir);
            }

            File::put($outputFile, json_encode($translatedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            $this->info("✅ Translation complete!");
            $this->info("📄 Saved to: {$outputFile}");

        } catch (Throwable $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
