<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\MenuAdmin;

class RouteHelper
{
    
   /**
   * Construtor: captura a rota atual automaticamente
   */
   var string $route;
   var ?MenuAdmin $currentMenu = null;

    public function __construct()
    {
        $this->route = request()->route()->getName() ?? '';
        $this->currentMenu = MenuAdmin::where('route', $this->getRouteIndex())->first();
    }

    public function getRouteIndex(): string
    {
        return preg_replace('/\.(create|edit|destroy|store)$/', '.index', $this->route);
    }

    public function getUser(){
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Acesso negado.');
        }
        return $user;
    }


    public function getSidebarMenu(){

        $user = self::getUser();
        // Carrega todos os menus de nível 0
        $menuAdmin = MenuAdmin::where('menu_id', 0)
            ->orderBy('ordem')
            ->get();

        // Se for master admin → libera tudo
        if ($user->is_master_admin) {
            return $menuAdmin;
        }

        // Carrega todas as permissões do usuário de uma vez (evita 10, 20, 30 queries)
        $userPermissions = $user->permissions()
            ->where('can_view', true)
            ->pluck('can_view', 'menu_id'); // retorna [menu_id => true]
        
        // Filtra os menus permitidos
        $menuAdmin = $menuAdmin->filter(function ($menu) use ($userPermissions) {
            return $userPermissions->has($menu->id);
        })->values(); // reorganiza índices

        return $menuAdmin;
    }

    public function getAdminSidebarMenu(){  
        $menuAdmin = $this->currentMenu;
        
        $sideBarMenu = self::getSidebarMenu();
        if(!empty($menuAdmin) && $menuAdmin['menu_id']){
            $menuAdmin = MenuAdmin::where('id', $menuAdmin['menu_id'])->first();
        }
        foreach ($sideBarMenu as &$menu) {
            // primeira rota é usada como rota oficial
            $route = Route::has($menu['route']) ? route($menu['route']) : '#';
            // verifica se alguma rota está ativa
            $active = ((!empty($menuAdmin) && $menuAdmin['route'] == $menu['route']) ? 'bg-gray-200' : '');    

            $menu['route_url'] = $route;
            $menu['active'] = $active;
        }

        return $sideBarMenu;
    }

    public function getActionRoutes(): array
    {
        $base = $this->getRouteIndex();

        $actions = [
            'index'   => 'index',
            'edit'    => 'edit',
            'destroy' => 'destroy',
            'create'  => 'create',
            'report'  => 'report',            
        ];

        foreach ($actions as $key => $action) {
            $routes[$key] = str_replace('.index', '.' . $action, $base);
        }
        $routes['status'] = 'admin.alterar.status';

        if($base == 'admin.lead.contato'){
            $routes['report'] = 'admin.lead.contato.report';
        }
        
        if($base == 'admin.lead.contato' || $base == 'admin.lead.whatsapp' || $base == 'admin.lead.custom'){
            $routes['report'] = 'admin.lead.report';
        }
        
        return $routes;
    }

    public function getRequiredPermission(): string
    {

        $route = $this->route;

        // Mapear padrões → permissões
        $patterns = [
            '/\.(edit)$/'            => 'can_edit',
            '/\.(create|store)$/'    => 'can_create',
            '/\.(destroy)$/'         => 'can_delete',
        ];

        foreach ($patterns as $regex => $type) {
            if (preg_match($regex, $route)) {
                return $type;
            }
        }

        return 'can_view';
    }

    public function getCurrentMenuChildren(){
        // Pega o menu da rota atual
        $currentMenu = $this->currentMenu;
        if(!empty($currentMenu)){        
            // -----------------------------------------
            // CASO SEJA FILHO → PEGAR O PAI
            // -----------------------------------------
            if ($currentMenu->menu_id != 0) {
                // Carrega o pai + os filhos permitidos (irmãos)
                $menu = MenuAdmin::with('childrenAllowed')
                    ->find($currentMenu->menu_id);
                if(!empty($menu)){
                    return $menu->childrenAllowed; // irmãos
                }
            }

            // -----------------------------------------
            // CASO SEJA PAI → PEGAR OS FILHOS
            // -----------------------------------------
            $menuChildren = MenuAdmin::with('childrenAllowed')
                ->find($currentMenu->id);
            if(!empty($menuChildren)){
                return $menuChildren->childrenAllowed; // irmãos
            }
        }
        
        return [];
    }

    public function verifyPermission(){
        $user = self::getUser();
        
        $requiredPermission = self::getRequiredPermission();
        $permission = [];

        if(!empty($currentMenu = $this->currentMenu)){
            if ($user->is_master_admin ?? false) {
                $permission = ['can_view' => 1, 'can_create' => 1, 'can_edit' => 1, 'can_delete' => 1,  'can_report' => 1];
            }else{                
                $permission = $user->permissions()->where('menu_id', $currentMenu->id)->first();
                if (empty($permission) || empty($permission[$requiredPermission])) {
                    abort(403, 'Você não tem permissão para acessar esta área.');
                }
            }
        }
        return $permission;
    }
}

