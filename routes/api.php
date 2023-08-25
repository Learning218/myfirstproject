<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route:: get('roles', [RoleController::class, 'index']);
//Route:: get('roles_search/{id}', [RoleController::class, 'show']);

Route:: apiResource('roles', RoleController::class);
Route:: apiResource('users', UserController::class);

//Route:: get('users', [UserController::class, 'index']);
//Route:: get('users_search/{id}', [UserController::class, 'show']);



