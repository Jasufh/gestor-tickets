<?php

namespace Database\Seeders;

use App\Models\Problematica;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
     /*    CREACION POR DEFECTO DE USUARIOS Y PROBLEMAS */
         User::factory(1)->create();
         
         User::factory()->create([
            'name' => 'Sala De Listas',
            'email' => 'saladelistas@gmail.com',
            'usertype' => 'salaDeListas',
            'apellidos' => 'Sala De Listas',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'name' => 'GESTEC',
            'email' => 'gestec@gmail.com',
            'usertype' => 'gestec',
            'apellidos' => 'GESTEC',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

         
        User::factory()->create([
            'name' => 'Sala De Listas 2',
            'email' => 'saladelista2@gmail.com',
            'usertype' => 'salaDeListas2',
            'apellidos' => 'Sala De Listas 2',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

           
        User::factory()->create([
            'name' => 'Sala De Listas 3',
            'email' => 'saladelista3@gmail.com',
            'usertype' => 'salaDeListas3',
            'apellidos' => 'Sala De Listas 3',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);



        Problematica::factory()->create([
            'nombre' => 'Red',
        ]);

        Problematica::factory()->create([
            'nombre' => 'Proyector',
        ]);

        Problematica::factory()->create([
            'nombre' => 'Software',
        ]);

        Problematica::factory()->create([
            'nombre' => 'Falla elétrica',
        ]);

        /* Ticket::factory()->count(10000)->create(); */


         



    }
}
