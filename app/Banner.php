<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'position_id', 'image', 'link'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
