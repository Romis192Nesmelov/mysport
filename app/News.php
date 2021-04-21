<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Sluggable;
    
    protected $fillable = [
        'image',
        'slug',
        'date',
        'head_ru',
        'content_ru',
        'head_en',
        'content_en',
        'active'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'head_ru',
                'maxLength' => 255,
                'maxLengthKeepWords' => true,
                'method' => null,
                'separator' => '-',
                'unique' => true,
                'uniqueSuffix' => null,
                'includeTrashed' => false,
                'reserved' => null,
                'onUpdate' => false
            ]
        ];
    }
}