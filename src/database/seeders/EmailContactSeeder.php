<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $jsonData = file_get_contents(resource_path('data/cityMap.json'));
        // $cities = json_decode($jsonData, true);
        $allowedCities = ['New York', 'Semarang', 'Tidore', 'Melbourne', 'Salatiga'];

        foreach (range(1, 1000) as $index) {
            // $randomIndex = array_rand($cities);
            // $randomCity = $cities[$randomIndex]['city'];

            $birthdate = $faker->dateTimeBetween('now', '+2 days')->format('Y-m-d');
            $randomCity = $faker->randomElement($allowedCities);

            DB::table('email_contacts')->insert([
                'email_group_id' => 1,
                'email' => $faker->email,
                'name' => $faker->name,
                'birthdate' => $birthdate,
                'city' => $randomCity,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
