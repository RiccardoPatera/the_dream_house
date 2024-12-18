<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Alessandra',
            'surname'=>'Schilardi',
            'email'=>'thedreamhouseinterior@gmail.com',
            'password'=>Hash::make('Alessandra1981?'),
            'is_admin'=>1,
        ]);
    }
}
