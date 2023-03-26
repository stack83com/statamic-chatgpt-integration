<?php declare(strict_types=1);

namespace Stack83\StatamicChatGPT\Services\Contracts;

interface ChatService
{
    public function getCompletion(array $input): array;
}
