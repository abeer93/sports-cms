<?php

use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SeasonWeekController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SeasonController::class, 'index']);
Route::resource('/seasons', SeasonController::class);
Route::resource('/seasons-weeks', SeasonWeekController::class);
Route::resource('/matches', MatchController::class);
Route::get('/json-apis', [ApiDocumentationController::class, 'jsonApisDoc']);
