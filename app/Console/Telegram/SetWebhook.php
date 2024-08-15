<?php

namespace App\Console\Telegram;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetWebhook extends Command
{
    protected $signature = 'telegram:set-webhook';
    protected $description = 'Установить webhook для telegram';
    public function handle(): void
    {
        Telegram::setWebhook(['url' => route('telegram.webhook')]);
        print("Вебхук установлен на адрес: " . route('telegram.webhook') . "\n");
    }
}
