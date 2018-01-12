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
        $package->name = 'Solo';
        $package->month_price = '1';
        $package->year_price = '12';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Start 1-5';
        $package->month_price = '2';
        $package->year_price = '24';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Business 6-10';
        $package->month_price = '3';
        $package->year_price = '36';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Pro 11-20';
        $package->month_price = '4';
        $package->year_price = '48';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'VIP 21-40';
        $package->month_price = '4';
        $package->year_price = '48';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'ELITE 41+';
        $package->month_price = '4';
        $package->year_price = '48';
        $package->save();
    }
}
