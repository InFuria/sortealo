<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(FaqCategorySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(AdminSeeder::class);
    }
}
