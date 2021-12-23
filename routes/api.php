<?php

use Illuminate\Http\Request;
use App\Http\Resources\VendorResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 
//User routes
Route::get('/registeredUsers', 'AuthController@get_all_users')->name('allUsers'); 
Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login');
Route::get('/User/{id}', 'AuthController@getParticularUser')->name('particularUser');
Route::put('/User/{id}', 'AuthController@update')->name('user');
Route::delete('/User/{id}', 'AuthController@destroy')->name('removeUser');

//to return authenticated user
Route::middleware('auth:sanctum')->group(function (){
Route::get('/loggedInUser', 'AuthController@loggedInUser');
Route::post('/logout', 'AuthController@logout');
});


//Asset routes
Route::get('/products','AssetsController@allProducts')->name('allProducts');
Route::get('/products/{id}', 'AssetsController@getParticularProduct')->name('particularProduct');
Route::post('/products/create','AssetsController@create')->name('addProduct');
Route::put('/products/{id}','AssetsController@update')->name('updateProduct');
Route::delete('/products/{id}','AssetsController@destroy')->name('removeProduct');

//Vendor routes
Route::get('/vendors', 'VendorController@index')->name('allVendors');
Route::get('/vendors/{id}', 'VendorController@show')->name('particularVendor');
Route::post('/vendors/create','VendorController@create')->name('addVendor');
Route::put('/vendors/{id}','VendorController@update')->name('updateVendor');
Route::delete('/vendors/{id}','VendorController@destroy')->name('removeVendor');

//Asset Assignment routes
Route::get('/assignments', 'AssignmentController@index');
Route::get('/assignments/{id}', 'AssignmentController@show');
Route::post('/assignments/create','AssignmentController@create');
Route::put('/assignments/{id}/update','AssignmentController@update');
Route::delete('/assignments/{id}/delete','AssignmentController@destroy');

