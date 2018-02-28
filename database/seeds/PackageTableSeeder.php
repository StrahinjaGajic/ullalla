<?php

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new Package;
        $package->package_name = 'S';
        $package->package_duration = '7';
        $package->package_price = '35';
        $package->save();

        $package = new Package;
        $package->package_name = 'M';
        $package->package_duration = '14';
        $package->package_price = '60';
        $package->save();

        $package = new Package;
        $package->package_name = 'L';
        $package->package_duration = '30';
        $package->package_price = '100';
        $package->save();

        $package = new Package;
        $package->package_name = 'XL';
        $package->package_duration = '90';
        $package->package_price = '250';
        $package->save();

        $package = new Package;
        $package->package_name = 'XXL';
        $package->package_duration = '180';
        $package->package_price = '450';
        $package->save();

        $package = new Package;
        $package->package_name = 'XXXL';
        $package->package_duration = '365';
        $package->package_price = '850';
        $package->save();
    }
}
