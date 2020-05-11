<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recipecategory extends Model
{
    protected $fillable = [
        'name', 'description','image',
    ];

    public function recipes()
    {
    	return $this->hasMany(Recipe::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/recipes/categories/'.$this->image;
        return '/images/default.gif';
    }
}
