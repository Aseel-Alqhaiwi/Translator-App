<?php

namespace App\Http\Controllers;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    private $translate;

    public function __construct()
    {
        // Initialize the Google Translate client
        $this->translate = new TranslateClient([
            'keyFilePath' => storage_path('app/google-credentials.json'),
        ]);
    }

    /**
     * Translate text between Arabic and English.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'target_language' => 'required|in:ar,en', // Ensure only Arabic or English is selected
        ]);

        $text = $request->input('text');
        $targetLanguage = $request->input('target_language');

        try {
            $result = $this->translate->translate($text, [
                'target' => $targetLanguage,
            ]);

            return response()->json([
                'success' => true,
                'translated_text' => $result['text'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
