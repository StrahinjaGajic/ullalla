<?php

use Illuminate\Database\Seeder;
use App\Models\LocalPackage;

class LocalPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new LocalPackage;
        $package->name = 'Girls 1-10';
        $package->month_price = '1';
        $package->year_price = '12';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Girls 11 - 30';
        $package->month_price = '2';
        $package->year_price = '24';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Girls 31- 50';
        $package->month_price = '3';
        $package->year_price = '36';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Girls 51+';
        $package->month_price = '4';
        $package->year_price = '48';
        $package->save();
    }
}
