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
        $user_type->user_type_name_de = 'Private';
        $user_type->save();

        $user_type = new UserType;
        $user_type->user_type_name_de = 'Local';
        $user_type->save();
    }
}
