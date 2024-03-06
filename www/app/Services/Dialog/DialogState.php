<?php

namespace App\Services\Dialog;

use App\Services\TelegramClient;
use App\Services\TelegramConfig;

abstract class DialogState
{

    public function __construct(
        protected readonly TelegramClient $telegramClient,
        protected readonly TelegramConfig $telegramConfig
    )
    {
    }

    abstract public function handle(DialogContext $dialogContext): void;
    abstract public function listen(DialogContext $dialogContext): void;

}
