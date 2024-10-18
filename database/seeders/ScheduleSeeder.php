<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $schedules = array(

            // Day Zero
            [
                'id' => 1,
                'service_id' => 1,
                'date_time_start' => '2024-10-07 08:00:00',
                'date_time_end' => '2024-10-07 09:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 2,
                'service_id' => 1,
                'date_time_start' => '2024-10-07 10:00:00',
                'date_time_end' => '2024-10-07 11:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 3,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-07 11:00:00',
                'date_time_end' => '2024-10-07 11:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 4,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-07 11:00:00',
                'date_time_end' => '2024-10-07 14:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 5,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-07 14:00:00',
                'date_time_end' => '2024-10-07 15:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 6,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-07 15:00:00',
                'date_time_end' => '2024-10-07 16:00:00',
                'day_type' => Carbon::parse('2024-10-07')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day One
            [
                'id' => 7,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 09:00:00',
                'date_time_end' => '2024-10-08 10:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 8,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 10:00:00',
                'date_time_end' => '2024-10-08 11:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 9,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 11:00:00',
                'date_time_end' => '2024-10-08 11:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 10,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 13:00:00',
                'date_time_end' => '2024-10-08 14:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 11,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 14:00:00',
                'date_time_end' => '2024-10-08 15:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 12,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-08 15:00:00',
                'date_time_end' => '2024-10-08 16:00:00',
                'day_type' => Carbon::parse('2024-10-08')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day Two
            [
                'id' => 13,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 09:00:00',
                'date_time_end' => '2024-10-09 10:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 14,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 10:00:00',
                'date_time_end' => '2024-10-09 11:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 15,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 11:00:00',
                'date_time_end' => '2024-10-09 11:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 16,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 13:00:00',
                'date_time_end' => '2024-10-09 14:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 17,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 14:00:00',
                'date_time_end' => '2024-10-09 15:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 18,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-09 15:00:00',
                'date_time_end' => '2024-10-09 16:00:00',
                'day_type' => Carbon::parse('2024-10-09')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day 3
            [
                'id' => 19,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 09:00:00',
                'date_time_end' => '2024-10-10 10:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 20,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 10:00:00',
                'date_time_end' => '2024-10-10 11:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 21,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 11:00:00',
                'date_time_end' => '2024-10-10 11:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 22,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 13:00:00',
                'date_time_end' => '2024-10-10 14:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 23,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 14:00:00',
                'date_time_end' => '2024-10-10 15:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 24,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-10 15:00:00',
                'date_time_end' => '2024-10-10 16:00:00',
                'day_type' => Carbon::parse('2024-10-10')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day 4
            [
                'id' => 25,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 09:00:00',
                'date_time_end' => '2024-10-11 10:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 26,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 10:00:00',
                'date_time_end' => '2024-10-11 11:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 27,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 11:00:00',
                'date_time_end' => '2024-10-11 11:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 28,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 13:00:00',
                'date_time_end' => '2024-10-11 14:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 29,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 14:00:00',
                'date_time_end' => '2024-10-11 15:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 30,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-11 15:00:00',
                'date_time_end' => '2024-10-11 16:00:00',
                'day_type' => Carbon::parse('2024-10-11')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day 5
            [
                'id' => 31,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 09:00:00',
                'date_time_end' => '2024-10-12 10:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 32,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 10:00:00',
                'date_time_end' => '2024-10-12 11:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 33,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 11:00:00',
                'date_time_end' => '2024-10-12 11:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 34,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 13:00:00',
                'date_time_end' => '2024-10-12 14:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 35,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 14:00:00',
                'date_time_end' => '2024-10-12 15:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 36,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-12 15:00:00',
                'date_time_end' => '2024-10-12 16:00:00',
                'day_type' => Carbon::parse('2024-10-12')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day 6
            [
                'id' => 37,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 09:00:00',
                'date_time_end' => '2024-10-15 10:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 38,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 10:00:00',
                'date_time_end' => '2024-10-15 11:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 39,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 11:00:00',
                'date_time_end' => '2024-10-15 11:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 40,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 13:00:00',
                'date_time_end' => '2024-10-15 14:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 41,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 14:00:00',
                'date_time_end' => '2024-10-15 15:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 42,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-15 15:00:00',
                'date_time_end' => '2024-10-15 16:00:00',
                'day_type' => Carbon::parse('2024-10-15')->isoFormat('dddd'),
                'created_at' => now() 
            ],

            // Day 7
            [
                'id' => 43,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 09:00:00',
                'date_time_end' => '2024-10-16 10:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 44,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 10:00:00',
                'date_time_end' => '2024-10-16 11:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 45,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 11:00:00',
                'date_time_end' => '2024-10-16 11:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 46,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 13:00:00',
                'date_time_end' => '2024-10-16 14:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 47,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 14:00:00',
                'date_time_end' => '2024-10-16 15:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
            [
                'id' => 48,
                'service_id' => mt_rand(1,14),
                'date_time_start' => '2024-10-16 15:00:00',
                'date_time_end' => '2024-10-16 16:00:00',
                'day_type' => Carbon::parse('2024-10-16')->isoFormat('dddd'),
                'created_at' => now() 
            ],
        );

      
        Schedule::insert($schedules);

        Schedule::all()->each(fn(
            $schedule) => $service->log_activity(model:$schedule, event:'added', model_name: 'Clinic Schedule', model_property_name: formatDate($schedule->date_time_start). ' at ' . formatDate($schedule->date_time_start, 'time'). ' - ' .formatDate($schedule->date_time_end, 'time'))
        );
    }
}