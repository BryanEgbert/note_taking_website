<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserController;
use App\Models\Notes;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/register', [UserController::class, 'create']);

Route::post('/authenticate', [UserController::class, 'authenticate']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/logout', [UserController::class, 'logout']);

Route::resource('notes', NotesController::class)->middleware('auth');
