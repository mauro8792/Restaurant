<?php

namespace App\Http\Controllers;

use App\Model\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index(){    
        $recipes = Recipe::all();
        return view('recipes')->with(compact('recipes'));
    }
}
