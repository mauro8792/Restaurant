<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RecipeImage extends Model
{
    public function recipes()
    {
    	return $this->belongsTo(Recipe::class);
    }
    public function getUrlAttribute()
    {
    	if (substr($this->image, 0, 4) === "http") {
    		return $this->image;
    	}
        return '/images/recipes/' . $this->image;
    }
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/recipes/recipes/'.$this->image;
        // else
        $firstProduct = $this->products()->first();
        if ($firstProduct)
            return $firstProduct->featured_image_url;

        return '/images/default.gif';
    }
}
