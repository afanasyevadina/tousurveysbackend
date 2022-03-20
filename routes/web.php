<?php

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

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('user');
    Route::get('/users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
    Route::get('/questions', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
    Route::post('/questions/mass-delete', [App\Http\Controllers\QuestionController::class, 'massDestroy'])->name('questions.mass-delete')->middleware('can:admin');
    Route::get('/questions/{id}', [App\Http\Controllers\QuestionController::class, 'view'])->name('question');
    Route::get('/questions/{id}/delete', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('questions.delete')->middleware('can:admin');
});
