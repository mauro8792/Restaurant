<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    protected $fillable = [
        'name', 'description', 'image','price'
    ];

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/caterings/'.$this->image;
        

        return '/images/default.gif';
    }
}
