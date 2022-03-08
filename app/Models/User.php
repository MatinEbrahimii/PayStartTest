<?php

namespace App\Models;

use App\Models\Account;
use App\Traits\FindMethodTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FindMethodTrait;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function account()
    {
        $this->hasOne(Account::class);
    }

    public function storeAccount(array $data)
    {
        $this->account->save($data);
    }
}
