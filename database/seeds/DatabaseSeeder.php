<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	protected $toTruncate = [
		'user_types',
        'countries',
        'services',
        'cantons',
        'packages',
        'users',
        'roles',
        'contact_options',
        'service_options',
        'spoken_languages',
        'local_types',
        'local_packages',
        'faqs',
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach ($this->toTruncate as $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        }
        $this->call(CantonTableSeeder::class);
        $this->call(PackageTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(ContactOptionTableSeeder::class);
        $this->call(ServiceOptionTableSeeder::class);
        $this->call(SpokenLanguageTableSeeder::class);
        $this->call(LocalTypeSeeder::class);
        $this->call(LocalPackageSeeder::class);
        $this->call(FaqTableSeeder::class);
    }
}
