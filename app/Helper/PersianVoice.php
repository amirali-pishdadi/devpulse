<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PersianVoice
{
    private static $apiUrl = 'https://api.talkbot.ir/v1/media/text-to-speech/REQ';
    private static $accessToken;

    public static function init()
    {
        if (!self::$accessToken) {
            self::$accessToken = env('TALKBOT_ACCESS_TOKEN');

            if (!self::$accessToken) {
                throw new \Exception('Talkbot access token is not set in the .env file.');
            }
        }
    }

    public static function textToVoiceAndSave($article, $user): string
    {
        self::init();

        $data = [
            'text'   => $article->content,
            'gender' => 'female',
            'server' => 'farsi',
            'sound'  => '3', 
        ];

        $headers = [
            'Authorization' => 'Bearer ' . self::$accessToken,
            'Content-Type'  => 'application/json',
        ];

        // Make API request
        $response = Http::withHeaders($headers)->post(self::$apiUrl, $data);

        if ($response->failed()) {
            throw new \Exception('Failed to connect to the Talkbot API: ' . $response->body());
        }

        // Retrieve the audio URL
        $audioUrl = $response->json('audio_url');

        // Download the audio file
        $audioContent = file_get_contents($audioUrl);
        if ($audioContent === false) {
            throw new \Exception('Failed to download the audio file from ' . $audioUrl);
        }

        // Define the storage path
        $filePath = "uploads/{$user->username}/{$article->slug}/voice/";
        $fileName = "article_voice.mp3"; // Save audio as a consistent file name or generate dynamically

        // Save the file to the storage disk
        Storage::put($filePath . $fileName, $audioContent);

        // Return the full path for reference
        return $filePath . $fileName;
    }
}

