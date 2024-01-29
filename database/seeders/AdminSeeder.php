<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('admin', true)->count() == 0) {
            $admin = new User();
            $admin->name = 'Admin';
            $admin->email = 'admin@university.com';
            $admin->password = Hash::make("admin@123");
            $admin->admin = true;
            $admin->save();
        }
    }
}
