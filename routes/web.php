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

Route::get('/', 'WelcomeController@index');
Route::get('/home', 'WelcomeController@index')->name('home');
Route::get('/sabout', function(){
    return redirect()->to(route('home').'#section-about');
});
Route::get('/smenu', function(){
    return redirect()->to(route('home').'#section-menu');
});
Route::get('/srecipes', function(){
    return redirect()->to(route('home').'#section-recipes');
});
Route::get('/sgallery', function(){
    return redirect()->to(route('home').'#section-gallery');
});
Route::get('/scatering', function(){
    return redirect()->to(route('home').'#section-catering');
});
Route::get('/scontact', function(){
    return redirect()->to(route('home').'#section-contact');
});

Auth::routes();

Route::get('/menu', 'MenuController@index');
Route::get('/menu1', 'MenuController@index1');
Route::get('/menu2', 'MenuController@index2');
Route::get('/menu3', 'MenuController@index3');
Route::get('/recetas', 'RecipesController@index');
Route::get('/caterings', 'CateringsController@index');

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
        Route::get('/categories/{id}/estatus', 'CategoryController@changeState'); // formulario
        //rutas de productos del menu
        Route::get('/categories/{id}/products', 'ProductController@index'); // listado
        Route::get('/categories/{id}/products/create', 'ProductController@create'); // formulario
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
        Route::get('/caterings/{id}/edit', 'CateringController@edit'); // formulario edición
        Route::post('/caterings/{id}/edit', 'CateringController@update'); // actualizar
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
        Route::get('/recipe-book/{id}/recipes', 'RecipeController@index'); // listado
        Route::get('/recipe-book/{id}/recipes/create', 'RecipeController@create'); // formulario
        Route::post('/recipes/agregar-imagen', 'RecipeController@addImage'); // formulario
        Route::delete('/recipes/eliminar-imagen', 'RecipeController@deleteImage'); // formulario
        Route::post('/recipes', 'RecipeController@store'); // registrar
        Route::get('/recipes/{category}/edit', 'RecipeController@edit'); // formulario edición
        Route::post('/recipes/{category}/edit', 'RecipeController@update'); // actualizar
        Route::delete('/recipes', 'RecipeController@destroy'); // form eliminar

        Route::get('/recipes/{id}/images', 'RecipeController@indeximage'); 
});