<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// Create Admin
        Admin::updateOrCreate(
            ['email' => 'admin@osool.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('user123'), // 🔐 Stronger password recommended
            ]
        );

        User::updateOrCreate(
            ['email' => 'dipak@osool.com'],
            ['name' => 'Dipak Ratnani', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'nael@osool.com'],
            ['name' => 'Nael W Skaik', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'mohammad.h@osool.com'],
            ['name' => 'Mohammad Alhayajneh', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'fouzan@osool.com'],
            ['name' => 'Fouzan Shaik', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'khansaa@osool.com'],
            ['name' => 'Khansaa', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'aymen@osool.com'],
            ['name' => 'Aymen Smida', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'mithlesh@osool.com'],
            ['name' => 'Mithlesh Das', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'ikbal@osool.com'],
            ['name' => 'Ikbal', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'narsimha@osool.com'],
            ['name' => 'Narsimha', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'ghayth@osool.com'],
            ['name' => 'Ghayth Ben Gara', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'malik@osool.com'],
            ['name' => 'Malik Naser', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'kader@osool.com'],
            ['name' => 'Mohammad Kader', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'adil@osool.com'],
            ['name' => 'Mohd Adil', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'vipul@osool.com'],
            ['name' => 'Vipul', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'happy@osool.com'],
            ['name' => 'Happy Sharma', 'password' => Hash::make('user123')]
        );

        User::updateOrCreate(
            ['email' => 'feras@osool.com'],
            ['name' => 'Feras Mohamed', 'password' => Hash::make('user123')]
        );
    }
}
