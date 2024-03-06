<?php

namespace App\Services\Dialog\Post;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;
use Illuminate\Support\Facades\Storage;

class SendImagesState extends DialogState
{

    public function handle(DialogContext $dialogContext): void
    {
        $this->telegramClient->sendMessage($dialogContext->getChatId(), 'Прикрепите изображения');
    }

    public function listen(DialogContext $dialogContext): void
    {

        $result = $this->telegramClient->getFile($dialogContext->getFileId());

         //$resultStorage =  Storage::disk('local')->put('/images' ,
          //Storage::download( $this->telegramClient->downloadLinkFiles($result['result']['file_path'])));

        $this->telegramClient->sendMessage($dialogContext->getChatId(), $this->telegramClient->downloadLinkFiles($result['result']['file_path']));

    }
}
