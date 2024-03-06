<?php

namespace App\Services\Dialog\Start;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;
use App\Services\TelegramClient;
use App\Services\TelegramRequest;

class HelloState extends DialogState
{


    public function handle(DialogContext $dialogContext): void
    {
        $this->telegramClient->sendMessage($dialogContext->getChatId(), 'Введите имя');
    }

    public function listen(DialogContext $dialogContext): void
    {
        $data =  [ 'dialog_data' => array_merge($dialogContext->getUser()->dialog_data, [
            'car_number' => $dialogContext->getMessage()
        ])];

        $this->telegramClient->sendMessage($dialogContext->getChatId(), 'listen_HelloState');
    }
}
