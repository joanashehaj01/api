<?php

use App\Http\Controllers\Book\BookController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'books', 'as' => 'book.', 'middleware' => 'auth:api'], function () {
    Route::get('/exist/{book}', [BookController::class, 'checkIfBookExist'])->name('exits');
    Route::get('/filter', [BookController::class, 'filterBooks'])->name('filter');
});
Route::resource('books', BookController::class)->except('edit', 'create')->middleware('auth:api');
