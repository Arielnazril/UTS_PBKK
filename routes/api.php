<?php

use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookAuthorController;
use App\Http\Controllers\BooksAuthorController;
use App\Http\Controllers\DashboardController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('user', UsersController::class);
    Route::apiResource('book', BooksController::class);
    Route::apiResource('author', AuthorsController::class);
    Route::apiResource('loans', LoansController::class);
    Route::apiResource('book-author', BooksAuthorController::class);
    Route::get('/dashboard', [DashboardController::class, 'index']);
   
});