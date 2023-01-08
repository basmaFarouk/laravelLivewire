<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\UploadFiles;
use App\Models\Comment;
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

// Route::get('/', function () {
//     // $comments=Comment::with('creator')->get();
//     return view('welcome');
// });

// Route::livewire('/','home');
Route::get('/',Home::class)->name('home')->middleware('auth');
Route::get('/login',Login::class)->name('login')->middleware('guest');
Route::get('/register',Register::class)->name('register');
Route::get('/upload',UploadFiles::class)->name('uploadFiles');
