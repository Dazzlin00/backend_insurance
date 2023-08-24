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
        $policies=Permission::create(['name'=>'users.policies']);

        //ADMIN
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
    'numid'=> '12345670',
    'address'=> 'Barquisimeto',
    'phone'=> '04121234560',
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


//USER
$user = User::create ([
    
    'name'=>'user',
    'email'=> 'user@user.com',
    'numid'=> '10345670',
    'address'=> 'Barquisimeto',
    'phone'=> '04161234560',
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

//AGENT

$agent = User::create ([
    
    'name'=>'agent',
    'email'=> 'agent@agent.com',
    'numid'=> '15345670',
    'address'=> 'Barquisimeto',
    'phone'=> '04141234560',
    'password'=>bcrypt('password')
]);


$agent_role=Role::create(['name'=>'agent']);
$agent -> assignRole($agent_role);
$agent -> givePermissionTo([
    
   
    $user_list,
    $policies
    
]);
$agent_role-> givePermissionTo([
    
   
    $user_list,
    $policies
    
]);

    }
}
