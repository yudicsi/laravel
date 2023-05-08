<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\__aaa\Controllers\User_Ctrl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
Route::post('register', [RegisterController::class, 'register']);
*/

Route::get('login', function() {
    return response()->json(['message' => 'Unauthorized.'], 401);
});


Route::get('User-1', [user_Ctrl::class, 'index']);
Route::get('User', [user_Ctrl::class, 'index']);
Route::get('user', [user_Ctrl::class, 'edit']);
Route::post('user', [user_Ctrl::class, 'store']);
Route::put('user', [user_Ctrl::class, 'update']);
Route::delete('user', [user_Ctrl::class, 'destroy']);
Route::get('logout', [RegisterController::class, 'logout']);
Route::post('login', [RegisterController::class, 'login']);



Route::middleware('user_accessible')->group(function () {
//	Route::middleware('auth:api')->group(function () {
  

});


/*

Route::middleware(['auth:api','user_accessible'])->group(function () {
  // Route::get('User', [user_Ctrl::class, 'index']);

});

*/