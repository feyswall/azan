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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/ingridient', 'IngridientsController', ['except' => ['update', 'delete']]);

//ajax routes for ingridients
Route::post('/ingridient/{id}', 'IngridientsController@updateAjax')->name('ingridient.updateAjax');
Route::post('/ingridient/delete/{id}', 'IngridientsController@deleteAjax')->name('ingridient.updateAjax');

