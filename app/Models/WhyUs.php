<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    protected $fillable = [
        'main_text_ar',
        'main_text_en',
        'sub_text1_ar',
        'sub_text1_en',
        'sub_text2_ar',
        'sub_text2_en'
    ];
}
