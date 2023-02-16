<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            array(
                'name'              => 'test test',
                'email'             => 'test@test.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
            ),
        ];

        foreach ($datos as $key => $value) {
            User::updateOrCreate([
                'email'             => $value['email'],
            ], $value);
        }
    }
}
