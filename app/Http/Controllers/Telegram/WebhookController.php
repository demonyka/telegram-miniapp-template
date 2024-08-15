<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Telegram\Bot\BotsManager;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class WebhookController extends Controller
{
    protected BotsManager $botsManager;
    public function __construct(BotsManager $botsManager)
    {
        $this->botsManager = $botsManager;
    }

    public function __invoke(Request $request): Response
    {
        $this->botsManager->commandsHandler(true);
        $update = Telegram::getWebhookUpdate();
        return response(null, 200);
    }
}
