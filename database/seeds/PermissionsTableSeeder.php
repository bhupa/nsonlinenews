<?php

use Illuminate\Database\Seeder;
use App\Model\Permission\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::Create([
            'name'=>'View User',
            'slug'=>'view-user'
        ]);
        Permission::Create([
            'name'=>'Add User',
            'slug'=>'add-user'
        ]);
        Permission::Create([
            'name'=>'Edit User',
            'slug'=>'edit-user'
        ]);
        Permission::Create([
            'name'=>'Delete User',
            'slug'=>'delete-user'
        ]);
        Permission::Create([
            'name'=>'View Role',
            'slug'=>'view-role'
        ]);
        Permission::Create([
            'name' => 'Add Role',
            'slug' => 'add-role'
        ]);

        Permission::Create([
            'name' => 'Edit Role',
            'slug' => 'edit-role'
        ]);

        Permission::Create([
            'name' => 'Delete Role',
            'slug' => 'delete-role'
        ]);
        Permission::Create([
            'name'=>'View Permission',
            'slug'=>'view-permission'
        ]);
        Permission::Create([
            'name' => 'Add Permission',
            'slug' => 'add-permission'
        ]);

        Permission::Create([
            'name' => 'Edit Permission',
            'slug' => 'edit-permission'
        ]);

        Permission::Create([
            'name' => 'Delete Permission',
            'slug' => 'delete-permission'
        ]);
    }
}
