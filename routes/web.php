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


Route::name('')->middleware('can:manage-product')->group( function(){
    Route::resource('/product', 'ProductsController');
});


Route::name('')->group( function(){
    Route::resource('/sales', 'SalesController');
    Route::post('/sales/custome/{id}', 'SalesController@salesUpdateAjax' )->name('sales.custome');
    Route::post('/sales/custome/del/{id}', 'SalesController@salesDeleteAjax' )->name('sales.custome.del');
    Route::get('/sales/custome/deleted', 'SalesController@deletedSales')->name('sales.deleted');
    Route::post('/sales/custome/delete/fromto', 'SalesController@deletedFromToSales' )->name('sales.delete.fromto');
        Route::post('/sales/custome/pdf/fromto', 'SalesController@sales_pdf_data_from_to' )->name('sales.pdf.fromto');
    Route::get('/sales/custome/pdf', 'SalesController@conv_pdf')->name('sales.custome.pdf');
});

Route::name('')->group( function(){
    Route::resource('/stock', 'StocksController');
});

Route::name('')->group( function(){
    Route::resource('/damaged', 'DamagesController');
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group( function(){
    Route::resource('/users', 'UsersController');
    Route::post('/user/delete/{id}', 'UsersController@deleteAjax')->name('userDeleteAjax');
    Route::post('/user/custome/{id}', 'UsersController@updateAjax')->name('userUpdateAjax');
    Route::get('/user/info/{id}', 'UsersController@userInfo')->name('user.info');
});
// Normal user 'user routes'
 Route::get('/user/profile', 'HomeController@userProfile')->name('user.profile');
 Route::post('/user/change/password', 'HomeController@changePassword')->name('user.change.password');

//ajax routes for ingridients
Route::name('ingridient')->middleware('can:edit-ingr')->group( function(){
    Route::post('/ingridient/{id}', 'IngridientsController@updateAjax')->name('updateAjax');
    Route::post('/ingridient/delete/{id}', 'IngridientsController@deleteAjax')->name('deleteAjax');
});


Route::get('sale/conv_pdf', 'DynamicPDFController@conv_pdf')->name('sales.pdf');

