<?php

namespace App\Services\Telegram;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TelegramService
{
    public function verifyData(string $data): bool
    {
        parse_str($data, $params);
        $initData = $params;
        unset($initData['hash']);
        ksort($initData);
        $hash = $params['hash'];
        $data_check_string = '';
        foreach ($initData as $key => $value) {
            $data_check_string .= $key . '=' . $value . "\n";
        }
        $data_check_string = rtrim($data_check_string);
        $secret_key = hash_hmac('sha256', config('telegram.bots.bot.token'), "WebAppData", true);
        if (hash_hmac('sha256', $data_check_string, $secret_key) !== $hash) {
            return false;
        }
        return true;
    }

    public function parseData(string $data)
    {
        parse_str($data, $params);
        return $params;
    }

    public function auth(array $telegramUser): void
    {
        $telegramId = $telegramUser['id'];
        $user = User::firstOrCreate(
            ['telegram_id' => $telegramId],
            [
                'telegram_id' => $telegramId,
                'telegram_data' => json_encode($telegramUser),
            ]
        );

        if (auth()->check() && auth()->user()->telegram_id !== $telegramId) {
            Auth::logout();
        }
        $user->telegram_data = json_encode($telegramUser);
        $user->save();
        Auth::login($user);
    }
}
