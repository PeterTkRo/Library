<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::query()->create([
             'name' => 'admin',
             'role' => User::ROLES['ADMIN'],
             'password' => Hash::make('admin'),

         ]);

         Book::factory(100)->create();
    }
}
