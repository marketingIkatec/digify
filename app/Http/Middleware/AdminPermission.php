<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MenuAdmin;
use App\Helpers\RouteHelper;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {       
        $helper = new RouteHelper();
        if(!empty($helper->currentMenu) && $currentMenu = $helper->currentMenu){
            
            /*
            "can_view"   => 1; "can_create" => 1; "can_edit"   => 1; "can_delete" => 1; "can_report" => 1;
            */
            $verifyPermission = $helper->verifyPermission();
            
            /*
            "index"  => "admin.blog.categoria.index"; "edit"   => "admin.blog.categoria.edit"; "destroy"=> "admin.blog.categoria.destroy"; "create" => "admin.blog.categoria.create"; "status" => "admin.alterar.status";
            */
            $actionRoute     = $helper->getActionRoutes(); 
            
            view()->share('actionRoute', $actionRoute);
            view()->share('permissionRoute', $verifyPermission);
            view()->share('currentMenu', $currentMenu);
        } 

        return $next($request);
    }
}
