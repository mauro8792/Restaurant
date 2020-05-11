<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name','ingredients', 'description','video',
    ];

    public function category()
    {
    	return $this->belongsTo(Recipecategory::class);
    }
    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }
}
