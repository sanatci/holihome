<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            "date" => $faker->date(),
            "unit_id" => $faker->numberBetween(1,3),   // three units
            "account_id" => $faker->numberBetween(1,20),  // twenty accounts
            "payment_id" => $faker->numberBetween(1,3),  // three type payments
            "description" => $faker->text(200),   // random description
            // "description" => $faker->streetName(). " ". $faker->colorName(),
            "amount" => $faker->randomFloat(2,-1000,1000)   // random amounts +/-
        ];
    }
}
