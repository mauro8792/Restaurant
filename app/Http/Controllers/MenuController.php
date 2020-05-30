<?php

namespace App\Http\Controllers;
use App\Model\Catering;
use App\Model\Category;

use App\Model\Recipe;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $breakfasts = [];
        $meets= [];
        $ibericos = [];
        $caterings = Catering::all()->random(4);
        
        //seccion desayuno
        $breakfastss = Category::where('name','Desayunos')->take(3)->first();      
        for( $i=0; $i<sizeof($breakfastss->products) && $i<3; $i++){
            array_push($breakfasts, $breakfastss->products[$i]);
        }
        //seccion carnes
        $meetss = Category::where('name','Carnes')->first();      
        for( $i=0; $i<sizeof($meetss->products) && $i<3; $i++){
            array_push($meets, $meetss->products[$i]);
        }
        //seccion ibéricos
        $ibericoss = Category::where('name','ibéricos')->first();     
        for( $i=0; $i<sizeof($ibericoss->products) && $i<3; $i++){
            array_push($ibericos, $ibericoss->products[$i]);
        }
        //seccion recetas
        $recipes = Recipe::all()->random(3);

        //menu del dia
        $menu= Category::where('name', 'menu del día')->first();
        return view('menu')->with(compact('caterings','breakfasts','meets','ibericos', 'recipes', 'menu' ));
    }

    public function index1(){
    	$categories = Category::orderBy('name')->get();        
        return view('menu1')->with(compact('categories'));
    }

    public function index2(){
    	$categories = Category::orderBy('name')->get();        
        return view('menu2')->with(compact('categories'));
    }

    public function index3(){
        $categories = Category::orderBy('name')->get();        
        return view('menu3')->with(compact('categories'));
    }
}
