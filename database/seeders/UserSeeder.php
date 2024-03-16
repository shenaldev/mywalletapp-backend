<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Shenal Fernando',
            'email' => 'admin@shenaldev.com',
            'password' => Hash::make('1A@Fg12CV'),
            'is_admin' => true,
        ]);

        /* User::create([
            'name' => 'Demo',
            'email' => 'demo@mywalletcash.com',
            'password' => Hash::make('password'),
        ]); */
    }
}
