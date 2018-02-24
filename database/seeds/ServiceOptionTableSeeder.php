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
        $serviceOption->service_option_name_de = 'men';
        $serviceOption->service_option_name_en = 'men';
        $serviceOption->service_option_name_it = 'men';
        $serviceOption->service_option_name_fr = 'men';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name_de = 'women';
        $serviceOption->service_option_name_en = 'women';
        $serviceOption->service_option_name_it = 'women';
        $serviceOption->service_option_name_fr = 'women';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name_de = 'couples';
        $serviceOption->service_option_name_en = 'couples';
        $serviceOption->service_option_name_it = 'couples';
        $serviceOption->service_option_name_fr = 'couples';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name_de = 'gays';
        $serviceOption->service_option_name_en = 'gays';
        $serviceOption->service_option_name_it = 'gays';
        $serviceOption->service_option_name_fr = 'gays';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name_de = 'trans';
        $serviceOption->service_option_name_en = 'trans';
        $serviceOption->service_option_name_it = 'trans';
        $serviceOption->service_option_name_fr = 'trans';
        $serviceOption->save();

        $serviceOption = new ServiceOption;
        $serviceOption->service_option_name_de = '2+';
        $serviceOption->service_option_name_en = '2+';
        $serviceOption->service_option_name_it = '2+';
        $serviceOption->service_option_name_fr = '2+';
        $serviceOption->save();
    }
}
