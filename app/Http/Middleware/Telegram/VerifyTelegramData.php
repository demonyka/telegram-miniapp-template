<?php

namespace App\Http\Middleware\Telegram;

use App\Services\Telegram\TelegramService;
use Closure;
use Illuminate\Support\Facades\Cookie;

class VerifyTelegramData
{
    protected TelegramService $telegramService;
    public function __construct()
    {
        $this->telegramService = new TelegramService();
    }
    public function handle($request, Closure $next)
    {
        if (Cookie::has('telegram_data')) {
            $telegramData = Cookie::get('telegram_data');
            if (!$this->telegramService->verifyData($telegramData)) {
                abort(400, 'Input not valid');
            }
            return $next($request);
        } else {
            return redirect()->route('webapp.index');
        }
    }
}
