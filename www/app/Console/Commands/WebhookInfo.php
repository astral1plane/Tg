<?php

namespace App\Console\Commands;

use App\Services\TelegramConfig;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;

class WebhookInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:info';

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
        $response = $httpFactory->get($telegramConfig->baseUrl(). 'getWebhookInfo');
        dd($response->json());
//        $this->table();
    }
}
