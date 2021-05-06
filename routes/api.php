<?php

use App\Http\Controllers\Auth\MemberController;
use App\Http\Controllers\Auth\ArtisanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilerController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['auth:api', 'verify'])->group(function(){
    Route::get("users", [ProfilerController::class, 'showMembers']);
    Route::post("add_user", [ProfilerController::class, 'addMember']);
    Route::get("artisans", [ProfilerController::class, 'showArtisans']);
    Route::post("add_artisans", [ProfilerController::class, 'addArtisans']);
    Route::get("requests", [ProfilerController::class, 'showRequests']);
    Route::post("add_requests", [ProfilerController::class, 'addRequests']);
    Route::delete("delete_user/{id}", [ProfilerController::class, 'deleteMember']);
    Route::delete("delete/{id}", [ProfilerController::class, 'deleteArtisan']); 
});
    


// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::get('/user-profile', [AuthController::class, 'userProfile']);    
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [MemberController::class, 'login']);
    Route::post('/register', [MemberController::class, 'register']);
    Route::post('/logout', [MemberController::class, 'logout']);
    Route::post('/refresh', [MemberController::class, 'refresh']);
    Route::get('/user-profile', [MemberController::class, 'userProfile']);    
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/registerArt', [ArtisanController::class, 'registerArtisan']);
    Route::post('/logoutArt', [ArtisanController::class, 'logoutArtisan']);
    Route::post('/refreshArt', [ArtisanController::class, 'refreshArtisan']);
    Route::get('/art-profile', [ArtisanController::class, 'artProfile']);    
});

Route::post('/loginArt', [ArtisanController::class, 'loginArtisan']);