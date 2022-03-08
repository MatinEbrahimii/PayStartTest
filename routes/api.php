<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'users/'], function () {

    Route::post('', [UserController::class, 'store']);
    Route::get('{user_id}', [UserController::class, 'show']);

    Route::group(['prefix' => '{user_id}/accounts/'], function () {

        Route::post('{account_id}/transfer', [AccountController::class, 'transfer']);
        Route::post('', [AccountController::class, 'storeAccountDetails']);
    });

    Route::group(['prefix' => '{user_id}/reports/transactions/'], function () {
        Route::post('{payment_number}', [ReportController::class, 'getTransactions']);
    });
});
