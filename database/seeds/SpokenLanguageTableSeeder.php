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
        $spokenLanguage->spoken_language_name_de = 'Englisch';
        $spokenLanguage->spoken_language_name_en = 'English';
        $spokenLanguage->spoken_language_name_it = 'English';
        $spokenLanguage->spoken_language_name_fr = 'English';
        $spokenLanguage->spoken_language_code = 'en';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Deutsch';
        $spokenLanguage->spoken_language_name_en = 'German';
        $spokenLanguage->spoken_language_name_it = 'German';
        $spokenLanguage->spoken_language_name_fr = 'German';
        $spokenLanguage->spoken_language_code = 'de';

        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Italienisch';
        $spokenLanguage->spoken_language_name_en = 'Italian';
        $spokenLanguage->spoken_language_name_it = 'Italian';
        $spokenLanguage->spoken_language_name_fr = 'Italian';
        $spokenLanguage->spoken_language_code = 'it';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Französisch';
        $spokenLanguage->spoken_language_name_en = 'French';
        $spokenLanguage->spoken_language_name_it = 'French';
        $spokenLanguage->spoken_language_name_fr = 'French';
        $spokenLanguage->spoken_language_code = 'fr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Spanisch';
        $spokenLanguage->spoken_language_name_en = 'Spanish';
        $spokenLanguage->spoken_language_name_it = 'Spanish';
        $spokenLanguage->spoken_language_name_fr = 'Spanish';
        $spokenLanguage->spoken_language_code = 'es';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Russisch';
        $spokenLanguage->spoken_language_name_en = 'Russian';
        $spokenLanguage->spoken_language_name_it = 'Russian';
        $spokenLanguage->spoken_language_name_fr = 'Russian';
        $spokenLanguage->spoken_language_code = 'ru';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Portugiesisch';
        $spokenLanguage->spoken_language_name_en = 'Portuguese';
        $spokenLanguage->spoken_language_name_it = 'Portuguese';
        $spokenLanguage->spoken_language_name_fr = 'Portuguese';
        $spokenLanguage->spoken_language_code = 'pt';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Holländisch';
        $spokenLanguage->spoken_language_name_en = 'Dutch';
        $spokenLanguage->spoken_language_name_it = 'Dutch';
        $spokenLanguage->spoken_language_name_fr = 'Dutch';
        $spokenLanguage->spoken_language_code = 'nl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Serbisch';
        $spokenLanguage->spoken_language_name_en = 'Serbian';
        $spokenLanguage->spoken_language_name_it = 'Serbian';
        $spokenLanguage->spoken_language_name_fr = 'Serbian';
        $spokenLanguage->spoken_language_code = 'rs';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Slowenisch';
        $spokenLanguage->spoken_language_name_en = 'Slovenian';
        $spokenLanguage->spoken_language_name_it = 'Slovenian';
        $spokenLanguage->spoken_language_name_fr = 'Slovenian';
        $spokenLanguage->spoken_language_code = 'sl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Slowakisch';
        $spokenLanguage->spoken_language_name_en = 'Slovak';
        $spokenLanguage->spoken_language_name_it = 'Slovak';
        $spokenLanguage->spoken_language_name_fr = 'Slovak';
        $spokenLanguage->spoken_language_code = 'sk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Griechsich';
        $spokenLanguage->spoken_language_name_en = 'Greek';
        $spokenLanguage->spoken_language_name_it = 'Greek';
        $spokenLanguage->spoken_language_name_fr = 'Greek';
        $spokenLanguage->spoken_language_code = 'gr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Bulgarisch';
        $spokenLanguage->spoken_language_name_en = 'Bulgarian';
        $spokenLanguage->spoken_language_name_it = 'Bulgarian';
        $spokenLanguage->spoken_language_name_fr = 'Bulgarian';
        $spokenLanguage->spoken_language_code = 'bg';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Tschechisch';
        $spokenLanguage->spoken_language_name_en = 'Czech';
        $spokenLanguage->spoken_language_name_it = 'Czech';
        $spokenLanguage->spoken_language_name_fr = 'Czech';
        $spokenLanguage->spoken_language_code = 'cz';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Indisch';
        $spokenLanguage->spoken_language_name_en = 'Indian';
        $spokenLanguage->spoken_language_name_it = 'Indian';
        $spokenLanguage->spoken_language_name_fr = 'Indian';
        $spokenLanguage->spoken_language_code = 'in';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Arabisch';
        $spokenLanguage->spoken_language_name_en = 'Arabic';
        $spokenLanguage->spoken_language_name_it = 'Arabic';
        $spokenLanguage->spoken_language_name_fr = 'Arabic';
        $spokenLanguage->spoken_language_code = 'sa';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Thailändisch';
        $spokenLanguage->spoken_language_name_en = 'Thai';
        $spokenLanguage->spoken_language_name_it = 'Thai';
        $spokenLanguage->spoken_language_name_fr = 'Thai';
        $spokenLanguage->spoken_language_code = 'th';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Japanisch';
        $spokenLanguage->spoken_language_name_en = 'Japanese';
        $spokenLanguage->spoken_language_name_it = 'Japanese';
        $spokenLanguage->spoken_language_name_fr = 'Japanese';
        $spokenLanguage->spoken_language_code = 'jp';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Chinesisch';
        $spokenLanguage->spoken_language_name_en = 'Chinese';
        $spokenLanguage->spoken_language_name_it = 'Chinese';
        $spokenLanguage->spoken_language_name_fr = 'Chinese';
        $spokenLanguage->spoken_language_code = 'cn';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Finnisch';
        $spokenLanguage->spoken_language_name_en = 'Finnish';
        $spokenLanguage->spoken_language_name_it = 'Finnish';
        $spokenLanguage->spoken_language_name_fr = 'Finnish';
        $spokenLanguage->spoken_language_code = 'fi';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Norwegisch';
        $spokenLanguage->spoken_language_name_en = 'Norwegian';
        $spokenLanguage->spoken_language_name_it = 'Norwegian';
        $spokenLanguage->spoken_language_name_fr = 'Norwegian';
        $spokenLanguage->spoken_language_code = 'no';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Swedisch';
        $spokenLanguage->spoken_language_name_en = 'Swedish';
        $spokenLanguage->spoken_language_name_it = 'Swedish';
        $spokenLanguage->spoken_language_name_fr = 'Swedish';
        $spokenLanguage->spoken_language_code = 'se';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Dänisch';
        $spokenLanguage->spoken_language_name_en = 'Danish';
        $spokenLanguage->spoken_language_name_it = 'Danish';
        $spokenLanguage->spoken_language_name_fr = 'Danish';
        $spokenLanguage->spoken_language_code = 'dk';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Turkisch';
        $spokenLanguage->spoken_language_name_en = 'Turkish';
        $spokenLanguage->spoken_language_name_it = 'Turkish';
        $spokenLanguage->spoken_language_name_fr = 'Turkish';
        $spokenLanguage->spoken_language_code = 'tr';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Polnisch';
        $spokenLanguage->spoken_language_name_en = 'Polish';
        $spokenLanguage->spoken_language_name_it = 'Polish';
        $spokenLanguage->spoken_language_name_fr = 'Polish';
        $spokenLanguage->spoken_language_code = 'pl';
        $spokenLanguage->save();

        $spokenLanguage = new SpokenLanguage;
        $spokenLanguage->spoken_language_name_de = 'Rumänisch';
        $spokenLanguage->spoken_language_name_en = 'Romanian';
        $spokenLanguage->spoken_language_name_it = 'Romanian';
        $spokenLanguage->spoken_language_name_fr = 'Romanian';
        $spokenLanguage->spoken_language_code = 'ro';
        $spokenLanguage->save();
    }
}
