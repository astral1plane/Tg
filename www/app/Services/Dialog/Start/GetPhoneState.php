<?php

namespace App\Services\Dialog\Start;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;
use App\Services\TelegramClient;

class GetPhoneState extends DialogState
{
    public function __construct(
        private readonly TelegramClient $telegramClient
    )
    {
    }

    public function handle(DialogContext $dialogContext): void
    {
        $this->telegramClient->sendMessage($dialogContext->telegramRequest->getChatId(), 'Телефон');
    }

    public function listen(DialogContext $dialogContext): void
    {
        $dialogContext->telegramRequest->user->update([
            'dialog_data' => array_merge($dialogContext->telegramRequest->user->dialog_data, [
                'phone' => $dialogContext->telegramRequest->getMessage()
            ])
        ]);
    }
}
