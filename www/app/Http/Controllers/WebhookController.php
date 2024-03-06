<?php

namespace App\Http\Controllers;

use App\Services\Dialog\DialogContext;
use App\Services\Dialog\Post\SendNumberState;
use App\Services\Dialog\Start\HelloState;
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
        Request $request
    ): void
    {
        $this->logger->info('webhook', [
            'webhook' => $request->all()
        ]);


        $dialogContext = new DialogContext();
        $dialogContext->setContext($request);

        $currentState = $dialogContext->getState();

        $message = $dialogContext->getMessage();
        $menuList = $this->menu();

        if (isset($menuList[$message]))
        {
            $dialogContext->transitionTo($menuList[$message]);
            return;
        }
        if ($dialogContext->getUser()->state)
        {
            $newState = app($currentState);
            $newState->listen($dialogContext);
        }
    }



    private function menu(): array
    {
        return [
            '/start' => HelloState::class,
            '/send' => SendNumberState::class,
        ];
    }
}
