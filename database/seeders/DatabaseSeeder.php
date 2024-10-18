<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([
            
            /** Start User Management */
                BarangaySeeder::class,
                RoleSeeder::class,
                StaffSeeder::class,
                CustomerSeeder::class,
                UserSeeder::class,
            /** End User Management */


            /** Start Pet Management */
                CategorySeeder::class,
                PetSeeder::class,
            /** End Pet Management */


            /** Start Booking Management */
                ServiceCategorySeeder::class,
                ServiceSeeder::class,
                ScheduleSeeder::class,
                PaymentMethodSeeder::class,
                BookingSeeder::class,

                ResultSeeder::class,
                PrescriptionSeeder::class,
            /** End Booking Management */


            SettingSeeder::class,
        ]);

    }
}