<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contact(Request $request){
       
        //dd($request->all());
        $for = "info@lacarreta.com.es";
        $subject = "Consultas de la Web lacarreta.com.es";
        //dd($subject);
        //  Mail::send("email.consultaEmail",$request->all(), function($msj) use($subject,$for){
        //     $msj->from("info@lacarreta.com.es","Consultas Restaurante La Carreta");
        //     $msj->subject($subject);
        //     $msj->to($for);
        // });    
        Mail::send('email.consultaEmail',  $request->all(), function ($m) use ($subject,$for) {
            $m->from('info@lacarreta.com.es', 'Consultas Restaurante La Carreta');

            $m->to("info@lacarreta.com.es")->subject('Consultas Restaurante La Carreta');
        });   
       
        return redirect('/');
    }
}
