<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', [UsersController::class, 'index']);

/**
 * BORROWERS
 */
Route::post('/borrow-book', [BookUserController::class, 'store']);
Route::post('/return-book', [BookUserController::class, 'destroy']);
Route::get('/get-books-borrowed', [BookUserController::class, 'getBorrowedBooks']);
Route::get('/get-borrowed-books/{user}', [BookUserController::class, 'index']);


/**
 * BOOkS
 */
Route::get('/get-books', [BookController::class, 'index']);
Route::post('/create-book', [BookController::class, 'store']);
Route::get('/show-book/{book}', [BookController::class, 'show']);
Route::delete('/delete-book/{book}', [BookController::class, 'destroy']);
Route::patch('/edit-book/{book}', [BookController::class, 'update']);
