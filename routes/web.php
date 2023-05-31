<?php

use App\Http\Controllers\WelcomeController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/manuscript-support-from-text-file/{task?}', [WelcomeController::class, 'manuscriptSupportFromTextOrFile'])->name("manuscript.support.from.text.file");
// Route::get('/manuscript-support-from-file/{task?}', [WelcomeController::class, 'manuscriptSupportFromFile'])->name("manuscript.support.from.file");
// Route::post('/manuscript-support-from-file/{task?}', [WelcomeController::class, 'filepondUploadHandler'])->name("manuscript.support.from.file");
Route::post('/file-upload', [WelcomeController::class, 'filePondUploadHandler'])->name("manuscript.support.file.upload");


Route::get('/cite-from-abstract/{api?}', [WelcomeController::class, 'citeFromAbstract'])->name("cite.from.abstract");
Route::get('/pricing', [PricingController::class, 'index'])->name("pricing");