<?php

use App\Http\Controllers\DrugController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo');

    Route::post('/todo', [TodoController::class, 'saveTodo'])->name('todo.post');

    Route::delete('/todo/delete/{id}', [TodoController::class, 'deleteTodo'])->name('todo.delete');

    Route::get('/todo/edit/{id}', [TodoController::class, 'editTodo'])->name('todo.edit');
    Route::put('/todo/edit/post/{id}', [TodoController::class, 'postEditTodo'])->name('todo.post.edit');

    Route::get('/drugs', [DrugController::class, 'index'])->name('drugs.index');
    Route::post('/drugs', [DrugController::class, 'postObat'])->name('drugs.post');
    Route::post('/drugs/incoming', [IncomingController::class, 'postIncoming'])->name('drugs.postIncoming');
});
