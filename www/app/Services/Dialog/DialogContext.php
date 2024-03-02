<?php

namespace App\Services\Dialog;

use App\Services\TelegramRequest;

class DialogContext
{
    public TelegramRequest $telegramRequest;

    public function transitionTo(string $state): void
    {
        $this->telegramRequest->user->update(['state' => $state]);

        app($state)->handle($this);
    }

    public function setContext(TelegramRequest $request): void
    {
        $this->telegramRequest = $request;
    }
}
