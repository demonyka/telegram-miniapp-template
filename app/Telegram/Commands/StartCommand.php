<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;
class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle(): void
    {
        $response = $this->replyWithMessage([
            'text' =>
                "Добро пожаловать!\n\n(TODO: изменить приветственное сообщение)",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Начать игру',
                            'web_app' => [
                                'url' => route('webapp.index')
                            ]
                        ],
                    ],
                ],
            ]),
            'openUrl' => route('webapp.index'),
        ]);
    }
}
