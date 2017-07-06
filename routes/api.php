<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix'=>'sales'], function(){
    // get list of sales
    Route::get('/','SalesController@index');
    // get specific sale
    Route::get('/{id}','SalesController@show');
    // create new sale
    Route::post('/','SalesController@store');
});

Route::group(['prefix'=>'sellers'], function(){
    // get list of sellers
    Route::get('/','SellersController@index');
    // get specific sale
    Route::get('/{id}','SellersController@show');
    // create new sale
    Route::post('/','SellersController@store');
});