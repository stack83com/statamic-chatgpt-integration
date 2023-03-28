<?php declare(strict_types=1);

namespace Stack83\StatamicChatGPT\Services;


use Orhanerday\OpenAi\OpenAi;
use Stack83\StatamicChatGPT\Services\Contracts\ChatService;


final class OpenAIService implements ChatService
{
    private OpenAi $client;

    public function __construct()
    {
        $key = config('statamic-chatgpt-integration.api_key');
        $this->client = new OpenAi($key);
    }

    /**
     * @throws \JsonException
     */
    public function getCompletion(array $input): array
    {
        $instructions = config('statamic-chatgpt-integration.instructions');
        $model = config('statamic-chatgpt-integration.model');

        $complete = $this->client->chat([
            'model' => $model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $instructions
                ],
                ...$input
            ],
            'temperature' => 1.0,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);

        return json_decode($complete, true, 512, JSON_THROW_ON_ERROR);
    }
}
