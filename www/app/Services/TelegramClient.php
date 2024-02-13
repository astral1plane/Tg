<?php

namespace App\Services;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Collection;

class TelegramClient
{
    public string $message;
    public string $chatId;
    public function __construct(
        private readonly Factory $httpFactory,
        private readonly TelegramConfig $telegramConfig,
    )
    {
    }


    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setChatId(string $chatId)
    {
        $this->chatId = $chatId;
    }

    public function sendResponce ($chatId = null, $message = null)
    {
        $chatId = $chatId ?? $this->chatId;
        $message = $message ?? $this->message;
        $data =
            [
                'chat_id'=> $chatId,
                'text' => $message
            ];
        $response = $this->httpFactory->post($this->telegramConfig->baseUrl() . 'sendMessage', $data);
        return collect($response->json());
    }
}
