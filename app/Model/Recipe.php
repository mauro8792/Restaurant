<?php

namespace App\Model;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name','short_description','ingredients', 'description','video',
    ];
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la receta.',
        'name.min' => 'El nombre de la receta debe tener al menos 3 caracteres.',
        'description.required' => 'Es necesario que la receta contenga instrucciones.',
        'ingredients.required' => 'Es necesario que la receta contenga ingredientes.'
    ];
    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'ingredients' => 'required'
    ];

    public function category()
    {
    	return $this->belongsTo(Recipecategory::class);
    }
    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }
    public function getVideoHtmlAttribute()
    {
        $embed = Embed::make($this->video)->parseUrl();

        if (!$embed)
            return '';

        $embed->setAttribute(['width' => 348]);
        return $embed->getHtml();
    }
    public function getVideoBigHtmlAttribute()
    {
        $embed = Embed::make($this->video)->parseUrl();

        if (!$embed)
            return '';

        $embed->setAttribute(['width' => 600]);
        return $embed->getHtml();
    }
}
