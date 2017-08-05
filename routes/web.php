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
    return view('index');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::resource('events', 'EventController', [
        'names' => [
            'index' => 'events',
            'create' => 'events.create',
            'store' => 'events.store',
            'show' => 'events.show',
            'edit' => 'events.edit',
            'update' => 'events.update',
            'destroy' => 'events.destroy',
        ]
    ]);

    Route::resource('events.purchases', 'PurchaseController', [
        'names' => [
            'index' => 'purchases',
            'create' => 'purchases.create',
            'store' => 'purchases.store',
            'show' => 'purchases.show',
            'edit' => 'purchases.edit',
            'update' => 'purchases.update',
            'destroy' => 'purchases.destroy',
        ]
    ]);

    Route::resource('events.buyers', 'BuyerController', [
        'names' => [
            'index' => 'buyers',
            'create' => 'buyers.create',
            'store' => 'buyers.store',
            'show' => 'buyers.show',
            'edit' => 'buyers.edit',
            'update' => 'buyers.update',
            'destroy' => 'buyers.destroy',
        ]
    ]);

    Route::post('events/{event}/purchases/{purchase}/saveAmounts', 'BuyerController@saveAmounts')
        ->name('buyers.saveAmounts');

});
