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
        //CREA LOS PERMISOS
        //USUARIOS
        $user_list = Permission::create(['name' => 'users.list']); //LISTA DE USUARIOS
        $user_view = Permission::create(['name' => 'users.view']); // VER USUARIO
        $user_create = Permission::create(['name' => 'users.create']); //CREAR 
        $user_update = Permission::create(['name' => 'users.update']); //ACTUALIZAR
        $user_delete = Permission::create(['name' => 'users.delete']); //ELIMINAR
        //POLIZAS
        $policies = Permission::create(['name' => 'users.policies']); //POLIZAS
        $policies_view = Permission::create(['name' => 'policies.view']); // VER POLIZA
        $policies_create = Permission::create(['name' => 'policies.create']); // CREAR POLIZA
        $policies_update = Permission::create(['name' => 'policies.update']); //ACTUALIZAR
        $policies_delete = Permission::create(['name' => 'policies.delete']); //ELIMINAR
       
       
        //SINIESTROS
        $sinister = Permission::create(['name' => 'sinister.list']); //LISTA
        $sinister_report = Permission::create(['name' => 'sinister.report']); //REPORTAR
        $sinister_view = Permission::create(['name' => 'sinister.view']); // VER 
        $sinister_create = Permission::create(['name' => 'sinister.create']); // CREAR POLIZA
        $sinister_update = Permission::create(['name' => 'sinister.update']); //ACTUALIZAR
        $sinister_delete = Permission::create(['name' => 'sinister.delete']); //ELIMINAR


        //RECLAMOS

        $clains = Permission::create(['name' => 'clains.list']); //LISTA
        $clains_report = Permission::create(['name' => 'clains.report']); //REPORTAR
        $clains_view = Permission::create(['name' => 'clains.view']); // VER 
        $clains_create = Permission::create(['name' => 'clains.create']); // CREAR 
        $clains_update = Permission::create(['name' => 'clains.update']); //ACTUALIZAR
        $clains_delete = Permission::create(['name' => 'clains.delete']); //ELIMINAR

        //ADMIN
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            //USUARIOS
            $user_create,
            $user_list,
            $user_update,
            $user_delete,
            $user_view,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
          
            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_create,
            $sinister_update,
            $sinister_delete,


            //RECLAMOS

            $clains,
            $clains_report,
            $clains_view,
            $clains_create,
            $clains_update,
            $clains_delete,

        ]);
        $admin = User::create([

            'name' => 'admin',
            'email' => 'admin@admin.com',
            'numid' => '12345670',
            'address' => 'Barquisimeto',
            'phone' => '04121234560',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            //USUARIOS
            $user_create,
            $user_list,
            $user_update,
            $user_delete,
            $user_view,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
          

            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_create,
            $sinister_update,
            $sinister_delete,


            //RECLAMOS

            $clains,
            $clains_report,
            $clains_view,
            $clains_create,
            $clains_update,
            $clains_delete,
        ]);


        //USER
        $user = User::create([

            'name' => 'user',
            'email' => 'user@user.com',
            'numid' => '10345670',
            'address' => 'Barquisimeto',
            'phone' => '04161234560',
            'password' => bcrypt('password')
        ]);
        $user_role = Role::create(['name' => 'user']);
        $user->assignRole($user_role);
        $user->givePermissionTo([


           
            $policies_create,
            $policies,
            $clains_report,
            $clains_view,

        ]);
        $user_role->givePermissionTo([


          
            $policies_create,
            $policies,
            $clains_report,
            $clains_view,

        ]);

        //AGENT

        $agent = User::create([

            'name' => 'agent',
            'email' => 'agent@agent.com',
            'numid' => '15345670',
            'address' => 'Barquisimeto',
            'phone' => '04141234560',
            'password' => bcrypt('password')
        ]);


        $agent_role = Role::create(['name' => 'agent']);
        $agent->assignRole($agent_role);
        $agent->givePermissionTo([


            //USUARIOS
            $user_create,
            $user_list,
            $user_update,
            $user_delete,
            $user_view,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
           

            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_update,



            //RECLAMOS

            $clains,

            $clains_view,

            $clains_update,


        ]);
        $agent_role->givePermissionTo([


            //USUARIOS
            $user_create,
            $user_list,
            $user_update,
            $user_delete,
            $user_view,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
          

            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_update,



            //RECLAMOS

            $clains,
            $clains_view,
            $clains_update,

        ]);

    }
}