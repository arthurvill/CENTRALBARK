<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $payment_methods = array(
            [
                'type' => 'Gcash',
                'account_name' => 'Central Bark Veterinary Clinic',
                'account_no' => '09109470234',
                'created_at' => now(),
            ],
            [
                'type' => 'Maya',
                'account_name' => 'Central Bark Veterinary Clinic',
                'account_no' => '09094417450',
                'created_at' => now(),
            ],
            [
                'type' => 'Union Bank',
                'account_name' => 'Central Bark Veterinary Clinic',
                'account_no' => '0011223344556677',
                'created_at' => now(),
            ],
        );

        PaymentMethod::insert($payment_methods);

        PaymentMethod::all()->each(fn(
            $payment_method) => $service->log_activity(model:$payment_method, event:'added', model_name: 'Payment Method', model_property_name: $payment_method->name)
        );
    }
}