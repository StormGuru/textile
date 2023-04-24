<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Role::factory(1)->create(['role' => 'admin']);
        \App\Models\Role::factory(1)->create(['role' => 'client']);
        \App\Models\Role::factory(1)->create(['role' => 'fabricator']);

        \App\Models\Category::factory(5)->create();
    }
}
