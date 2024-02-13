<?php

namespace App\Services;

class TelegramConfig
{

    public function __construct(
        public string $token
    )
    {
    }

    public function baseUrl(): string
    {
        return 'https://api.telegram.org/bot' . $this->token . '/';
    }
}
