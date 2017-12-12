<?php

use App\Models\ServiceOption;
use Illuminate\Database\Seeder;

class ServiceOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = 'men';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = 'women';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = 'couples';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = 'gays';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = 'trans';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name = '2+';
        $serviceOption->save();
    }
}
