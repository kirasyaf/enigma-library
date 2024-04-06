<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
             CategorySeeder::class, // harus di panggil ketika kamu buat seder maknaya harus ada    
             RoleSeeder::class,    
        ]);

        User::create([
            'username' => 'Admin',
            'password' => bcrypt('password'),
            'phone' => '123456789',
            'address' => 'Alamat Pengguna 1',
            'status' => 'active',
            'role_id' => 1, 
        ]);

    

        User::create([
            'username' => 'Ganjar',
            'password' => bcrypt('prabowo'),
            'phone' => '987654321',
            'address' => 'Alamat Pengguna 2',
            'status' => 'active',
            'role_id' => 2, 
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    
} 
