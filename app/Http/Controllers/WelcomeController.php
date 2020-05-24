<?php

namespace App\Http\Controllers;
use App\Model\Catering;
use App\Model\Category;

use App\Model\Recipe;
use Illuminate\Http\Request;


class WelcomeController extends Controller
{
    public function index(){
        $breakfasts1 = [];
        $breakfasts2 = [];
        $meets1= [];
        $meets2= [];
        $iberico1 = [];
        $iberico2 = [];
        $caterings = Catering::all()->random(4);
        
        //seccion desayuno
        $breakfasts = Category::where('name','Desayunos')->first();      
        for( $i=0; $i<sizeof($breakfasts->products) && $i<=5; $i++){
            if ($i%2 == 0) {
                array_push($breakfasts1, $breakfasts->products[$i]);
            }else
                array_push($breakfasts2, $breakfasts->products[$i]);
        }
        //seccion carnes
        $meets = Category::where('name','Carnes')->first();      
        for( $i=0; $i<sizeof($meets->products) && $i<=5  ; $i++){
            if ($i%2 == 0) {
                array_push($meets1, $meets->products[$i]);
            }else
                array_push($meets2, $meets->products[$i]);
        }
        //seccion ibéricos
        $ibericos = Category::where('name','ibéricos')->first();     
        for( $i=0; $i<sizeof($ibericos->products) && $i<=5 ; $i++){
            if ($i%2 == 0) {
                array_push($iberico1, $ibericos->products[$i]);
            }else
                array_push($iberico2, $ibericos->products[$i]);
        }
        //seccion recetas
        $recipes = Recipe::all()->random(3);
        //dd($recipes);
        return view('welcome')
            ->with(compact('caterings','breakfasts1','breakfasts2',
                            'meets1', 'meets2',
                            'iberico2', 'iberico1', 'recipes' ));
    }
}
