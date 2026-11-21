<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Mengarahkan URL utama dan /books ke method index di BookController
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books', [BookController::class, 'index'])->name('books.index');