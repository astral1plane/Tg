<?php

namespace App\Services;

class TelegramConfig
{

    public function __construct(
        public string $token,
        public string $secretToken
    )
    {
    }

    public function baseUrl(): string
    {
        return 'telegram-bot-api:8081/bot' . $this->token . '/';
    }

}
