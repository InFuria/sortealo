<?php

use App\FaqCategory;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new FaqCategory();
        $role->name = "Compras";
        $role->save();

        $role = new FaqCategory();
        $role->name = "Pagos";
        $role->save();

        $role = new FaqCategory();
        $role->name = "Sorteos";
        $role->save();

        $role = new FaqCategory();
        $role->name = "Empresas";
        $role->save();

        $role = new FaqCategory();
        $role->name = "Ayuda sobre tu cuenta";
        $role->save();

        $role = new FaqCategory();
        $role->name = "Alcance y disponibilidad";
        $role->save();
    }
}
