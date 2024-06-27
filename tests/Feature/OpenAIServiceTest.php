<?php

namespace Tests\Feature;

use App\Services\OpenAIService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OpenAIServiceTest extends TestCase
{
    /** @var OpenAIService */
    protected $openaiService;

    public function setUp(): void
    {
        parent::setUp();

        // Mocking Guzzle HTTP client for testing
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'id' => 'chatcmpl-123',
                'object' => 'chat.completion',
                'choices' => [
                    [
                        'index' => 0,
                        'message' => [
                            'role' => 'assistant',
                            'content' => 'Hello there, how may I assist you today?',
                        ],
                        'finish_reason' => 'stop',
                    ],
                ],
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);

        // Inject the mocked HTTP client into the OpenAIService instance
        $this->openaiService = new OpenAIService();
        $reflection = new \ReflectionClass($this->openaiService);
        $property = $reflection->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($this->openaiService, $httpClient);
    }

    /** @test */
    public function it_can_generate_answer_from_openai_api()
    {
        $question = 'What is the capital of France?';
        $response = $this->openaiService->generateChatCompletion($question);

        $this->assertArrayHasKey('choices', $response);
        $this->assertNotEmpty($response['choices']);

        // Additional assertions based on the expected response from OpenAI
        $this->assertEquals('chatcmpl-123', $response['id']);
        $this->assertEquals('assistant', $response['choices'][0]['message']['role']);
        $this->assertEquals('Hello there, how may I assist you today?', $response['choices'][0]['message']['content']);
        $this->assertEquals('stop', $response['choices'][0]['finish_reason']);
    }
}
