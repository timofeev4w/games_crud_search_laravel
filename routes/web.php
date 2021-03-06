<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesController;

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

Route::redirect('/', '/games');

Route::resource('/games', GamesController::class);
Route::post('/games/s/', [GamesController::class, 'searchRedirect']);
Route::get('/games/search/{genre_name}', [GamesController::class, 'search']);