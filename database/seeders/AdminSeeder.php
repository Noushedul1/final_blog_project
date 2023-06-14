<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Mamunur Rashid Mamun',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678')
        ];
        Admin::create($admin);
    }
}
