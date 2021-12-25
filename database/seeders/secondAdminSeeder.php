<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class secondAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Adbdelrhman',
            'email' => 'abdelrhma01111@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $role = Role::find(1);
        $admin -> attachRole($role);
    }
}
