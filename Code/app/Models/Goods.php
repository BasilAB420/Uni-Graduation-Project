<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_university',
        'poster_name',
        'poster_email',
        'poster_phone',
        'price',
        'image'
    ];
}
