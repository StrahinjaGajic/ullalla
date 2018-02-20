<?php

use App\Models\LocalType;
use Illuminate\Database\Seeder;

class LocalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new LocalType;
        $type->name_de = 'Cabaret';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Kontaktbar';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Saunaclub';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Studio';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Escort Agency';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Swingerclub';
        $type->save();
    }
}
