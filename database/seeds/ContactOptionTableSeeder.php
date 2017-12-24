<?php

use App\Models\ContactOption;
use Illuminate\Database\Seeder;

class ContactOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactOption = new ContactOption;
        $contactOption->contact_option_name = 'viber';
        $contactOption->icon = '';
        $contactOption->save();

        $contactOption = new ContactOption;
        $contactOption->contact_option_name = 'whatsapp';
        $contactOption->icon = '<i style="color:#34AF23" class="fa fa-whatsapp" aria-hidden="true"></i>';
        $contactOption->save();

        $contactOption = new ContactOption;
        $contactOption->contact_option_name = 'skype';
        $contactOption->icon = '<i style="color:#00aff0" class="fa fa-skype" aria-hidden="true"></i>';
        $contactOption->save();
    }
}
