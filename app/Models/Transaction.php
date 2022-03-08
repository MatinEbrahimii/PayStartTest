<?php

namespace App\Models;

use App\Traits\FindMethodTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, FindMethodTrait;

    protected $guarded = ['id'];

    public static function store(array $data)
    {
        return self::create($data);
    }

    public static function getByPaymentNumber($account_id, $payment_number)
    {
        return self::where('payment_number', $payment_number)
            ->where('from_account', $account_id)
            ->get();
    }
}
