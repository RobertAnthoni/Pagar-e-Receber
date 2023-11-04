<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@dotum.com',
            'password' => Hash::make('admin@dotum'),
        ]);

        \App\Models\Caixa::factory()->create([
            'descricao' => 'Itau - C. Salario',
            'saldo' => 0,
            'id_user' => 1,
        ]);

        \App\Models\Caixa::factory()->create([
            'descricao' => 'Sicoob - Corrente',
            'saldo' => 0,
            'id_user' => 1,
        ]);

        \App\Models\Caixa::factory()->create([
            'descricao' => 'Sicoob - Poupança',
            'saldo' => 0,
            'id_user' => 1,
        ]);

        \App\Models\Caixa::factory()->create([
            'descricao' => 'Rico - Investimento',
            'saldo' => 0,
            'id_user' => 1,
        ]);
    }
}
