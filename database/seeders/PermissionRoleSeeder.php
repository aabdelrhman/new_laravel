<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'show-section',
            'create-section',
            'edit-section',
            'delete-section',
            'show-brand',
            'create-brand',
            'edit-brand',
            'delete-brand',
            'show-product',
            'create-product',
            'edit-product',
            'delete-product',
            'archif-product',
            'show-role',
            'create-role',
            'edit-role',
            'delete-role',
        ];
        foreach($permissions as $permission){
            $all_permissions[] = Permission::create(['name' => $permission]);
        }
        $owner = Role::create([
            'name' => 'owner',
            'display_name' => 'Project Owner', // optional
            'description' => 'User is the owner of a given project', // optional
        ]);

        $owner -> syncPermissions($all_permissions);
        $admin = Admin::first() -> attachRole($owner);
    }
}
