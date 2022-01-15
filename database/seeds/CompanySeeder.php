<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company        = new Company();
        $company->name  = "Empresa del sistema";
        $company->email = "";
        $company->photo = NULL;
        $company->status = 1;
        $company->save();
    }
}
