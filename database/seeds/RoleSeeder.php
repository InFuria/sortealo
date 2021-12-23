<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->slug = "admin";
        $role->name = "Administrador";
        $role->save();

        $role = new Role();
        $role->slug = "company";
        $role->name = "Empresa";
        $role->save();

        $role = new Role();
        $role->slug = "staff";
        $role->name = "Personal";
        $role->save();
    }
}
