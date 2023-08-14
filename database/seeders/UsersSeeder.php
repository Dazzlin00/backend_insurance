<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list=Permission::create(['name'=>'users.list']);
        $user_view=Permission::create(['name'=>'users.view']);
        $user_create=Permission::create(['name'=>'users.create']);
        $user_udpate=Permission::create(['name'=>'users.udpate']);
        $user_delete=Permission::create(['name'=>'users.delete']);

$admin_role = Role::create(['name'=>'admin']);
$admin_role -> givePermissionTo([
    $user_create,
    $user_list,
    $user_udpate,
    $user_delete,
    $user_view
]);
$admin = User::create ([
    
    'name'=>'admin',
    'email'=> 'admin@admin.com',
    'password'=>bcrypt('password')
]);

$admin -> assignRole($admin_role);
$admin -> givePermissionTo([
    
    $user_create,
    $user_list,
    $user_udpate,
    $user_delete,
    $user_view
]);
$user = User::create ([
    
    'name'=>'user',
    'email'=> 'user@user.com',
    'password'=>bcrypt('password')
]);
$user_role=Role::create(['name'=>'user']);
$user -> assignRole($user_role);
$user -> givePermissionTo([
    
   
    $user_list,
    
]);
$user_role -> givePermissionTo([
    
   
    $user_list,
    
]);
    }
}
