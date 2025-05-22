<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $telegram_id
 * @property array $telegram_data
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected $casts = [
        'telegram_data' => 'array',
    ];

    public function getUsernameAttribute()
    {
        return $this->telegram_data['username'] ?? '';
    }

    public function getFirstnameAttribute(): string
    {
        return $this->telegram_data['first_name'] ?? '';
    }

    public function getLastnameAttribute(): string
    {
        return $this->telegram_data['last_name'] ?? '';
    }
}
