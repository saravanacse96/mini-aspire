<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\admin\AdminController;

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

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/loans1', [LoanController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
   /* Admin-Customer */
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

