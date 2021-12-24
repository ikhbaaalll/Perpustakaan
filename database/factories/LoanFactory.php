<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $loan = Carbon::today()->subDays(rand(1, 250));

        return [
            'book_id' => rand(1, 50),
            'user_id' => User::factory()->create([
                'role' => 2
            ]),
            'quantity' => rand(1, 5),
            'date_of_loan' => $loan->toDateString(),
            'date_of_return' => $loan->addDays(rand(1, 10))->toDateString(),
            'date_of_return_confirmation' => $this->faker->date(),
            'status' => Loan::STATUS_DONE
        ];
    }
}
