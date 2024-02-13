<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class WebhookRequest
{


    public function __construct(
        private readonly string $chat_id,
        private readonly string $message,

    )
    {
    }


    public static function fromRequest(Request $request)
    {
        return new self(
            $request->input('message')['chat']['id'],
            $request->input('message')['text']

        );
    }


    public function getChatId()
    {
        return $this->chat_id;
    }

    public function getMessage()
    {
        return $this->message;
    }

}
