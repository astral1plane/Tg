<?php

use App\Http\Controllers\WebhookController;
use App\Http\Middleware\SecretTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/webhook', WebhookController::class)->middleware(SecretTokenMiddleware::class)->name('webhook');
