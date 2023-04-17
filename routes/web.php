<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Chatbot\ChatBotController;
use App\Http\Controllers\admin\chatBotAdminController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//chatbot
Route::match(['get', 'post'], '/botman',[ChatBotController::class,'handle']);
require __DIR__.'/auth.php';

//admin
Route::GET('/chatAdmin',[chatBotAdminController::class, 'index']);
Route::GET('/makeChat',[chatBotAdminController::class, 'MakeChatShow']);
Route::GET('/userListByIp',[chatBotAdminController::class, 'userShowByIP'])->name('userList.ip');
