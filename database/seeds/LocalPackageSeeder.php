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
        $package->month_price = '125';
        $package->year_price = '1250';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Start 1-5';
        $package->month_price = '200';
        $package->year_price = '2000';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Business 6-10';
        $package->month_price = '325';
        $package->year_price = '3250';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'Pro 11-20';
        $package->month_price = '550';
        $package->year_price = '5500';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'VIP 21-40';
        $package->month_price = '750';
        $package->year_price = '7500';
        $package->save();

        $package = new LocalPackage;
        $package->name = 'ELITE 41+';
        $package->month_price = '0';
        $package->year_price = '0';
        $package->save();
    }
}
