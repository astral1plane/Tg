<?php

namespace App\Services\Dialog\Post;

use App\Models\Post;
use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;

class SendNumberState extends DialogState
{

    public function handle(DialogContext $dialogContext): void
    {
        $this->telegramClient->sendMessage($dialogContext->getChatId(), 'Введите номер машины');
    }

    public function listen(DialogContext $dialogContext): void
    {
        $currentUser = $dialogContext->getUser();
        $currentData = (array) $currentUser->dialog_data;
        $result = array_merge($currentData, ['car_number' => $dialogContext->getMessage()]);
        $currentUser->update(['dialog_data' => $result]);

        $dialogContext->transitionTo(SendAddressState::class);

    }
}
