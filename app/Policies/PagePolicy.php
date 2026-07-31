<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Page;
use App\Models\MenuAdmin;
use App\Models\PermissionAdmin;

class PagePolicy
{
    /**
     * Retorna a permissão do usuário baseada no menu admin
     */
    protected function permission(User $user): ?PermissionAdmin
    {
        return PermissionAdmin::where('user_id', $user->id)
            ->whereHas('menu', function ($q) {
                $q->where('route', 'admin.site.pagina'); // rota do menu
            })
            ->first();
    }

    public function viewAny(User $user): bool
    {
        return optional($this->permission($user))->can_view ?? false;
    }

    public function view(User $user, Page $page): bool
    {
        return optional($this->permission($user))->can_view ?? false;
    }

    public function create(User $user): bool
    {
        return optional($this->permission($user))->can_create ?? false;
    }

    public function update(User $user, Page $page): bool
    {
        return optional($this->permission($user))->can_edit ?? false;
    }

    public function delete(User $user, Page $page): bool
    {
        return optional($this->permission($user))->can_delete ?? false;
    }

    public function toggleStatus(User $user, Page $page): bool
    {
        return optional($this->permission($user))->can_edit ?? false;
    }

    public function report(User $user): bool
    {
        return optional($this->permission($user))->can_report ?? false;
    }
}
