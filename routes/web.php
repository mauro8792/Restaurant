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

Route::prefix('admin')->namespace('Admin\Menu')->middleware(['auth'])
    ->group(function () {
        //rutas de categorias del menu
        Route::get('categories', 'CategoryController@index'); // listado
        Route::get('/categories/create', 'CategoryController@create'); // formulario
        Route::post('/categories', 'CategoryController@store'); // registrar
        Route::get('/categories/{category}/edit', 'CategoryController@edit'); // formulario edición
        Route::post('/categories/{category}/edit', 'CategoryController@update'); // actualizar
        Route::delete('/categories', 'CategoryController@destroy'); // form eliminar
        //rutas de productos del menu
        Route::get('/products', 'ProductController@index'); // listado
        Route::get('/products/create', 'ProductController@create'); // formulario
        Route::post('/products', 'ProductController@store'); // registrar
        Route::get('/products/{id}/edit', 'ProductController@edit'); // formulario edición
        Route::post('/products/{id}/edit', 'ProductController@update'); // actualizar
        Route::delete('/products', 'ProductController@destroy'); // form eliminar
});

