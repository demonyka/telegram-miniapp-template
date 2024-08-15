<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $telegram_id
 * @property string $telegram_data
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'telegram_id',
        'telegram_data'
    ];

    protected $hidden = [

    ];

    protected $appends = [
        'username',
        'firstname',
        'lastname'
    ];

    public function getUsernameAttribute()
    {
        $telegramData = json_decode($this->telegram_data, true);
        return $telegramData['username'] ?? '';
    }

    public function getFirstnameAttribute(): string
    {
        $telegramData = json_decode($this->telegram_data, true);
        return $telegramData['first_name'] ?? '';
    }

    public function getLastnameAttribute(): string
    {
        $telegramData = json_decode($this->telegram_data, true);
        return $telegramData['last_name'] ?? '';
    }
}
