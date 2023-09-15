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
      
        $policies_me = Permission::create(['name' => 'users.policies.me']); //POLIZAS por usuario
        $policies_user = Permission::create(['name' => 'users.policies.list']); //POLIZAS por usuario

        //SINIESTROS
        $sinister = Permission::create(['name' => 'sinister.list']); //LISTA
        $sinister_report = Permission::create(['name' => 'sinister.report']); //REPORTAR
        $sinister_view = Permission::create(['name' => 'sinister.view']); // VER 
        $sinister_create = Permission::create(['name' => 'sinister.create']); // CREAR POLIZA
        $sinister_update = Permission::create(['name' => 'sinister.update']); //ACTUALIZAR
        $sinister_delete = Permission::create(['name' => 'sinister.delete']); //ELIMINAR
        
        $sinister_me = Permission::create(['name' => 'sinister.me']); //Ver mis siniestros

        //RECLAMOS

        $clains = Permission::create(['name' => 'clains.list']); //LISTA
        $clains_report = Permission::create(['name' => 'clains.report']); //REPORTAR
        $clains_view = Permission::create(['name' => 'clains.view']); // VER 
        $clains_create = Permission::create(['name' => 'clains.create']); // CREAR 
        $clains_update = Permission::create(['name' => 'clains.update']); //ACTUALIZAR
        $clains_delete = Permission::create(['name' => 'clains.delete']); //ELIMINAR

        $clains_me = Permission::create(['name' => 'clains.me']); //Ver mis reclamos

        //coverage

        $coverage = Permission::create(['name' => 'coverage.list']); //LISTA
        $coverage_view = Permission::create(['name' => 'coverage.view']); // VER 
        $coverage_create = Permission::create(['name' => 'coverage.create']); // CREAR 
        $coverage_update = Permission::create(['name' => 'coverage.update']); //ACTUALIZAR
        $coverage_delete = Permission::create(['name' => 'coverage.delete']); //ELIMINAR

        //ADMIN
        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            //USUARIOS
            $user_create,
            $user_list,
            $user_update,
            $user_delete,
            $user_view,
            $policies_user,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
            $policies_me,
            //COBERTURAS
            $coverage,
            $coverage_view,
            $coverage_create,
            $coverage_update,
            $coverage_delete,
            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_create,
            $sinister_update,
            $sinister_delete,
            $sinister_me,
           
            //RECLAMOS
            $clains_me,
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
            $policies_user,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
            $policies_me,
            //COBERTURAS
            $coverage,
            $coverage_view,
            $coverage_create,
            $coverage_update,
            $coverage_delete,

            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_create,
            $sinister_update,
            $sinister_delete,
            $sinister_me,
           
            //RECLAMOS
            $clains_me,

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


            $user_view,
            $policies_create,
            $policies_view,
            $clains_report,
            $clains_view,
            $policies_me,
            $sinister ,
            $sinister_me,
            $sinister_create,
            $sinister_view,
            $clains_me,
        ]);
        $user_role->givePermissionTo([

            $user_view,

            $policies_create,
            $policies_view,
            $clains_report,
            $clains_view,
            $policies_me,
            $sinister ,
            $sinister_me,
            $sinister_view,
            $sinister_create,
            $clains_me,
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
            $policies_user,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
            $policies_me,


            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_update,
            $sinister_create,
            $sinister_delete,
            //COBERTURAS
            $coverage,
            $coverage_view,
            $coverage_create,
            $coverage_update,
            $coverage_delete,

            $sinister_me,
           
            //RECLAMOS
            $clains_me,

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
            $policies_user,
            //POLIZAS
            $policies,
            $policies_view,
            $policies_create,
            $policies_update,
            $policies_delete,
            $policies_me,

            //SINIESTROS
            $sinister,
            $sinister_report,
            $sinister_view,
            $sinister_update,

            $sinister_create,
            $sinister_me,
            $sinister_delete,
           
            //RECLAMOS
            $clains_me,

            $clains,
            $clains_view,
            $clains_update,
            //COBERTURAS
            $coverage,
            $coverage_view,
            $coverage_create,
            $coverage_update,
            $coverage_delete,

        ]);

    }
}