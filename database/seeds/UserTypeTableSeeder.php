<?php

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_type = new UserType;
        $user_type->user_type_name_de = 'Privat';
        $user_type->user_type_name_en = 'Private';
        $user_type->user_type_name_it = 'Privato';
        $user_type->user_type_name_fr = 'Private';
        $user_type->save();

        $user_type = new UserType;
        $user_type->user_type_name_de = 'Lokal';
        $user_type->user_type_name_en = 'Local';
        $user_type->user_type_name_it = 'Locale';
        $user_type->user_type_name_fr = 'Local';
        $user_type->save();
    }
}
