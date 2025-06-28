<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Message extends Model
{
    protected $fillable = [
        'chat_id', 'user_id',
        'content',
        'is_read',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::get(
            fn ($value) => Carbon::parse($value)->format('H:i A')
        );
    }
}
