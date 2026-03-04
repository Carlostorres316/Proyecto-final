<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        User::create([
            'name' => 'Cartop',
            'email' => 'cartop.jr@gmail.com',
            'password' => Hash::make('73269096'),
            'rol' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::factory(20)->create();
    }
}
