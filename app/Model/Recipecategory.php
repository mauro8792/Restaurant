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
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la categoria de Recetas.',
        'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres.',
    ];
    public static $rules = [
        'name' => 'required|min:3',
    ];
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/recipes/categories/'.$this->image;
        return '/images/default.gif';
    }
}
