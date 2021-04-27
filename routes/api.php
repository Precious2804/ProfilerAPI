<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilerController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("users", [ProfilerController::class, 'showMembers']);
Route::post("add_user", [ProfilerController::class, 'addMember']);
Route::get("artisans", [ProfilerController::class, 'showArtisans']);
Route::post("add_artisans", [ProfilerController::class, 'addArtisans']);
Route::get("requests", [ProfilerController::class, 'showRequests']);
Route::post("add_requests", [ProfilerController::class, 'addRequests']);
Route::delete("delete_user/{id}", [ProfilerController::class, 'deleteMember']);
Route::delete("delete/{id}", [ProfilerController::class, 'deleteArtisan']);
