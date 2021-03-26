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


Route::resource('/ingridient', 'IngridientsController', ['except' => ['update', 'delete']])->middleware('can:edit-ingr');

Route::namespace('Admin')->prefix('Admin')->name('admin')->group( function(){
    Route::resource('/users', 'UsersController');
    Route::post('/user/delete/{id}', 'UsersController@deleteAjax')->name('userDeleteAjax');
    Route::post('/user/custome/{id}', 'UsersController@updateAjax')->name('userUpdateAjax');
    Route::get('/user/info/{id}', 'UsersController@userInfo')->name('user.info');
} );

//ajax routes for ingridients
Route::name('ingridient')->middleware('can:edit-ingr')->group( function(){
    Route::post('/ingridient/{id}', 'IngridientsController@updateAjax')->name('updateAjax');
    Route::post('/ingridient/delete/{id}', 'IngridientsController@deleteAjax')->name('deleteAjax');
});



