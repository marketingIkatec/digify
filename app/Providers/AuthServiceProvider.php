<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // 👈 ISSO AQUI
use App\Models\PermissionAdmin;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

         // 🔥 MASTER ADMIN BYPASS
        Gate::before(function ($user) {
            return $user->is_master_admin ? true : null;
        });

        Gate::define('view-route', function ($user, string $route) {
            return PermissionAdmin::where('user_id', $user->id)
                ->whereHas('menu', fn ($q) => $q->where('route', $route))
                ->where('can_view', 1)
                ->exists();
        });

        Gate::define('create-route', function ($user, string $route) {
            return PermissionAdmin::where('user_id', $user->id)
                ->whereHas('menu', fn ($q) => $q->where('route', $route))
                ->where('can_create', 1)
                ->exists();
        });

        Gate::define('edit-route', function ($user, string $route) {
            return PermissionAdmin::where('user_id', $user->id)
                ->whereHas('menu', fn ($q) => $q->where('route', $route))
                ->where('can_edit', 1)
                ->exists();
        });

        Gate::define('delete-route', function ($user, string $route) {
            return PermissionAdmin::where('user_id', $user->id)
                ->whereHas('menu', fn ($q) => $q->where('route', $route))
                ->where('can_delete', 1)
                ->exists();
        });

        Gate::define('report-route', function ($user, string $route) {
            return PermissionAdmin::where('user_id', $user->id)
                ->whereHas('menu', fn ($q) => $q->where('route', $route))
                ->where('can_report', 1)
                ->exists();
        });
    }
}
