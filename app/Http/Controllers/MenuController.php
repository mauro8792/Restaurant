<?php

namespace App\Http\Controllers;
use App\Model\Category;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
    	$categories = Category::orderBy('name')->get();   

        //menu del dia
        $menuDelDia = Category::where('name', 'menu del día')->first();
        return view('menu/index')->with(compact('categories', 'menuDelDia'));
    }

    public function index1(){
        $categories = Category::orderBy('name')->get();        
        $menuDelDia = Category::where('name', 'menu del día')->first();        
        return view('menu/index1')->with(compact('categories','menuDelDia'));
    }

    public function index2(){
        $categories = Category::orderBy('name')->get();        
        $menuDelDia = Category::where('name', 'menu del día')->first();        
        return view('menu/index2')->with(compact('categories', 'menuDelDia'));
    }

    public function index3(){
        $categories = Category::orderBy('name')->get();      
        $menuDelDia = Category::where('name', 'menu del día')->first();  
        return view('menu/index3')->with(compact('categories', 'menuDelDia'));
    }

    public function index4(){
        $categories = Category::orderBy('name')->get();               
        $menuDelDia = Category::where('name', 'menu del día')->first(); 
        return view('menu/index4')->with(compact('categories', 'menuDelDia'));
    }    
}
