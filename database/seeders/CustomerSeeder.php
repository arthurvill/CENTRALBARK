<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $customers = array(
            [
                'id' => 1,
                'first_name' => 'Arthur',
                'middle_name' => 'M',
                'last_name' => 'Villareal',
                'sex' => 'male',
                'birth_date' => '2003-01-01',
                'address' => 'Sample Address',
                'contact' => '09289802787',
                'created_at' => now()->subMonth()
            ],
            [
                'id' => 2,
                'first_name' => 'Dummy',
                'middle_name' => 'D',
                'last_name' => 'Dummy',
                'sex' => 'male',
                'birth_date' => '2000-01-01',
                'address' => 'Sample Address',
                'contact' => '09659312003',
                'created_at' => now()->subMonth()
            ],
            [
                'id' => 3,
                'first_name' => 'Customer',
                'middle_name' => 'D',
                'last_name' => 'Three',
                'sex' => 'male',
                'birth_date' => '2003-01-01',
                'address' => 'Sample Address',
                'contact' => '09666856119',
                'created_at' => now()->subMonth()
            ],

        );

        Customer::insert($customers);

        Customer::all()->each(fn(
            $customer) => $service->log_activity(model:$customer, event:'added', model_name: 'Customer', model_property_name: $customer->full_name)
        );
    }
}