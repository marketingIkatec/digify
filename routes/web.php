<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;  
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Admin\BlogController;  
use App\Http\Controllers\Admin\NaMidiaController;  
use App\Http\Controllers\Admin\SiteController;
use App\Services\VisitasService; 
use App\Http\Controllers\LeadAppController; 
use App\Models\LeadContato;

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

Route::middleware('registrar.visita')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');    

    Route::get('/blog', [BlogController::class, 'blogSiteIndex'])->name('blog.site.index');
    Route::get('/blog/autor/{autor}', [BlogController::class, 'blogSiteIndex'])->name('blog.autor.site.show');
    Route::get('/blog/categoria/{categoria}', [BlogController::class, 'blogSiteIndex'])->name('blog.categoria.site.show');
    Route::get('/blog/{slug_blog}', [BlogController::class, 'blogSiteShow'])->name('blog.site.show');

    Route::get('/calculadora', [CalculatorController::class, 'index'])->name('calculadora');

    Route::post('/lead-contato', [LeadAppController::class, 'leadContatoStore'])->name('lead.leadContato.store');
    Route::post('/form-custom-store', [LeadAppController::class, 'formCustomStore'])->name('form.custom.store');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

Route::middleware('registrar.visita')->group(function () {
    Route::fallback([SiteController::class, 'showSite'])->name('site.show');
});

Route::get('/send-contato', function () {
    $hubSpot = new \App\Services\HubspotCampaignService();

    $lead = LeadContato::find(3);
    return $hubSpot->enviarLeadForm($lead);
});

Route::get('/whatsapp/enviar', function (\Illuminate\Http\Request $request) {
    $telefone = $request->get('telefone');
    $mensagem = 'Apenas uma mensagem de teste para verificar o telefone de whatsapp.';

    return redirect()->away(
        'https://wa.me/' . $telefone . '?text=' . urlencode($mensagem)
    );
})->name('whatsapp.enviar');
