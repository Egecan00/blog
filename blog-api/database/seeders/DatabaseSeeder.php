<?php

namespace Database\Seeders;

use App\Models\User;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ShieldSeeder::class,  
            PolicesSeeder::class          
        ]);

        User::create([
            'name' => 'Ege', 
            'email' => 'Ege@gmail.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
        ])->assignRole('super_admin');

    }
}
