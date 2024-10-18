<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $staffs = array(
            [
                'id' => 1,
                'first_name' => 'Staff',
                'middle_name' => 'D',
                'last_name' => 'Staff',
                'sex' => 'female',
                'created_at' => now()->subMonth()
            ],

        );

        Staff::insert($staffs);

        Staff::all()->each(fn(
            $staff) => $service->log_activity(model:$staff, event:'added', model_name: 'Staff', model_property_name: $staff->full_name)
        );
    }
}