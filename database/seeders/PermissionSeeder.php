<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        Permission
      Permission::create([
        'type' => 'Permission',
        'name' => 'Manage Permission'
      ]);

//      Role
        Permission::create([
          'type' => 'Role',
          'name' => 'List Of Role'
        ]);
        Permission::create([
          'type' => 'Role',
          'name' => 'Create Role'
        ]);
        Permission::create([
          'type' => 'Role',
          'name' => 'Manage Role'
        ]);
        Permission::create([
          'type' => 'Role',
          'name' => 'Delete Role'
        ]);
        Permission::create([
          'type' => 'Role',
          'name' => 'View Role'
        ]);


//      User
      Permission::create([
        'type' => 'User',
        'name' => 'List Of User'
      ]);
      Permission::create([
        'type' => 'User',
        'name' => 'Create User'
      ]);
      Permission::create([
        'type' => 'User',
        'name' => 'Manage User'
      ]);
      Permission::create([
        'type' => 'User',
        'name' => 'Delete User'
      ]);
      Permission::create([
        'type' => 'User',
        'name' => 'View User'
      ]);

    }
}
