<?php
// app/Services/OpenAIService.php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $httpClient;
    protected $baseUrl = 'https://api.openai.com/v1/';
    protected $apiKey;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->apiKey = env('OPENAI_API_KEY'); // Retrieve your OpenAI API key from environment variables
    }

    public function generateChatCompletion($userMessage)
    {
        $url = $this->baseUrl . 'chat/completions';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey,
        ];

        $body = [
            'model' => 'gpt-3.5-turbo-16k',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.',
                ],
                [
                    'role' => 'user',
                    'content' => $userMessage,
                ],
            ],
        ];

        try {
            $response = $this->httpClient->post($url, [
                'headers' => $headers,
                'json' => $body,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Handle exceptions, e.g., log errors
            return ['error' => $e->getMessage()];
        }
    }
}

