<?php

namespace App\Http\Controllers\Admin\Recipe;
use App\Model\RecipeCategory;
use App\Model\Recipe;
use App\Model\RecipeImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {   
    	$recipes = Recipe::all();
    	return view('admin.recipes.recipes.index')->with(compact('recipes')); // listado
    }
    public function create()
    {
    	return view('admin.recipes.recipes.create'); // formulario de registro
    }
    public function store(Request $request)
    {
        $recipe = new Recipe();
        $recipe->name= $request->name; 
        $recipe->ingredients= $request->ingredients;
        $recipe->description= $request->description;
        $recipe->video= $request->video;
        $recipe->recipecategory_id = 2;
        $recipe->save();

        $files = $request->file('image');

            foreach ($files as $file) {
                
                $path = public_path() . '/images/recipes/recipes';
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->move($path, $fileName);

                $recipeImage = new RecipeImage();
                $recipeImage->image = $fileName;
                $recipeImage->recipe_id = $recipe->id;
                $recipeImage->save();
            }
        return redirect('/admin/recipes');
    }
    public function indeximage($id){
        
        $recipe = Recipe::find($id);
        $images = $recipe->images()->get();
        //dd($images);
        return view('admin.recipes.recipes.images.index')->with(compact('recipe', 'images'));
    }
}
