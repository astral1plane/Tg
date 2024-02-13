<?php

namespace App\Http\Controllers;

use App\Services\WebhookRequest;
use App\Services\TelegramClient;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class WebhookController extends Controller
{
    public function __construct(
        private readonly LoggerInterface $logger,
    )
    {
    }

    public function __invoke(
        Request $request,
        TelegramClient $telegramClient,


    ): void
    {
        $this->logger->info('webhook', [
            'webhook' => $request->all()
        ]);

        $webhookRequest = WebhookRequest::fromRequest($request);
        $telegramClient->sendResponce($webhookRequest->getChatId(), $webhookRequest->getMessage());
    }
}
