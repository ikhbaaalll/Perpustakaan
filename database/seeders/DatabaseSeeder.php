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
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('1')
        ]);
        User::factory()->create([
            'email' => 'user@user.com',
            'password' => bcrypt('1'),
            'role' => 2
        ]);

        if (app()->environment() == 'local') {
            Category::factory()->count(10)->create()->each(function ($category) {
                Book::factory()->count(rand(1, 15))->create([
                    'category_id' => $category->id
                ]);
            });

            Loan::factory()->count(100)->create();

            Loan::factory()->count(10)->create([
                'status' => Loan::STATUS_WAITING
            ]);

            Loan::factory()->count(10)->create([
                'status' => Loan::STATUS_ON_LOAN
            ]);
        }
    }
}
