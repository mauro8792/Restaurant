<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'image'
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    

    public function getFeaturedImageUrlAttribute()
    {
          
        if ($this->image)
            return '/images/products/'.$this->image;
        

        return '/images/default.gif';
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }
}
