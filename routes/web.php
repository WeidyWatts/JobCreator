<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\AnexoController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\JourneyController;

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

Route::group(['middleware'=>'auth'], function () {
    Route::resources([
        'conta'     => ContaController::class,
        'anexo'     => AnexoController::class,
        'artigo'    => ArtigoController::class,
        'link'      => LinkController::class,
        'teste'     => TesteController::class,
        'video'     => VideoController::class,
        'journey'   => JourneyController::class

    ]);

    Route::post('teste/qustao',[TesteController::class, 'questaoStore'])->name('teste.questao.store');
    Route::post('teste/qustao/{id}',[TesteController::class, 'questaoUpdate'])->name('teste.questao.update');
    Route::post('teste/qustao/destroy',[TesteController::class, 'questaoDestroy'])->name('teste.questao.destroy');
    Route::get('teste/opcao/destroy/{id}',[TesteController::class, 'opcaoDestroy'])->name('teste.opcao.destroy');
    Route::get('/anexoDownload/{filename}',[AnexoController::class, 'download'])->name('anexo.download');
});


require __DIR__.'/auth.php';
