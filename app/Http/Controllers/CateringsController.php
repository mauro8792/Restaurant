<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Catering;

class CateringsController extends Controller
{
    public function index(){    
        $caterings = Catering::all();
        return view('catering/index')->with(compact('caterings'));
    }

    public function show($id){
        $catering = Catering::find($id);
        return view('catering.show')->with(compact('catering'));
    }    
}
