<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin12345'),
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('User12345'),
        ]);

        DB::table('users')->insert([
            'name' => 'nombre cobrador',
            'email' => 'cobrador@gmail.com',
            'password' => Hash::make('cobrador12345'),
        ]);

        DB::table('cobrador')->insert([
            'user_id' => 3
        ]);
    }
}
