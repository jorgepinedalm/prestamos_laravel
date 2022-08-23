<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('periodo_prestamo')->insert([
            'descripcion' => 'Diario'
        ]);

        DB::table('periodo_prestamo')->insert([
            'descripcion' => 'Semanal'
        ]);

        DB::table('periodo_prestamo')->insert([
            'descripcion' => 'Quincenal'
        ]);

        DB::table('periodo_prestamo')->insert([
            'descripcion' => 'Mensual'
        ]);

        DB::table('estado_prestamo_cuota')->insert([
            'descripcion' => 'Programado'
        ]);

        DB::table('estado_prestamo_cuota')->insert([
            'descripcion' => 'Pagado'
        ]);

        DB::table('estado_prestamo_cuota')->insert([
            'descripcion' => 'No pagado'
        ]);

        DB::table('medio_pago')->insert([
            'descripcion' => 'Efectivo'
        ]);

        DB::table('medio_pago')->insert([
            'descripcion' => 'Nequi'
        ]);

        Permission::create(['name' => 'registrar prestamo']);
        Permission::create(['name' => 'ver prestamos']);
        Permission::create(['name' => 'registrar pago']);
        Permission::create(['name' => 'generar reportes']);
        Permission::create(['name' => 'crear usuario']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'ver cobradores']);
        

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleCobrador = Role::create(['name' => 'cobrador']);
        $roleCobrador->givePermissionTo('ver prestamos');
        $roleCobrador->givePermissionTo('registrar prestamo');
        $roleCobrador->givePermissionTo('registrar pago');
        $roleCobrador->givePermissionTo('generar reportes');

        

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin12345'),
        ]);

        $admin = User::find(1);

        $admin->assignRole('admin');

        DB::table('users')->insert([
            'name' => 'Cobrador Pepito',
            'email' => 'user@gmail.com',
            'password' => Hash::make('cobrador1'),
        ]);

        $cobrador = User::find(2);

        $cobrador->assignRole('cobrador');

        DB::table('users')->insert([
            'name' => 'Cobrador Juanchito',
            'email' => 'cobrador@gmail.com',
            'password' => Hash::make('cobrador1'),
        ]);

        $cobrador = User::find(3);

        $cobrador->assignRole('cobrador');

        DB::table('cobrador')->insert([
            'user_id' => 2
        ]);

        DB::table('cobrador')->insert([
            'user_id' => 3
        ]);
    }
}
