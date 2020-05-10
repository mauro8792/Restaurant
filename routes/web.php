<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/users', 'UserController@index'); // listado
    Route::post('/users/edit', 'UserController@update'); // actualizar
    Route::delete('/users', 'UserController@destroy'); // eliminar
    Route::post('/users/add', 'UserController@store'); // agregar
});    