<?php

use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/thread', ThreadController::class);
Route::get('/content/{thread}', 'App\Http\Controllers\ThreadController@content')->name('content');
Route::get('/reply/{thread}', 'App\Http\Controllers\ReplyController@store')->name('store');
Route::get('/reply{reply}', 'App\Http\Controllers\ReplyController@destroy')->name('destroy');

Auth::routes();

