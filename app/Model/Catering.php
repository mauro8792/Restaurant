<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    protected $fillable = [
        'name', 'description', 'image','price'
    ];
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el catering.',
        'name.min' => 'El nombre del catering debe tener al menos 3 caracteres.',
        'description.max' => 'La descripción  solo admite hasta 250 caracteres.'
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'required'
    ];
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->image)
            return '/images/caterings/'.$this->image;
        

        return '/images/default.gif';
    }
}
