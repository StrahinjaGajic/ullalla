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
        $type->name_en = 'Cabaret';
        $type->name_it = 'Cabaret';
        $type->name_fr = 'Cabaret';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Kontaktbar';
        $type->name_en = 'Kontaktbar';
        $type->name_it = 'Kontaktbar';
        $type->name_fr = 'Kontaktbar';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Saunaclub';
        $type->name_en = 'Saunaclub';
        $type->name_it = 'Saunaclub';
        $type->name_fr = 'Saunaclub';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Studio';
        $type->name_en = 'Studio';
        $type->name_it = 'Studio';
        $type->name_fr = 'Studio';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Escort Agentur';
        $type->name_en = 'Escort Agency';
        $type->name_it = 'Escort Agency';
        $type->name_fr = 'Escort Agency';
        $type->save();

        $type = new LocalType;
        $type->name_de = 'Swingerclub';
        $type->name_en = 'Swingerclub';
        $type->name_it = 'Swingerclub';
        $type->name_fr = 'Swingerclub';
        $type->save();
    }
}
