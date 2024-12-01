<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   

public function run()
{
    $roles = ['admin', 'lecturer', 'teaching_assistant', 'student'];
    foreach ($roles as $roleName) {
        Role::firstOrCreate(['name' => $roleName]);
    }
}

}
