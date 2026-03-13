<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

// ----------------- COMMENTS -----------------

// Модерация комментариев (только для модераторов)
Route::get('/comment', [CommentController::class, 'index'])
    ->middleware('auth')
    ->name('comments.moderation');

// Добавление комментария
Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// Редактирование комментария
Route::get('/comments/edit/{comment}', [CommentController::class, 'edit'])
    ->middleware('auth')
    ->name('comments.edit');

Route::post('/comments/update/{comment}', [CommentController::class, 'update'])
    ->middleware('auth')
    ->name('comments.update');

// Удаление комментария
Route::delete('/comments/{comment}', [CommentController::class, 'delete'])
    ->middleware('auth')
    ->name('comments.destroy');

// Одобрение комментария (модератор)
Route::patch('/comments/{comment}/accept', [CommentController::class, 'accept'])
    ->middleware('auth')
    ->name('comments.accept');

// Отклонение комментария (модератор)
Route::delete('/comments/{comment}/reject', [CommentController::class, 'reject'])
    ->middleware('auth')
    ->name('comments.reject');
// ----------------- ARTICLES -----------------
Route::resource('/article', ArticleController::class)
    ->middleware('auth');

// ----------------- AUTH -----------------
Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/registr', [AuthController::class, 'registr']);
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

// ----------------- MAIN -----------------
Route::get('/', [MainController::class, 'index']);
Route::get('/full_image/{img}', [MainController::class, 'show']);

Route::get('/about', function () {
    return view('main/about'); 
});

Route::get('/contact', function () {
    $array = [
        'name' => 'Moscow Polytech',
        'adres' => 'Pryaniki',
        'email' => 'tyt email',
        'phone' => '+7 666 66 66',
        'tg' => '@tyttg'
    ];
    return view('main/contact', ['contact'=> $array]); 
});
