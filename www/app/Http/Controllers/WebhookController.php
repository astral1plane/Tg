<?php

namespace App\Http\Controllers;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\DialogState;
use App\Services\Dialog\Start\HelloState;
use App\Services\TelegramClient;
use App\Services\TelegramRequest;
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
        TelegramClient $telegramClient
    ): void
    {
        $this->logger->info('webhook', [
            'webhook' => $request->all()
        ]);

        $telegramRequest = new TelegramRequest($request);

        $state = $telegramRequest->user->state;

        $dialogContext = new DialogContext();
        $dialogContext->setContext($telegramRequest);

        if ($state) {
            /** @var DialogState $state */
            $state = app($telegramRequest->user->state);
            $state->listen($dialogContext);

            return;
        }

        if ($telegramRequest->getMessage() == '/start') {
            $dialogContext->transitionTo(HelloState::class);

            return;
        }

        $state->handle($dialogContext);
    }
}
