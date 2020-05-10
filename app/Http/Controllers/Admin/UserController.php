<?php

namespace App\Http\Controllers\Admin;

use App\Code;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with(compact('users')); // listado
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'Es necesario ingresar un eMail.',
            'email.unique' => 'El eMail está en uso.',
            'email.email' => 'El eMail no es válido.',
        ];
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|string|unique:users'
        ];
        $this->validate($request, $rules, $messages);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save(); // UPDATE

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'Es necesario ingresar un eMail.',
            'email.unique' => 'El eMail está en uso.',
            'email.email' => 'El eMail no es válido.',
        ];
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|string|unique:users,id'
        ];
        $this->validate($request, $rules, $messages);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save(); // UPDATE

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
            $notification = "El registro se eliminó correctamente";
        } catch (QueryException $exception){
            $notification = "Error al eliminar el registro".$exception->getMessage();
        }

        return back()->with(compact('notification'));
    }
}
