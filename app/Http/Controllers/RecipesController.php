<?php

namespace App\Http\Controllers;

use App\Model\RecipeCategory;
use App\Model\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index(){    
        $recipes = Recipe::all();
        $categories = RecipeCategory::all();
        return view('recipes/index')->with(compact('categories','recipes'));
    }

    public function show($id){
        $recipe = Recipe::find($id);
        return view('recipes.show')->with(compact('recipe'));
    }
}
