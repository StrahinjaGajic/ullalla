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
        $spokenLanguage->spoken_language_name = 'English';
        $spokenLanguage->spoken_language_code = 'en';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'German';
        $spokenLanguage->spoken_language_code = 'de';

        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Italian';
        $spokenLanguage->spoken_language_code = 'it';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'French';
        $spokenLanguage->spoken_language_code = 'fr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Spanish';
        $spokenLanguage->spoken_language_code = 'es';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Russian';
        $spokenLanguage->spoken_language_code = 'ru';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Portuguese';
        $spokenLanguage->spoken_language_code = 'pt';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Dutch';
        $spokenLanguage->spoken_language_code = 'nl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Serbian';
        $spokenLanguage->spoken_language_code = 'rs';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Slovenian';
        $spokenLanguage->spoken_language_code = 'sl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Slovak';
        $spokenLanguage->spoken_language_code = 'sk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Greek';
        $spokenLanguage->spoken_language_code = 'gr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Bulgarian';
        $spokenLanguage->spoken_language_code = 'bg';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Czech';
        $spokenLanguage->spoken_language_code = 'cz';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Indian';
        $spokenLanguage->spoken_language_code = 'in';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Arabic';
        $spokenLanguage->spoken_language_code = 'sa';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Japanese';
        $spokenLanguage->spoken_language_code = 'jp';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Chinese';
        $spokenLanguage->spoken_language_code = 'cn';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Finnish';
        $spokenLanguage->spoken_language_code = 'fi';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Norwegian';
        $spokenLanguage->spoken_language_code = 'no';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Swedish';
        $spokenLanguage->spoken_language_code = 'se';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Danish';
        $spokenLanguage->spoken_language_code = 'dk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Turkish';
        $spokenLanguage->spoken_language_code = 'tr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Polish';
        $spokenLanguage->spoken_language_code = 'pl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name = 'Romanian';
        $spokenLanguage->spoken_language_code = 'ro';
        $spokenLanguage->save();
    }
}
