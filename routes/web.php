<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\AnexoController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\VideoController;

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
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

    Route::resources([
        'conta' =>  ContaController::class,
        'anexo' =>  AnexoController::class,
        'artigo'=>  ArtigoController::class,
        'link'  =>  LinkController::class,
        'video' =>  VideoController::class

    ]);


Route::get('/anexoDownload/{filename}',[AnexoController::class, 'download'])->name('anexo.download');
require __DIR__.'/auth.php';
