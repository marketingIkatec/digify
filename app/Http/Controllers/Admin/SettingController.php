<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\FormHubSpot;
use App\Models\MenuAdmin;
use App\Models\Page;
use App\Models\PagePopup;
use App\Models\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FormHubSpotRequest;
use App\Http\Requests\FormMenuAdminRequest;
use App\Http\Requests\PagePopupRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function settingSiteIndex(){

        $settings = Setting::all();

        $config = [];
        foreach ($settings as $item) {
            $config[$item['key']] = $item['value'];
        }

        return view('admin.pages.settings.index')->with('configuracao', $config);
    }

    public function settingSiteUpdate(Request $request): RedirectResponse
    {
        $data = $request->except(['logo_header', 'logo_footer', '_token', '_method', 'SaveButton']);
        foreach($data as $key=> $value){
            Setting::where('key', $key)->update([
                'value' => trim($value)
            ]);
        }

        if ($request->hasFile('logo_footer') || $request->hasFile('logo_header')) {
            if($request->hasFile('logo_header')){
                $titulo = \Str::slug(env('APP_NAME').'-logo-header');
                $extensao = $request->file('logo_header')->getClientOriginalExtension();
                $nomeArquivo = $titulo . '.' . $extensao;

                Setting::where('key', 'logo_header')->update([
                    'value' => $request->file('logo_header')->storeAs('logo', $nomeArquivo, 'public')
                ]);
            } else {
                $titulo = \Str::slug(env('APP_NAME').'-logo-footer');
                $extensao = $request->file('logo_footer')->getClientOriginalExtension();
                $nomeArquivo = $titulo . '.' . $extensao;

                Setting::where('key', 'logo_footer')->update([
                    'value' => $request->file('logo_footer')->storeAs('logo', $nomeArquivo, 'public')
                ]);
            }
        }

        return redirect()->back()->with('success', 'Configurações atualizadas com Sucesso!');
    }

    public function settingHubSpotIndex(Request $request){

        $query = FormHubSpot::query();

        // Filtro por form_name
        if ($request->filled('form_name')) {
            $query->where('form_name', 'like', '%' . $request->form_name . '%');
        }

        // Filtro por name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.settings.index-hubspot')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    public function settingHubSpotCreate()
    {
        return view('admin.pages.settings.cadastrar-hubspot');
    }

    public function settingHubSpotEdit($item)
    {
        $item = FormHubSpot::findOrFail($item);
        return view('admin.pages.settings.cadastrar-hubspot')
                ->with('item', $item);
    }

    public function settingHubSpotStore(FormHubSpotRequest $request)
    {
        $data = $request->all();

        if($request->input('reset_form')){ 
            $data['form_fields'] = '';
        }
        
        $data['form_corporate_email'] = $request->input('form_corporate_email') ? 1 : 0;

        $form = FormHubSpot::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );

        $msg = $data['id'] ? "Formulário atualizado com sucesso!" : "Formulário criado com sucesso!";
        
        return redirect()->route('admin.setting.hubspot.index')->with('success', $msg);
    }

    public function settingPopupIndex(Request $request){

        $query = PagePopup::query();

        // Filtro por form_name
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.settings.index-popup')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    public function settingPopupCreate()
    {
        $formsHubspot = FormHubSpot::all();

        $pages = Page::orderBy('titulo')->get()->groupBy('locale');
        
        return view('admin.pages.settings.cadastrar-popup')
                ->with('pages', $pages ?? [])
                ->with('formsHubspot', $formsHubspot ?? [])
                ->with('formHubSpot_id', '');
    }

    public function settingPopupEdit($item)
    {
        $item = PagePopup::findOrFail($item);

        $formsHubspot = FormHubSpot::all();

        $pages = Page::orderBy('titulo')->get()->groupBy('locale');
        
        if(!empty($item->getSettings())){
            foreach($item->getSettings as $setting){
                $formHubSpot_id = $setting['setting_id'];
            }
        }

        $pageIds = PageSettings::where([
            'setting'    => 'pagePopups',
            'setting_id' => $item->id ?? null,
            'table'      => 'page'
        ])->pluck('table_id')->toArray();

        $blogIds = PageSettings::where([
            'setting'    => 'pagePopups',
            'setting_id' => $item->id ?? null,
            'table'      => 'blog'
        ])->pluck('table_id')->toArray();

        return view('admin.pages.settings.cadastrar-popup')
                ->with('item', $item)
                ->with('pages', $pages ?? [])
                ->with('pageIds', $pageIds ?? [])
                ->with('blogIds', $blogIds ?? [])
                ->with('formsHubspot', $formsHubspot ?? [])
                ->with('formHubSpot_id', $formHubSpot_id ?? '');
    }

    public function settingPopupStore(PagePopupRequest $request)
    {
        $data = $request->all();

        $msg = !empty($data['id'])
            ? "Popup atualizado com sucesso!"
            : "Popup criado com sucesso!";

        DB::transaction(function () use ($data) {            

            // 🔹 Cria ou atualiza popup
            $pagePopup = PagePopup::updateOrCreate(
                ['id' => $data['id'] ?? null],
                $data
            );

            // 🔹 FORM HUBSPOT
            $baseSetting = [
                'table'    => 'pagePopups',
                'table_id' => $pagePopup->id,
                'setting'  => 'formHubSpot',
            ];

            if (!empty($data['form_hubspot_id'])) {
                PageSettings::updateOrCreate(
                    $baseSetting,
                    array_merge($baseSetting, [
                        'setting_id' => $data['form_hubspot_id']
                    ])
                );
            } else {
                PageSettings::where($baseSetting)->delete();
            }

            // 🔹 Remove vínculos antigos (pages + blogs)
            PageSettings::where([
                'setting'    => 'pagePopups',
                'setting_id' => $pagePopup->id
            ])->delete();

            // 🔹 Função helper pra evitar duplicação
            $syncSettings = function ($items, $table) use ($pagePopup) {

                if (empty($items)) return;

                $rows = collect($items)->map(function ($id) use ($table, $pagePopup) {
                    return [
                        'table'      => $table,
                        'table_id'   => $id,
                        'setting'    => 'pagePopups',
                        'setting_id' => $pagePopup->id,
                    ];
                })->toArray();

                // 🔥 upsert = mais performático que loop
                PageSettings::upsert(
                    $rows,
                    ['table', 'table_id', 'setting', 'setting_id']
                );
            };

            // 🔹 Sincroniza pages e blogs
            $syncSettings($data['pages'] ?? [], 'page');
            $syncSettings($data['blogs'] ?? [], 'blog');

        });
        
        return redirect()->route('admin.setting.popup.index')->with('success', $msg);
    }

    public function settingMenuIndex(Request $request){

        $query = MenuAdmin::query();
        $query->where('menu_id', 0);

        // Filtro por nome
        if ($request->filled('menu')) {
            $query->where('menu', 'like', '%' . $request->menu . '%');
        }

        $sortField = $request->get('sort', 'ordem');
        $sortDirection = $request->get('direction', 'asc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.settings.index-menu')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    public function settingMenuCreate()
    {
        $menuPai = MenuAdmin::where('menu_id', 0)
            ->orderBy('ordem')
            ->get();
        return view('admin.pages.settings.cadastrar-menu')->with('menuPai', $menuPai);
    }

    public function settingMenuEdit($item)
    {
        $item = MenuAdmin::findOrFail($item);

        $menuPai = MenuAdmin::where('menu_id', 0)
            ->orderBy('ordem')
            ->get();

        return view('admin.pages.settings.cadastrar-menu')
                ->with('menuPai', $menuPai)
                ->with('item', $item);
    }

    public function settingMenuStore(FormMenuAdminRequest $request)
    {
        $data = $request->all();
        
        MenuAdmin::updateOrCreate(
                    ['id' => $data['id'] ?? null],
                    $data
                );

        $msg = $data['id'] ? "Menu atualizado com sucesso!" : "Menu criado com sucesso!";
        
        return redirect()->route('admin.setting.menu.index')->with('success', $msg);
    }
}
