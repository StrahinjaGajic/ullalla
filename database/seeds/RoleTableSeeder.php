<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_user = Role::create([
    		'role_name' => 'Standard User',
    		'role_description' => 'A standard registered user with no admin rights.'
    	]);
    	$role_moderator = Role::create([
    		'role_name' => 'Moderator',
    		'role_description' => 'A moderator of the website who has similar permissions as the admin, but is not allowed to go to the admin page etc.'
    	]);
    	$role_admin = Role::create([
    		'role_name' => 'Admin',
    		'role_description' => 'An admin of the website who has similar permissions as the super admin, but still some of the permissions are restricted.'
    	]);
    }
}
