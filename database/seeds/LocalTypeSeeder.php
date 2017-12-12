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
        $type->name = 'Tip 1';
        $type->save();

        $type = new LocalType;
        $type->name = 'Tip 2';
        $type->save();

        $type = new LocalType;
        $type->name = 'Tip 3';
        $type->save();

        $type = new LocalType;
        $type->name = 'Tip 4';
        $type->save();

        $type = new LocalType;
        $type->name = 'Tip 5';
        $type->save();

        $type = new LocalType;
        $type->name = 'Tip 6';
        $type->save();
    }
}
