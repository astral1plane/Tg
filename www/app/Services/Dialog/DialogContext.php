<?php

namespace App\Services\Dialog;

use App\Models\User;
use Illuminate\Http\Request;

class DialogContext
{
    public ?string $message;
    public string $chatId;

    public User $user;

    public ?string $fileId;

    public ?array $photo;


    public function transitionTo(string $state)
    {
        $this->getUser()->update(['state' => $state]);

        return app($state)->handle($this);
    }

    public function setContext(Request $request): void
    {
        $this->chatId = $request->input('message')['chat']['id'];
        if (isset($request->input('message')['text']))
        {
            $this->message = $request->input('message')['text'] ;
        }
        else
        {
            $this->message = null;
        }
        if (isset($request->input('message')['photo']))
        {
            $this->photo = $request->input('message')['photo'];
            $this->fileId = $request->input('message')['photo'][3]['file_id'];
        }
        else
        {
            $this->photo = null;
            $this->fileId = null;
        }
        $this->user = User::query()->firstOrCreate(['id' => $this->chatId]);
        $this->state = $this->user->state;
    }
    public function setState(string $state)
    {
        $this->state = $state;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getPhotos()
    {
        return $this->photo;
    }

    public function getFileId()
    {
        return $this->fileId;
    }



}
