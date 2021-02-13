<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'image',
        'head_ru',
        'content_ru',
        'head_en',
        'content_en',
        'active'
    ];
}