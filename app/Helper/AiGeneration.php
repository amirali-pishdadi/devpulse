<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;


class AiGeneration
{
    // private static $baseUrl = "";
    private static $baseUrl = "";

    private static $apiKey;

    public static function init()
    {
        if (!self::$apiKey) {
            self::$apiKey = "";
            if (!self::$apiKey) {
                throw new \Exception('API_KEY is not set in the environment.');
            }
        }
    }

    public static function sendRequest($message)
    {
        self::init();

        $response = Http::post(self::$baseUrl, $message);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Error communicating with OpenAI: ' . $response->body());
        }
    }

    /**
     * Summarize the given text using OpenAI's API.
     *
     * @param string $text The text to summarize.
     * @param string $model The OpenAI model to use (default is "gpt-4").
     * @return string The summarized text.
     */
    public static function summarizer($text)
    {
        self::init();

        $message = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => "Summarize the following article into a short and engaging paragraph for a Telegram channel. Use an informal yet professional tone, include relevant emojis . Keep it concise, exciting, and suitable for Telegram readers. Here's the article ( به زبان فارسی ): " . $text],
                    ],
                ],
            ],
        ];

        $response = self::sendRequest($message);

        if (isset($response)) {
            return $response["candidates"][0]["content"]["parts"][0]["text"];
        } else {
            throw new \Exception('Invalid response from OpenAI API.');
        }
    }

    public static function commentChecker($text, $model = "gpt-4o-mini")
    {
        self::init();

        $message = [
            "contents" => [
                "parts" => [
                    ["text" => "لطفا این پیام را چک کن و اگر محتوای نامناسبی نداشت فقط true یا false را بفرست ( مواظب باش که پیام سیاسی ارسال نشود )" . $text],
                ],
            ],
        ];

        $response = self::sendRequest($message);

        if (isset($response)) {
            return $response["candidates"][0]["content"]["parts"][0]["text"];
        } else {
            throw new \Exception('Invalid response from OpenAI API.');
        }
    }
}