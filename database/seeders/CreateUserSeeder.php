<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\PermissionAdmin;
use App\Models\User;
use App\Models\MenuAdmin;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $user = User::where('email' , 'marketing@ikatec.com.br')->first();
        if(empty($user)){
            User::create([
                'name' => 'marketing',
                'email' => 'marketing@ikatec.com.br',
                'password' => Hash::make('marketing123'),
                'is_master_admin' => true
            ]);
        } 

        $user = User::where('email' , 'blog@ikatec.com.br')->first();
        if(empty($user)){
            $user = User::create([
                'name' => 'blog',
                'email' => 'blog@ikatec.com.br',
                'password' => Hash::make('blog123'),
                'is_master_admin' => false
            ]);
        } 

        $permissionAdmin = [
            [
                'user_id' => $user->id,
                'menu_id' => 1,
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_report' => 1,
            ],
            [
                'user_id' => $user->id,
                'menu_id' => 5,
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_report' => 1,
            ],
            [
                'user_id' => $user->id,
                'menu_id' => 6,
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_report' => 1,
            ],
            [
                'user_id' => $user->id,
                'menu_id' => 20,
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_report' => 1,
            ],
            [
                'user_id' => $user->id,
                'menu_id' => 21,
                'can_view' => 1,
                'can_create' => 1,
                'can_edit' => 1,
                'can_delete' => 1,
                'can_report' => 1,
            ],
        ];

        foreach($permissionAdmin as $permission){
            PermissionAdmin::create($permission);
        }
    }
}
