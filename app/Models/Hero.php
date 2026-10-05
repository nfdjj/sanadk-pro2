<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'whatsapp_number'
    ];
}
