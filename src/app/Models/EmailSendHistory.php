<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSendHistory extends Model
{
    use HasFactory;

    const ADMIN_USER = 1;
    const SHOP_USER = 2;

    protected $fillable = [
        'success_flag',
        'send_datetime',
        'user_type',
    ];
}
