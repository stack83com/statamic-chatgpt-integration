<?php

namespace Stack83\StatamicChatGPT;

use Stack83\StatamicChatGPT\Fieldtypes\OpenChat;
use Stack83\StatamicChatGPT\Services\Contracts\ChatService;
use Stack83\StatamicChatGPT\Services\OpenAIService;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        OpenChat::class,
    ];

    protected $scripts = [
        __DIR__.'/../dist/js/openai.js'
    ];

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function bootAddon()
    {
        $this->app->bind(ChatService::class, OpenAIService::class);
    }
}
