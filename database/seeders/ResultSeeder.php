<?php

namespace Database\Seeders;

use App\Models\Result;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = array(

            // 
            [
                'id' => 1,
                'booking_id' => 1,
                'subject' => 'X-RAY Laboratory Result',
                'remark' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe distinctio ea eaque suscipit sequi architecto deserunt iusto excepturi numquam sapiente. Id nesciunt iste animi porro.',
                'created_at' => now(),
            ],
        );

        Result::insert($results);
    }
}