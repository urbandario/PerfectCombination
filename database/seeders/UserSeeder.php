<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'trainer' => 0,
                'trainer_approved' => 0,
                'admin' => 1,
                'avatar' => 'default.png',
                'biography' => 'Admin biografija',
                'phone' => '002543678',
            ],
            [
                'name' => 'Trener',
                'email' => 'trener@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'trainer' => 1,
                'trainer_approved' => 1,
                'admin' => 0,
                'avatar' => 'default.png',
                'biography' => 'Trener biografija',
                'phone' => '156184981',
            ],
            [
                'name' => 'Trener2',
                'email' => 'trener2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'trainer' => 1,
                'trainer_approved' => 1,
                'admin' => 0,
                'avatar' => 'default.png',
                'biography' => 'Trener2 biografija',
                'phone' => '1561849816',
            ],
            [
                'name' => 'Obican',
                'email' => 'obican@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'trainer' => 0,
                'trainer_approved' => 0,
                'admin' => 0,
                'avatar' => 'default.png',
                'biography' => 'Obican biografija',
                'phone' => '2752752752',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
