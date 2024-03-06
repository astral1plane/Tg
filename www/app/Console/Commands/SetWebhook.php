<?php

namespace App\Console\Commands;

use App\Services\TelegramConfig;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */


    public function handle(Factory $httpFactory, TelegramConfig $telegramConfig): void
    {
        $response = $httpFactory->post($telegramConfig->baseUrl(). 'setWebhook', [
            'url' => route('webhook'),
            'secret_token' => $telegramConfig->secretToken()
        ]);

        $this->info($response->json()['description']);
    }
}
