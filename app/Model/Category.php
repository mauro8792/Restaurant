<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'image','show'
    ];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/categories/'.$this->image;
        // else
        $firstProduct = $this->products()->first();
        if ($firstProduct)
            return $firstProduct->featured_image_url;

        return '/images/default.gif';
    }
    
    
}
