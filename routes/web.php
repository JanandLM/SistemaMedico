<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

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
    return view('auth.login');
});

/*Route::get('/paciente', function () {
    return view('paciente.index');
});
Route::get('/paciente/create', [PacienteController::class,'create']);
*/
Route::resource('paciente', PacienteController::class)->middleware('auth');
Auth::routes(['register'=>true,'reset'=>true]);

Route::get('/home', [PacienteController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function () {
    Route::get('/', [PacienteController::class, 'index'])->name('home');
});