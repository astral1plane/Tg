<?php

namespace App\Services;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Collection;

class TelegramClient
{
    public function __construct(
        private readonly Factory $httpFactory,
        private readonly TelegramConfig $telegramConfig,
    )
    {
    }

    public function sendMessage ($chatId, $message)
    {
        $data =
            [
                'chat_id'=> $chatId,
                'text' => $message
            ];
        $response = $this->httpFactory->post($this->telegramConfig->baseUrl() . 'sendMessage', $data);
        return collect($response->json());
    }

    public function getFile($fileId)
    {
        $data = [
            'file_id' => $fileId
        ];
        $response = $this->httpFactory->post($this->telegramConfig->baseUrl() . 'getFile', $data);
        return collect($response->json());
    }


    public function downloadLinkFiles($filePath)
    {

        $response = $this->httpFactory->get($this->telegramConfig->fileUrl() . $filePath);
        return collect($response->json());
    }
}
