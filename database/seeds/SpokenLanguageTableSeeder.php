<?php

use App\Models\SpokenLanguage;
use Illuminate\Database\Seeder;

class SpokenLanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'English';
        $spokenLanguage->spoken_language_code = 'en';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'German';
        $spokenLanguage->spoken_language_code = 'de';

        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Italian';
        $spokenLanguage->spoken_language_code = 'it';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'French';
        $spokenLanguage->spoken_language_code = 'fr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Spanish';
        $spokenLanguage->spoken_language_code = 'es';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Russian';
        $spokenLanguage->spoken_language_code = 'ru';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Portuguese';
        $spokenLanguage->spoken_language_code = 'pt';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Dutch';
        $spokenLanguage->spoken_language_code = 'nl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Serbian';
        $spokenLanguage->spoken_language_code = 'rs';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Slovenian';
        $spokenLanguage->spoken_language_code = 'sl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Slovak';
        $spokenLanguage->spoken_language_code = 'sk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Greek';
        $spokenLanguage->spoken_language_code = 'gr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Bulgarian';
        $spokenLanguage->spoken_language_code = 'bg';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Czech';
        $spokenLanguage->spoken_language_code = 'cz';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Indian';
        $spokenLanguage->spoken_language_code = 'in';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Arabic';
        $spokenLanguage->spoken_language_code = 'sa';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Thailand';
        $spokenLanguage->spoken_language_code = 'th';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Japanese';
        $spokenLanguage->spoken_language_code = 'jp';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Chinese';
        $spokenLanguage->spoken_language_code = 'cn';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Finnish';
        $spokenLanguage->spoken_language_code = 'fi';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Norwegian';
        $spokenLanguage->spoken_language_code = 'no';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Swedish';
        $spokenLanguage->spoken_language_code = 'se';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Danish';
        $spokenLanguage->spoken_language_code = 'dk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Turkish';
        $spokenLanguage->spoken_language_code = 'tr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Polish';
        $spokenLanguage->spoken_language_code = 'pl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Romanian';
        $spokenLanguage->spoken_language_code = 'ro';
        $spokenLanguage->save();
    }
}
