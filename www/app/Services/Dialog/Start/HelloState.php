<?php

namespace App\Services\Dialog\Start;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;
use App\Services\TelegramClient;
use App\Services\TelegramRequest;

class HelloState extends DialogState
{
    public function __construct(
        private readonly TelegramClient $telegramClient
    )
    {
    }

    public function handle(DialogContext $dialogContext): void
    {
        $this->telegramClient->sendMessage($dialogContext->telegramRequest->getChatId(), 'Введите имя');
    }

    public function listen(DialogContext $dialogContext): void
    {
        $dialogContext->telegramRequest->user->update([
            'dialog_data' => [
                'name' => $dialogContext->telegramRequest->getMessage()
            ]
        ]);

        $dialogContext->transitionTo(GetPhoneState::class);
    }
}
