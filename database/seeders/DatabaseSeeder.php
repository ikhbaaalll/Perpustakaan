<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 1
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'role' => 2
        ]);
    }
}
