<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CivilController;
use App\Http\Controllers\FileUploadController;

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

Route::resource('contract', ContractController::class);
Route::get('/pendingContracts', [ContractController::class, 'pending'])->name('pendingContracts');
Route::get('/decisionContract/{id}/{decision}', [ContractController::class, 'decisionContract'])->name('decisionContract');
Route::get('/pdf/{ref}', [ContractController::class, 'contractDisplay'])->name('contractDisplay');

Route::resource('civil', CivilController::class);