<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Cash', 'slug' => 'cash'],
            ['name' => 'Bank', 'slug' => 'bank'],
            ['name' => 'Card', 'slug' => 'card'],
            ['name' => 'Mobile', 'slug' => 'mobile'],
            ['name' => 'Online Banking', 'slug' => 'online_banking'],
            ['name' => 'Cheque', 'slug' => 'cheque'],
            ['name' => 'Paypal', 'slug' => 'paypal'],
            ['name' => 'Crypto', 'slug' => 'crypto'],
            ['name' => 'Other', 'slug' => 'other'],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }
}
