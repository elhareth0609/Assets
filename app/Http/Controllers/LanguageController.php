<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller {
    use ApiResponder;

    public function create(Request $request) {
        try {
            $word = $request->input('word');
            $translations = $request->input('translations');

            foreach ($translations as $lang => $translation) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (File::exists($jsonPath)) {
                    $data = json_decode(File::get($jsonPath), true);
                    if (isset($data[$word])) {
                        return $this->error(__('Word already exists.'));
                    }
                    $data[$word] = $translation;
                    File::put($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
            }
            return $this->success(null, 'تم الإنشاء بنجاح');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function get($word) {
        try {

            $languages = [];
            foreach (config('language') as $locale => $language) {
                $languages[] = $locale;
            }

            $translations = [];

            foreach ($languages as $lang) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (File::exists($jsonPath)) {
                    $data = json_decode(File::get($jsonPath), true);
                    if (isset($data[$word])) {
                        $translations[$lang] = $data[$word];
                    }
                }
            }

            return $this->success([$word,$translations], __('Getting Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(Request $request, $word){
        try {
            $translations = $request->input('translations');

            foreach ($translations as $lang => $translation) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (File::exists($jsonPath)) {
                    $data = json_decode(File::get($jsonPath), true);
                    $data[$word] = $translation;
                    File::put($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
            }

            return $this->success(null, 'تم التحديث بنجاح');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function destroy($word) {
        try {
            $languages = [];
            foreach (config('language') as $locale => $language) {
                $languages[] = $locale;
            }

            foreach ($languages as $lang) {
                $jsonPath = resource_path("lang/{$lang}.json");

                if (File::exists($jsonPath)) {
                    $data = json_decode(File::get($jsonPath), true);
                    if (isset($data[$word])) {
                        unset($data[$word]);
                        File::put($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    }
                }
            }
            return $this->success(null, 'تم الحذف بنجاح');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function change(Request $request, $locale) {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}