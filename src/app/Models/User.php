<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーション：目標体重（1対1）
    public function weightTarget()
    {
        return $this->hasOne(WeightTarget::class);
    }

    // リレーション：体重ログ（1対多）
    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }
}
