<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\NaMidiaController;
use App\Http\Controllers\Admin\LinkSiteController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\LeadAppController;
use App\Http\Controllers\Admin\UploadFilesController;
use App\Services\HubspotCampaignService;
use Illuminate\Support\Facades\Route;
use App\Models\LeadContato;
use App\Models\LeadWhatsApp;
use App\Models\LeadCustomContato;

Route::prefix('admin')->middleware('auth', 'admin.permission')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    Route::get('/setting/site', [SettingController::class, 'settingSiteIndex'])->name('admin.setting.site.index');
    Route::patch('/setting/site/update', [SettingController::class, 'settingSiteUpdate'])->name('admin.setting.site.update');
    
    Route::get('/setting/popup', [SettingController::class, 'settingPopupIndex'])->name('admin.setting.popup.index');
    Route::get('setting/popup/create', [SettingController::class, 'settingPopupCreate'])->name('admin.setting.popup.create');
    Route::get('setting/popup/edit/{item}', [SettingController::class, 'settingPopupEdit'])->name('admin.setting.popup.edit')->where(['item' => '[0-9]+']);
    Route::post('/setting/popup/store', [SettingController::class, 'settingPopupStore'])->name('admin.setting.popup.store');

    Route::get('/setting/hubspot', [SettingController::class, 'settingHubSpotIndex'])->name('admin.setting.hubspot.index');
    Route::get('setting/hubspot/create', [SettingController::class, 'settingHubSpotCreate'])->name('admin.setting.hubspot.create');
    Route::get('setting/hubspot/edit/{item}', [SettingController::class, 'settingHubSpotEdit'])->name('admin.setting.hubspot.edit')->where(['item' => '[0-9]+']);
    Route::post('/setting/hubspot/store', [SettingController::class, 'settingHubSpotStore'])->name('admin.setting.hubspot.store');
    
    Route::get('/setting/menu', [SettingController::class, 'settingMenuIndex'])->name('admin.setting.menu.index');
    Route::get('setting/menu/create', [SettingController::class, 'settingMenuCreate'])->name('admin.setting.menu.create');
    Route::get('setting/menu/edit/{item}', [SettingController::class, 'settingMenuEdit'])->name('admin.setting.menu.edit')->where(['item' => '[0-9]+']);
    Route::post('/setting/menu/store', [SettingController::class, 'settingMenuStore'])->name('admin.setting.menu.store');
    
    Route::get('/lead/whatsapp', [LeadAppController::class, 'viewLead'])->name('admin.lead.whatsapp');
    Route::get('/lead/custom', [LeadAppController::class, 'viewLead'])->name('admin.lead.custom');
    Route::get('/lead/contato', [LeadAppController::class, 'viewLead'])->name('admin.lead.contato');
    Route::get('/lead/report/', [LeadAppController::class, 'dashboard'])->name('admin.lead.report');
    Route::post('/lead/report/enviar-email', [LeadAppController::class, 'dashboard'])->name('admin.lead.report.email.send');
    
    Route::get('blogs/categoria', [BlogController::class, 'indexCategoria'])->name('admin.blog.categoria.index');
    Route::get('blogs/categoria/create', [BlogController::class, 'createCategoria'])->name('admin.blog.categoria.create');
    Route::get('blogs/categoria/edit/{item}', [BlogController::class, 'editCategoria'])->name('admin.blog.categoria.edit')->where(['item' => '[0-9]+']);
    Route::post('blogs/categoria/store', [BlogController::class, 'storeCategoria'])->name('admin.blog.categoria.store');
    Route::delete('blogs/categoria/destroy/{item}', [BlogController::class, 'destroyCategoria'])->name('admin.blog.categoria.destroy')->where(['id' => '[0-9]+']);

    Route::get('blogs/autor', [BlogController::class, 'indexAutor'])->name('admin.blog.autor.index');
    Route::get('blogs/autor/create', [BlogController::class, 'createAutor'])->name('admin.blog.autor.create');
    Route::get('blogs/autor/edit/{item}', [BlogController::class, 'editAutor'])->name('admin.blog.autor.edit')->where(['item' => '[0-9]+']);
    Route::post('blogs/autor/store', [BlogController::class, 'storeAutor'])->name('admin.blog.autor.store');
    Route::delete('blogs/autor/destroy/{item}', [BlogController::class, 'destroyAutor'])->name('admin.blog.autor.destroy')->where(['id' => '[0-9]+']);
    //Route::patch('blogs/alterar-status/{name}/{id}', [BlogController::class, 'alterarStatus'])->name('admin.blog.alterar.status');
    
    Route::patch('alterar-status/{name}/{id}', [AdminController::class, 'alterarStatus'])->name('admin.alterar.status');

    Route::resource('blogs', BlogController::class)->where(['blog' => '[0-9]+']);

    Route::post('/upload/files', [UploadFilesController::class, 'uploadCkeditor'])->name('upload.files.ckeditor');
    Route::post('/upload/temp', [UploadFilesController::class, 'uploadTemp'])->name('admin.upload.temp');
    Route::post('/upload/delete/temp', [UploadFilesController::class, 'deleteTemp'])->name('admin.upload.temp.delete');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.editar');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/setting/user', [ProfileController::class, 'index'])->name('admin.setting.user.index');
    Route::get('setting/user/create', [ProfileController::class, 'settingUserCreate'])->name('admin.setting.user.create');
    Route::get('setting/user/edit/{item}', [ProfileController::class, 'settingUserEdit'])->name('admin.setting.user.edit')->where(['item' => '[0-9]+']);
    Route::post('/setting/user/store', [ProfileController::class, 'settingUserStore'])->name('admin.setting.user.store');

    //Route::get('/site', [SiteController::class, 'index'])->name('admin.site');
    //Route::resource('site', SiteController::class);

    Route::get('site/pagina', [SiteController::class, 'indexPage'])->name('admin.site.page.index');
    Route::get('site/pagina/create', [SiteController::class, 'createPage'])->name('admin.site.page.create');
    Route::get('site/pagina/edit/{item}', [SiteController::class, 'editPage'])->name('admin.site.page.edit')->where(['item' => '[0-9]+']);
    Route::post('site/pagina/store', [SiteController::class, 'storePage'])->name('admin.site.page.store');
    Route::delete('site/pagina/destroy/{item}', [SiteController::class, 'destroyPage'])->name('admin.site.page.destroy')->where(['id' => '[0-9]+']);
    
    Route::post('site/pagina/block/store', [SiteController::class, 'storePageBlock'])->name('admin.site.page.block.store');
    Route::get('site/{page}/block/', [SiteController::class, 'editPageBlock'])->name('admin.site.page.block');
    Route::get('site/{page}/block/{item}', [SiteController::class, 'editPageBlock'])->name('admin.site.page.block.edit');
    Route::get('site/block/{item}', [SiteController::class, 'showPageBlock'])->name('admin.site.page.block.show')->where(['id' => '[0-9]+']);
     
    Route::get('site/upload/', [UploadFilesController::class, 'index'])->name('admin.site.upload.index');
    Route::get('site/upload/create', [UploadFilesController::class, 'create'])->name('admin.site.upload.create');
    Route::get('site/upload/edit/{item}', [UploadFilesController::class, 'edit'])->name('admin.site.upload.edit')->where(['item' => '[0-9]+']);
    Route::post('site/upload/store', [UploadFilesController::class, 'store'])->name('admin.site.upload.store');

    Route::get('/about', function (){
        return view('admin.pages.about');
    })->name('admin.about');

    Route::get('/send-contato-hubspot/{form}', function ($id) {
        $hubSpot = new \App\Services\HubspotCampaignService();
        $lead = LeadContato::find(2688);
        if(!empty($lead)){
            dd($hubSpot->enviarLeadCustomForm($lead));
        }
        echo 'lead não encontrado!'; die;
        
    })->name('admin.send-contato-hubspot');

        Route::get('/send-custom-hubspot/{form}', function ($id) {
        $hubSpot = new \App\Services\HubspotCampaignService();

        $lead = LeadCustomContato::find($id);
        dd($hubSpot->enviarLeadCustomForm($lead));
    })->name('admin.send-custom-hubspot');    

    Route::get('/view-contato-hubspot/{email}', function ($email) {
        $hubSpot = new \App\Services\HubspotCampaignService();

        dd($hubSpot->findContactByEmail($email));
    })->name('admin.view-contato-hubspot');  

    Route::get('/send-whatsapp-hubspot/{form}', function ($id) {
        $hubSpot = new \App\Services\HubspotCampaignService();

        $lead = LeadWhatsApp::find($id);
        dd($hubSpot->enviarLeadForm($lead));
    })->name('admin.send-whatsapp-hubspot');

    Route::get('/list-formulario/{form}', function ($form) {
        $hubSpot = new \App\Services\HubspotCampaignService();
        $saidaHtml = $hubSpot->listForm($form);
        return $saidaHtml;
    })->name('admin.list-formulario');

    Route::get('/list-formulario-json/{form}', function ($form) {
        $hubSpot = new \App\Services\HubspotCampaignService();
        $json = $hubSpot->listFormJson($form);
        dd($json);
    })->name('admin.list-formulario-json');

    
});
