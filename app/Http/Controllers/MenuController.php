<?php

namespace App\Http\Controllers;
use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        

        return view('welcome')
            ->with(compact('caterings','breakfasts1','breakfasts2',
                            'meets1', 'meets2',
                            'iberico2', 'iberico1', 'recipes', 'menu' ));
    }
}
