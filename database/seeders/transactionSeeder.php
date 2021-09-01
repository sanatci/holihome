<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class transactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table("transactions")->insert([
            "date" => $faker->date(),
            "unit_id" => $faker->numberBetween(1,3),
            "account_id" => $faker->numberBetween(1,20),
            "payment_id" => $faker->numberBetween(1,5),
            "description" => $faker->streetName(). " ". $faker->colorName(),
            "amount" => $faker->randomFloat(2,-100000,10000)
        ]);
    }
}
