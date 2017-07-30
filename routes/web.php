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

    Route::resource('events.participants', 'ParticipantController', [
        'names' => [
            'index' => 'participants',
            'create' => 'participants.create',
            'store' => 'participants.store',
            'show' => 'participants.show',
            'edit' => 'participants.edit',
            'update' => 'participants.update',
            'destroy' => 'participants.destroy',
        ]
    ]);

});
