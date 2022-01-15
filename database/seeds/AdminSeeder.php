<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin              = new User();
        $admin->name        = "Administrador";
        $admin->username    = "admin";
        $admin->email       = "admin@sortealo.com";
        $admin->password    = Hash::make("adm123sortea");
        $admin->photo       = NULL;
        $admin->role_id     = 1;
        $admin->company_id  = 1;
        $admin->status      = 1;
        $admin->save();

        $staff              = new User();
        $staff->name        = "Personal";
        $staff->username    = "staff";
        $staff->email       = "staff@sortealo.com";
        $staff->password    = Hash::make("test1234");
        $staff->photo       = NULL;
        $staff->role_id     = 3;
        $staff->company_id  = 1;
        $staff->status      = 1;
        $staff->save();
    }
}
