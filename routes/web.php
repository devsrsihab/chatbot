<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseController;
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


Route::middleware(['auth','verified'])->group(function(){

//admin
Route::GET('/chatAdmin',[chatBotAdminController::class, 'index']);
Route::GET('/chat',[ChatBotController::class, 'handle']);
Route::GET('/userListByIp',[chatBotAdminController::class, 'userShowByIP'])->name('userList.ip');
Route::DELETE('/deleteUserInfo/{id}',[chatBotAdminController::class, 'deleteUserInfo'])->name('deleteUserInfo');
Route::GET('/userInfo/pagination/',[chatBotAdminController::class, 'pagination']);

Route::GET('/keyword/pagination',[KeywordController::class,'pagination']);
Route::resource('/keywords', KeywordController::class);
Route::GET('/response/pagination',[ResponseController::class,'pagination']);
Route::resource('/responses', ResponseController::class);

});