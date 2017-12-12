<?php

use App\Models\Canton;
use Illuminate\Database\Seeder;

class CantonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $canton = new canton;
        $canton->canton_name = 'Zürich';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Bern';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Luzern';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Uri';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Schwyz';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Obwalden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Nidwalden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Glarus';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Zug';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Fribourg';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Solothurn';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Basel-Stadt';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Basel-Landschaft';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Schaffhausen';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Appenzell Ausserrhoden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Appenzell Innerrhoden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'St. Gallen';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Graubünden';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Aargau';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Thurgau';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Ticino';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Vaud';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Valais';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Neuchâtel';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Geneva';
        $canton->save();

        $canton = new canton;
        $canton->canton_name = 'Jura';
        $canton->save();
    }
}
