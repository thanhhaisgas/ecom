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


//product
Route::resource('administrator/user','ManagementController');
Route::resource('administrator/category','CategoryController');
Route::resource('administrator/product','ProductController');
Route::resource('administrator/image','ImageController');


// function ajax
Route::get('/ajax_insert_value/{id}','AjaxController@Get_Insert_Value');
Route::post('/ajax_insert_value_post','AjaxController@Post_Insert_Value');
Route::post('/ajax_insert_value_post_1','AjaxController@Post_Insert_Value_List');



//route for listing filter by slug
Route::get('{slug}-c{id}', function($slug,$id){
	return view('layouts.slug_layout');
});
//route for single-product
Route::get('{productName}/p{id}', function($productName,$id){
	echo ('pruduct ' .$productName.' ' .$id);
});

