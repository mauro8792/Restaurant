<?php

namespace App\Model;
use Cohensive\Embed\Facades\Embed;
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
    public function getVideoHtmlAttribute()
    {
        $embed = Embed::make($this->video)->parseUrl();

        if (!$embed)
            return '';

        $embed->setAttribute(['width' => 400]);
        return $embed->getHtml();
    }
}
