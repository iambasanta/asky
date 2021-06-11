<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\FavouriteController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('questions', QuestionController::class)->except('show');
Route::resource('questions.answers', AnswerController::class)->only(['store', 'edit', 'update', 'destroy']);
Route::get('questions/{slug}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');

Route::post('/questions/{question}/favourites', [FavouriteController::class, 'store'])->name('questions.favourite');
Route::delete('/questions/{question}/favourites', [FavouriteController::class, 'destroy'])->name('questions.unfavourite');
