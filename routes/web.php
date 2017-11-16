<?php

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

Route::get('/home', function () {
    return view('index');
});


Route::resource('authen/login','UserController');

Route::get('logout','Auth\LoginController@Logout');

Route::resource('administrator/user','ManagementController');

//route for listing filter by slug
Route::get('{slug}-c{id}', function($slug,$id){
	return view('layouts.slug_layout');
});
//route for single-product
Route::get('{productName}-p{id}', function($productName,$id){
	echo ('pruduct ' .$productName.' ' .$id);
});

