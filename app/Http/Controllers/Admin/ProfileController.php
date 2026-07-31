<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\PermissionAdmin;
use App\Models\MenuAdmin;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    public function index(Request $request){

        $query = User::query();

        // Filtro por nome
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
            $query->orWhere('email', 'like', '%' . $request->name . '%');
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $items = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.settings.index-user')
                ->with('items', $items)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

     public function settingUserEdit($id)
    {
        $item = User::with('permissions')->findOrFail($id);
        $query = MenuAdmin::query();
        $query->where('menu_id', 0);
        $query->orderBy('ordem');
        $menus = $query->get();
        return view('admin.pages.settings.cadastrar-user')
                ->with('item', $item)
                ->with('menus', $menus);
    }

    public function settingUserCreate()
    {
        $item = new User();
        $query = MenuAdmin::query();
        $query->where('menu_id', 0);
        $query->orderBy('ordem');
        $menus = $query->get();
        return view('admin.pages.settings.cadastrar-user')
                ->with('item', $item)
                ->with('menus', $menus);
    }

    public function settingUserStore(ProfileRequest $request)
    {         

    
        $user = User::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'name' => $request->name,
                'email' => $request->email,
                'is_master_admin' => $request->is_master_admin ?? false,
                $request->password ? 'password' : '' => $request->password ? Hash::make($request->password) : null,
            ]
        );

        // limpa permissões antigas
        PermissionAdmin::where('user_id', $user->id)->delete();

        // recria
        if ($request->permissions) {
            foreach ($request->permissions as $menuId => $perms) {
                PermissionAdmin::create([
                    'user_id' => $user->id,
                    'menu_id' => $menuId,
                    'can_view' => isset($perms['view']),
                    'can_create' => isset($perms['create']),
                    'can_edit' => isset($perms['edit']),
                    'can_delete' => isset($perms['delete']),
                    'can_report' => isset($perms['report']),
                ]);
            }
        }

        return redirect()->route('admin.setting.user.index', ['name' => $user->email])->with('success', 'Atualizado!');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.editar')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
