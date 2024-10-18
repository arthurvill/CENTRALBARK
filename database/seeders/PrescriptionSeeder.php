<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prescriptions = array(
            [
                'id' => 1,
                'booking_id' => 1,
                'drug' => 'Sample Medicine',
                'description' => 'Sample Medicine Description',
                'preparation' => '100mg',
                'qty' => 15,
                'direction' => '1-----0-----0',
                'created_at' => now(),
            ],
        );

        Prescription::insert($prescriptions);
    }
}