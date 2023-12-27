<?php

namespace Database\Seeders;

use App\Enums\AdminType;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => "Quản lý",
            'email' => "admin@gmail.com",
            'password' => Hash::make('adminvjppro'),
            'phone' => "0123456789",
            'address' => "Hà Nội",
            'role' => AdminType::QUAN_LY
        ];
        Admin::query()->create($data);
    }
}
