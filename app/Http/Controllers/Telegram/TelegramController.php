<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Services\Telegram\TelegramService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TelegramController extends Controller
{
    protected TelegramService $telegramService;
    public function __construct()
    {
        $this->telegramService = new TelegramService();
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'initParams' => 'required'
        ]);
        if(!$this->telegramService->verifyData($request->input('initParams'))) {
            // TODO: redirect to error
            abort(400, 'Input not valid');
        }

        $data = $this->telegramService->parseData($request->input('initParams'));
        $telegramUser = json_decode($data['user'], true);

        $this->telegramService->auth($telegramUser);

        Cookie::queue(Cookie::forget('telegram_data'));

        Cookie::queue('telegram_data', $request->input('initParams'), 180);

        return redirect()->route('webapp.home');
    }
}
