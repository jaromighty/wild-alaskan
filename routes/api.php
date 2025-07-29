<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RecipeSearchController;
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

Route::get('search', RecipeSearchController::class)->name('search');

Route::get('authors', [AuthorController::class, 'index'])->name('authors');
