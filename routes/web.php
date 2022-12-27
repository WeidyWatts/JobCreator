<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\AnexoController;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\NetworkingController;
use App\Http\Controllers\AdministracaoController;
use App\Http\Controllers\MonitoramentoController;
use App\Http\Controllers\TimesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JourneyRegistradaController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\NotificacaoController;


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
        'journey'   => JourneyController::class,
        'modulo'    => ModuloController::class,
        'curriculo' => CurriculoController::class,
        'entrevista' => EntrevistaController::class,
        'networking' => NetworkingController::class,
        'administracao' => AdministracaoController::class,
        'monitoramento' => MonitoramentoController::class,
        'time'      => TimesController::class,
        'usuario'   =>UsuarioController::class,
        'journey-registrada'   =>JourneyRegistradaController::class,
        'favoritos' => FavoritosController::class,
        'notificacao' => NotificacaoController::class,

    ]);

    Route::post('teste/qustao',[TesteController::class, 'questaoStore'])->name('teste.questao.store');
    Route::post('teste/qustao/{id}',[TesteController::class, 'questaoUpdate'])->name('teste.questao.update');
    Route::post('teste/qustao/destroy',[TesteController::class, 'questaoDestroy'])->name('teste.questao.destroy');
    Route::get('teste/opcao/destroy/{id}',[TesteController::class, 'opcaoDestroy'])->name('teste.opcao.destroy');
    Route::get('/anexoDownload/{filename}',[AnexoController::class, 'download'])->name('anexo.download');
    Route::get('/getAnexoJson', [AnexoController::class, 'getSelect2Json'])->name('anexo.getJson');
    Route::get('/getArtigoJson', [ArtigoController::class, 'getSelect2Json'])->name('artigo.getJson');
    Route::get('/getLinkJson', [LinkController::class, 'getSelect2Json'])->name('link.getJson');
    Route::get('/getTesteJson', [TesteController::class, 'getSelect2Json'])->name('teste.getJson');
    Route::get('/getVideoJson', [VideoController::class, 'getSelect2Json'])->name('video.getJson');
    Route::get('/curriculoDownload/{filename}',[CurriculoController::class, 'download'])->name('curriculo.download');
    Route::get('/entrevistaDownload/{filename}',[EntrevistaController::class, 'download'])->name('entrevista.download');
    Route::get('/networkingDownload/{filename}',[NetworkingController::class, 'download'])->name('networking.download');
    Route::get('/getUserTimeJson', [TimesController::class, 'getSelect2Json'])->name('user.time.getJson');
    Route::get('/getUserTimeGerenteJson', [TimesController::class, 'getSelect2JsonGerente'])->name('user.time.getJsonGerente');
    Route::get('/time/user/remove/{user_id}/{time_id}', [TimesController::class,'UserRemove'])->name('time.user.remove');

    Route::get('primeiro-acesso', [RegisteredUserController::class, 'PrimeiroAcesso'])
        ->name('primeiro-acesso');

    Route::post('altera-senha', [RegisteredUserController::class, 'AlteraSenha'])
        ->name('altera-senha');

    Route::get('/monitoramento/getRelatorioJson/{empresaId}',[MonitoramentoController::class, 'getRelatorioJson'])->name('getRelatorioJson');

    Route::post('central-atendimento', [UsuarioController::class, 'centralAtendimento'])->name('central-atendimento.send');

    Route::post('notificacao/ver', [NotificacaoController::class, 'ver'])
        ->name('notificacao.ver');
});

require __DIR__.'/auth.php';
