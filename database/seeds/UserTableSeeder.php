<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->nickname = 'Jena';
        $user->first_name = 'Jena';
        $user->last_name = 'Jansen';
        $user->username = 'shogun';
        $user->email = 'disabledbyfb@gmail.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '0';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena2';
        $user->first_name = 'Jena2';
        $user->last_name = 'Jansen2';
        $user->username = 'test1';
        $user->email = 'test1@test1.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '0';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena3';
        $user->first_name = 'Jena3';
        $user->last_name = 'Jansen3';
        $user->username = 'test2';
        $user->email = 'test2@test2.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '0';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena4';
        $user->first_name = 'Jena4';
        $user->last_name = 'Jansen4';
        $user->username = 'test3';
        $user->email = 'test3@test3.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena5';
        $user->first_name = 'Jena5';
        $user->last_name = 'Jansen5';
        $user->username = 'test4';
        $user->email = 'test4@test4.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena6';
        $user->first_name = 'Jena6';
        $user->last_name = 'Jansen6';
        $user->username = 'test5';
        $user->email = 'test5@test5.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena7';
        $user->first_name = 'Jena7';
        $user->last_name = 'Jansen7';
        $user->username = 'test6';
        $user->email = 'test6@test6.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena8';
        $user->first_name = 'Jena8';
        $user->last_name = 'Jansen8';
        $user->username = 'test7';
        $user->email = 'test7@test7.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena8';
        $user->first_name = 'Jena8';
        $user->last_name = 'Jansen8';
        $user->username = 'test8';
        $user->email = 'test8@test8.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena9';
        $user->first_name = 'Jena9';
        $user->last_name = 'Jansen9';
        $user->username = 'test9';
        $user->email = 'test9@test9.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena10';
        $user->first_name = 'Jena10';
        $user->last_name = 'Jansen10';
        $user->username = 'test10';
        $user->email = 'test10@test10.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena11';
        $user->first_name = 'Jena11';
        $user->last_name = 'Jansen11';
        $user->username = 'test11';
        $user->email = 'test11@test11.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->approved = '1';
        $user->save();

        $user = new User;
        $user->nickname = 'Jena12';
        $user->first_name = 'Jena12';
        $user->last_name = 'Jansen12';
        $user->username = 'test12';
        $user->email = 'test12@test12.com';
        $user->password = bcrypt('apostat');
        $user->activated = '1';
        $user->user_type_id = '1';
        $user->save();
    }
}
