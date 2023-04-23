<?php

use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/get-user', [UserController::class, 'index']);
  Route::patch('/users/update-theme', [UserController::class, 'updateTheme']);
  Route::patch('/users/{user}', [UserController::class, 'update']);

  Route::post('/users/upload-image', [UserController::class, 'uploadImage']);

  Route::get('/themes', [ThemeController::class, 'index']);

  Route::get('/links', [LinkController::class, 'index']);
  Route::post('/links', [LinkController::class, 'store']);
  Route::post('/links/upload-image', [LinkController::class, 'uploadImage']);
  Route::patch('/links/{link}', [LinkController::class, 'update']);
  Route::delete('/links/{link}', [LinkController::class, 'destroy']);
});
