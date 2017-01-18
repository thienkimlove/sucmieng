<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $fillable = [
        'title',
        'question',
        'seo_title',
        'desc',
        'keywords',
        'answer',
        'slug',
        'answer_person',
        'ask_person',
        'ask_phone',
        'ask_email',
        'ask_address',
        'image',
        'status'
    ];

    protected $dates = ['created_at', 'updated_at'];



    public function scopePublish($query)
    {
        $query->where('status', true);
    }

}
