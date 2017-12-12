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
        $contactOption->save();

        $contactOption = new ContactOption;
        $contactOption->contact_option_name = 'whatsapp';
        $contactOption->save();

        $contactOption = new ContactOption;
        $contactOption->contact_option_name = 'skype';
        $contactOption->save();
    }
}
