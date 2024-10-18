<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $pets = array(
            [
                'id' => 1,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'Bullet',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'daschund',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'John',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'pug',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'Jane',
                'sex' => "female",
                'birth_date' => '2023-04-01',
                'breed' => 'daschund',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'Mario',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'daschund',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'Wario',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'daschund',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'category_id' => mt_rand(1,2),
                'customer_id' => 1,
                'name' => 'Luigi',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'daschund',
                'color' => 'brown',
                'weight' => 2.00, // 2kgs,
                'created_at' => now(),
            ],

            [
                'id' => 7,
                'category_id' => mt_rand(1,2),
                'customer_id' => 2,
                'name' => 'Dolly',
                'sex' => "male",
                'birth_date' => '2023-04-01',
                'breed' => 'american bully',
                'color' => 'brown',
                'weight' => 5.00, // 2kgs,
                'created_at' => now(),
            ],
        );

        Pet::insert($pets);

        Pet::all()->each(fn(pet
            $pet) => $service->log_activity(model:$pet, event:'added', model_name: 'Pet', model_property_name: $pet->name, conjunction: '', end_user: $pet->customer->full_name)
        );
    }
}