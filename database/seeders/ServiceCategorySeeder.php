<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $service_catergories = array(
            ['id' => 1, 'name' => 'Vaccines and Immunization', 'created_at' => now()],
            ['id' => 2, 'name' => 'Pet Deworming', 'created_at' => now()],
            ['id' => 3, 'name' => 'Pet Surgery', 'created_at' => now()],
        );

        ServiceCategory::insert($service_catergories);

        ServiceCategory::all()->each(fn(
            $service_category) => $service->log_activity(model:$service_category, event:'added', model_name: 'Service Category', model_property_name: $service_category->name)
        );
    }
}