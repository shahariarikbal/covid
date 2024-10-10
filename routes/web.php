<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\VaccineRegistrationController;
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

Route::get('/', [FrontendController::class, 'index']);

Route::group(['prefix' => 'vaccine', 'as' => 'vaccine.'], function(){
    Route::post('/register', [VaccineRegistrationController::class, 'store'])->name('register');
    Route::get('/list', [FrontendController::class, 'VaccineList'])->name('list');
});
