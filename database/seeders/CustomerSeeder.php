<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => "Mar",
            'email' => "nvmanh@gmail.com",
            'password' => Hash::make('adminvjppro'),
            'phone' => "0123456789",
            'address' => "Nguyễn Tuân",
            'district' => 'Hà Đông',
            'city' => 'Hà Nội',
            'verify_code' => '123456',
            'is_active' => '1',
        ];
        Customer::query()->create($data);
    }
}
