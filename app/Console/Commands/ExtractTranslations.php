<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExtractTranslations extends Command {
    protected $signature = 'translations:extract';
    protected $description = 'Extract translation strings (__(), _()) and save to a txt file as JSON';

    public function handle() {
        $resourcePath = base_path('resources');
        $controllerPath = app_path('Http/Controllers');

        $paths = [$resourcePath, $controllerPath];

        $allFiles = collect();

        foreach ($paths as $path) {
            if (File::exists($path)) {
                $allFiles = $allFiles->merge(File::allFiles($path));
            } else {
                $this->warn("⚠️ Directory does not exist: $path");
            }
        }

        $strings = [];

        foreach ($allFiles as $file) {
            $content = File::get($file->getRealPath());
            $filePath = $file->getRelativePathname();

            // 1. Match literal strings (your original regex)
            preg_match_all('/\b(?:__|_)\(\s*[\'"](.+?)[\'"]\s*\)/', $content, $matches);
            foreach ($matches[1] as $match) {
                $strings[$match] = '';
            }

            // 2. Find and warn about dynamic/variable-based translations
            // This regex looks for __($variable) or __(function_call())
            preg_match_all('/\b(?:__|_)\(\s*([^\'"\s].*?)\s*\)/', $content, $dynamicMatches, PREG_OFFSET_CAPTURE);

            foreach ($dynamicMatches[1] as $match) {
                // We check if the match starts with a $ or contains () to be more certain it's dynamic
                $potentialVariable = $match[0];
                if (str_starts_with(trim($potentialVariable), '$') || str_contains($potentialVariable, '(')) {
                    // Calculate line number
                    $lineNumber = substr_count(substr($content, 0, $match[1]), "\n") + 1;
                    $this->warn("⚠️ Dynamic translation key found in {$filePath} on line {$lineNumber}: __({$potentialVariable})");
                }
            }
        }

        if (empty($strings)) {
            $this->info('✅ No translation strings found.');
            return 0;
        }

        // Write to a JSON text file
        $jsonContent = json_encode($strings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $outputFile = base_path('translations_output.txt');

        File::put($outputFile, $jsonContent);

        $this->info("✅ Extracted " . count($strings) . " strings.");
        $this->info("📄 Saved to: $outputFile");

        return 0;
    }
}
