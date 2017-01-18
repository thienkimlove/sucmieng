<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
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
        'seo_title',
        'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')
            ->publish()
            ->latest('updated_at')
            ->paginate(10);
    }

}
