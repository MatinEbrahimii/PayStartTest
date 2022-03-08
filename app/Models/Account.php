<?php

namespace App\Models;

use App\Traits\FindMethodTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory ,FindMethodTrait;

    protected $guarded = ['id'];
}
