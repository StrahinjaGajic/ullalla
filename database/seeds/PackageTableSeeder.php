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
        $package->package_name = '7 / S';
        $package->package_duration = '7 Days';
        $package->package_price = '50 CHF';
        $package->save();

        $package = new Package;
        $package->package_name = '14 / M';
        $package->package_duration = '14 Days';
        $package->package_price = '150 CHF';
        $package->save();

        $package = new Package;
        $package->package_name = '30 / L';
        $package->package_duration = '30 Days';
        $package->package_price = '250 CHF';
        $package->save();

        $package = new Package;
        $package->package_name = '90 / XL';
        $package->package_duration = '90 Days';
        $package->package_price = '350 CHF';
        $package->save();

        $package = new Package;
        $package->package_name = '180 / XXL';
        $package->package_duration = '180 Days';
        $package->package_price = '450 CHF';
        $package->save();

        $package = new Package;
        $package->package_name = '360 / XXXL';
        $package->package_duration = '360 Days';
        $package->package_price = '550 CHF';
        $package->save();
    }
}
