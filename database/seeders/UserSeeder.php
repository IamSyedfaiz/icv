<?php

namespace Database\Seeders;

use App\Http\Helpers\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $admin = User::create([
            'name' => 'Admin',
            'phone' => '8989898989',
            'email' => 'admin@gmail.com',
            'active' => 'Y',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole(Roles::ADMIN()->getValue());


        // Sub Admin
        $sales = User::create([
            'name' => 'test',
            'phone' => '8989898989',
            'active' => 'Y',
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345678'),
            'parent_id' => $admin->id
        ]);
        $sales->assignRole(Roles::SALES()->getValue());
    }
}
