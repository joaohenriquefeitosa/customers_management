<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Group\GroupController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'group'], function () {
    Route::get('', [GroupController::class, 'index'])->name('group.index');
    Route::get('{id}', [GroupController::class, 'show'])->name('group.show');
    Route::post('store', [GroupController::class, 'store'])->name('group.store');
    Route::put('{id}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('{id}', [GroupController::class, 'destroy'])->name('group.destroy');
});
