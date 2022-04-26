<?php


use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\TransmitterController;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'api'], function($router) {
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices-search', [InvoiceController::class, 'search']);
    Route::resource('items', ItemController::class);
    Route::resource('receivers', ReceiverController::class);
    Route::resource('transmitters', TransmitterController::class);

    Route::post('/register', [JWTController::class, 'register']);
    Route::post('/login', [JWTController::class, 'login']);
    Route::post('/logout', [JWTController::class, 'logout']);
    Route::post('/refresh', [JWTController::class, 'refresh']);
    Route::post('/me', [JWTController::class, 'me']);
});

