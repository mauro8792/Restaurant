<?php

namespace App\Http\Controllers\Admin\Recipe;
use App\Model\RecipeCategory;
use App\Model\Recipe;
use App\Model\RecipeImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class RecipeController extends Controller
{
    public function index(Request $request)
    {   
        $category = Recipecategory::find($request->id);
    	$recipes = $category->recipes;
    	return view('admin.recipes.recipes.index')->with(compact('recipes','category')); // listado
    }
    public function create(Request $request)
    {   
        //dd($request->id);
        $category = Recipecategory::find($request->id);
    	return view('admin.recipes.recipes.create')->with(compact('category')); // formulario de registro
    }
    public function store(Request $request)
    {
        $recipe = new Recipe();
        $recipe->name= $request->name;
        $recipe->short_description =$request->short_description;
        $recipe->ingredients= $request->ingredients;
        $recipe->description= $request->description;
        $recipe->video= $request->video;
        $recipe->recipecategory_id = $request->recipecategory_id;
        $recipe->save();

        $files = $request->file('image');
        if($files){
            foreach ($files as $file) {
                
                $path = public_path() . '/images/recipes/recipes';
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $file->move($path, $fileName);

                $recipeImage = new RecipeImage();
                $recipeImage->image = $fileName;
                $recipeImage->recipe_id = $recipe->id;
                $recipeImage->save();
            }
        }
        return redirect('/admin/recipe-book/'.$request->recipecategory_id.'/recipes');
    }
    public function update(Request $request, $id){
        

        $recipe= Recipe::find($request->recipe_id);
        $recipe->name = $request->name;
        $recipe->short_description =$request->short_description;
        $recipe->ingredients = $request->ingredients;
        $recipe->description = $request->description;
        $recipe->video = $request->video;
        $recipe->save();
        return redirect('/admin/recipe-book/'.$request->recipecategory_id.'/recipes');
    }
    public function indeximage($id){
        
        $recipe = Recipe::find($id);
        $images = $recipe->images()->get();
        //dd($images);
        return view('admin.recipes.recipes.images.index')->with(compact('recipe', 'images'));
    }
    public function addImage(Request $request){

        $file = $request->file('image');
    	$path = public_path() . '/images/recipes/recipes';
	    $fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);
    	
    	// crear 1 registro en la tabla product_images
    	if ($moved) {
	    	$recipeImage = new RecipeImage();
	    	$recipeImage->image = $fileName;
	    	$recipeImage->recipe_id = $request->recipe_id;
	    	$recipeImage->save(); // INSERT
    	}
    	return back();
    }
    public function deleteImage(Request $request){
        // eliminar el archivo
        //$productImage = ProductImage::find($request->input('image_id'));
        $recipeImage = RecipeImage::find($request->input('image_id'));
    	if (substr($recipeImage->image, 0, 4) === "http") {
    		$deleted = true;
    	} else {
    		$fullPath = public_path().'/images/recipes/recipes/'.$recipeImage->image;
    		$deleted = File::delete($fullPath);
    	}

    	// eliminar el registro de la img en la bd
    	if ($deleted) {
    		$recipeImage->delete();
    	}

    	return back();
    }
    public function destroy(Request $request){
        
        $recipe = Recipe::find($request->id);
        //dd($recipe);
        $recipe->delete();
        return back();
    }
}
