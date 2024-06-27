<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\OpenAIService;

class AIController extends Controller
{
        public function testOpenAI()
        {
            $apiKey = config('services.openai.api_key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo-16k',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant.'
                    ],
                    [
                        'role' => 'user',
                        'content' => 'Hello!'
                    ]
                ]
            ]);

            Log::info('OpenAI Request:', [
                'headers' => $response->headers(),
                'body' => $response->body(),
                'status' => $response->status()
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return response()->json(['error' => $response->body()], $response->status());
        }
    
}
