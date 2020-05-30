<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Catering;

class CateringsController extends Controller
{
    public function index(){    
        $caterings = Catering::all();
        return view('caterings')->with(compact('caterings'));
    }
}
