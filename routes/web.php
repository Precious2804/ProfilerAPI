<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebProfilerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','App\Http\Controllers\WebProfilerController@index');
Route::view("login", 'login');
Route::view("register", 'register');
Route::view("artisan_register", 'artisan_register');
Route::post('artisan_register','App\Http\Controllers\WebProfilerController@regArtisan');
Route::view("artisan_login", 'artisan_login');
Route::post('artisan_login','App\Http\Controllers\WebProfilerController@loginArtisan');
