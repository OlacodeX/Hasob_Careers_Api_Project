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
Route::get('/registeredUsers', 'AuthController@get_all_users'); 
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/User/{id}', 'AuthController@getParticularUser');
Route::put('/User/{id}', 'AuthController@update');
Route::delete('/User/{id}', 'AuthController@destroy');

//to return authenticated user
Route::middleware('auth:sanctum')->group(function (){
Route::get('/loggedInUser', 'AuthController@loggedInUser');
Route::post('/logout', 'AuthController@logout');
});


//Asset routes
Route::get('/products','AssetsController@allProducts');
Route::get('/products/{id}', 'AssetsController@getParticularProduct');
Route::post('/products/create','AssetsController@create');
Route::put('/products/{id}/update','AssetsController@update');
Route::delete('/products/{id}/delete','AssetsController@destroy');

//Vendor routes
Route::get('/vendors', 'VendorController@index');
Route::get('/vendors/{id}', 'VendorController@show');
Route::post('/vendors/create','VendorController@create');
Route::put('/vendors/{id}/update','VendorController@update');
Route::delete('/vendors/{id}/delete','VendorController@destroy');

//Asset Assignment routes
Route::get('/assignments', 'AssignmentController@index');
Route::get('/assignments/{id}', 'AssignmentController@show');
Route::post('/assignments/create','AssignmentController@create');
Route::put('/assignments/{id}/update','AssignmentController@update');
Route::delete('/assignments/{id}/delete','AssignmentController@destroy');

