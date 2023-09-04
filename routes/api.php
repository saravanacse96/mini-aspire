<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Loan\LoanController;
use App\Http\Controllers\Api\Admin\AdminController;

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
//testing pushing code
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

 /* Admin-Customer */
Route::group(['middleware' => ['auth:sanctum']], function () {
  
    Route::get('/loans', [LoanController::class, 'index']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

 /* Customer */
Route::group(['middleware' => ['auth:sanctum','isCustomer']], function () {
   Route::post('/create/loan-request', [LoanController::class, 'store']);
   Route::post('/loan/repayment', [LoanController::class, 'repayment']);
});

 /* Admin */
Route::group(['middleware' => ['auth:sanctum','isAdmin']], function () {
   Route::post('/loan-approve', [AdminController::class, 'approve']);
});

