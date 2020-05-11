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

Route::get('/home', 'HomeController@index')->name('home');

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

Route::prefix('admin')->namespace('Admin\Catering')->middleware(['auth'])
    ->group(function () {
        //rutas de catering
        Route::get('caterings', 'CateringController@index'); // listado
        Route::get('/caterings/create', 'CateringController@create'); // formulario
        Route::post('/caterings', 'CateringController@store'); // registrar
        Route::get('/caterings/{category}/edit', 'CateringController@edit'); // formulario edición
        Route::post('/caterings/{category}/edit', 'CateringController@update'); // actualizar
        Route::delete('/caterings', 'CateringController@destroy'); // form eliminar               
});

Route::prefix('admin/recipes')->namespace('Admin\Recipe')->middleware(['auth'])
    ->group(function () {
        //rutas de categorias del recetario
        Route::get('categories', 'CategoryController@index'); // listado
        Route::get('/categories/create', 'CategoryController@create'); // formulario
        Route::post('/categories', 'CategoryController@store'); // registrar
        Route::get('/categories/{category}/edit', 'CategoryController@edit'); // formulario edición
        Route::post('/categories/{category}/edit', 'CategoryController@update'); // actualizar
        Route::delete('/categories', 'CategoryController@destroy'); // form eliminar       
});
Route::prefix('admin/')->namespace('Admin\Recipe')->middleware(['auth'])
    ->group(function () {
        //rutas de recetas
        Route::get('recipes', 'RecipeController@index'); // listado
        Route::get('/recipes/create', 'RecipeController@create'); // formulario
        Route::post('/recipes/agregar-imagen', 'RecipeController@addImage'); // formulario
        Route::delete('/recipes/eliminar-imagen', 'RecipeController@deleteImage'); // formulario
        Route::post('/recipes', 'RecipeController@store'); // registrar
        Route::get('/recipes/{category}/edit', 'RecipeController@edit'); // formulario edición
        Route::post('/recipes/{category}/edit', 'RecipeController@update'); // actualizar
        Route::delete('/recipes', 'RecipeController@destroy'); // form eliminar

        Route::get('/recipes/{id}/images', 'RecipeController@indeximage'); 
});