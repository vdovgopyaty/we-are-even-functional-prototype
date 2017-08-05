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

Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('events', 'EventController', ['only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]]);
    Route::resource('events.purchases', 'PurchaseController', ['only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]]);
    Route::resource('events.buyers', 'BuyerController', ['only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]]);

    Route::post('events/{event}/purchases/{purchase}/saveAmounts', 'BuyerController@saveAmounts')
        ->name('buyers.saveAmounts');
});
