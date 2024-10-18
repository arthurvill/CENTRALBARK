<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogsService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $users = array(
            // generate sample admin
             [
                'id' => 1,
                'role_id' => Role::ADMIN,
                'staff_id' => null,
                'customer_id' => null,
                'name' => 'Carina Llaneta',
                'email' => 'admin@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'created_at' => now()
             ],
 
           // generate sample staff
             [
                'id' => 2,
                'role_id' => Role::STAFF,
                'staff_id' => 1,
                'customer_id' => null,
                'name' => null,
                'email' => 'staff@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'created_at' => now()
             ],

           // generate sample customer
            [
                'id' => 3,
                'role_id' => Role::CUSTOMER,
                'staff_id' => null,
                'customer_id' => 1,
                'name' => null,
                'email' => 'arthurvillareal925@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'created_at' => now()
            ],
            [
                'id' => 4,
                'role_id' => Role::CUSTOMER,
                'staff_id' => null,
                'customer_id' => 2,
                'name' => null,
                'email' => 'customer@gmail.com', 
                'password' => Hash::make('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'created_at' => now()
            ],
          );
 
          User::insert($users);

          User::all()->each(function($user) use($service){
            $user
            ->addMedia(public_path("/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');

            $service->log_activity(model:new User(), event:'added', model_name: 'User', model_property_name: $user->staff->full_name ?? $user->customer->full_name ?? 'Administrator');
        });
    }
}