<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



# 普通用户登录
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class,'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class,'me'])->name('me')->middleware(['jwt.role:user', 'jwt.auth']);
    //如果不走中间件则不用加—>middleware
});

# 后台用户登录
//Route::group([
//    'prefix' => 'admin',
//    'namespace' => 'Admin'
//], function () {
//    Route::post('login', [\App\Http\Controllers\Admin\LoginController::class,'login']);
//    Route::post('logout', [\App\Http\Controllers\Admin\LoginController::class,'logout']);
//    Route::post('refresh', [\App\Http\Controllers\Admin\LoginController::class,'refresh']);
//    Route::post('me', [\App\Http\Controllers\Admin\LoginController::class,'me'])->name('me')->middleware(['jwt.role:admin', 'jwt.auth']);
//});
