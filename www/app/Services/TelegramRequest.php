<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class TelegramRequest
{

    private string $message;
    private string $chatId;

    public User $user;
    public function __construct(Request $request)
    {
       $this->chatId = $request->input('message')['chat']['id'];
       $this->message =  $request->input('message')['text'];
       $this->user = User::query()->firstOrCreate(['chat_id' => $this->chatId]);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }





}
