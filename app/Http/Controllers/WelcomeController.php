<?php

namespace App\Http\Controllers;
use App\Model\Catering;
use App\Model\Category;
use Illuminate\Support\Collection;
use App\Model\Recipe;
use Illuminate\Http\Request;


class WelcomeController extends Controller
{
    public function index(){
        
        $caterings = Catering::all()->random(4);
        
        $categories = Category::where('show','1')
            ->get()->random(3);
        //dd($categories);
        $recipes = Recipe::all()->random(3);

        //menu del dia
        $menu= Category::where('name', 'menu del día')->first();
        //return view('welcome')->with(compact('caterings','breakfasts','meets','ibericos', 'recipes', 'menu' ));
        return view('welcome')->with(compact('caterings','categories', 'recipes', 'menu' ));
    }
}
