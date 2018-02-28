<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Patvirtinimo kalbos eilutės
    |--------------------------------------------------------------------------
    |
    | Sekančios kalbos eilutėse yra numatyti klaidos pranešimai naudojami
    | patvirtinimo klasėje. Kai kurios iš šių eilučių turi keletą versijų
    | tokių kaip dydžio taisyklės. Galite laisvai pataisyti bet kuriuos pranešimus.
    |
    */

    'accepted'             => 'Laukas :attribute turi būti priimtas.',
    'active_url'           => 'Laukas :attribute nėra galiojantis internetinis adresas.',
    'after'                => 'Lauko :attribute reikšmė turi būti po :date datos.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'Laukas :attribute gali turėti tik raides.',
    'alpha_dash'           => 'Laukas :attribute gali turėti tik raides, skaičius ir brūkšnelius.',
    'alpha_num'            => 'Laukas :attribute gali turėti tik raides ir skaičius.',
    'array'                => 'Laukas :attribute turi būti masyvas.',
    'before'               => 'Laukas :attribute turi būti data prieš :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'Lauko :attribute reikšmė turi būti tarp :min ir :max.',
        'file'    => 'Failo dydis lauke :attribute turi būti tarp :min ir :max kilobaitų.',
        'string'  => 'Simbolių skaičius lauke :attribute turi būti tarp :min ir :max.',
        'array'   => 'Elementų skaičius lauke :attribute turi turėti nuo :min iki :max.',
    ],
    'boolean'              => "Lauko reikšmė :attribute turi būti 'taip' arba 'ne'.",
    'confirmed'            => 'Lauko :attribute patvirtinimas nesutampa.',
    'date'                 => 'Lauko :attribute reikšmė nėra galiojanti data.',
    'date_format'          => 'Lauko :attribute reikšmė neatitinka formato :format.',
    'different'            => 'Laukų :attribute ir :other reikšmės turi skirtis.',
    'digits'               => 'Laukas :attribute turi būti sudarytas iš :digits skaitmenų.',
    'digits_between'       => 'Laukas :attribute tuti turėti nuo :min iki :max skaitmenų.',
    'dimensions'           => 'Lauke :attribute įkeltas paveiksliukas neatitinka išmatavimų reikalavimo.',
    'distinct'             => 'Laukas :attribute pasikartoja.',
    'email'                => 'Lauko :attribute reikšmė turi būti galiojantis el. pašto adresas.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Laukas :attribute turi būti užpildytas.',
    'exists'               => 'Pasirinkta negaliojanti :attribute reikšmė.',
    'image'                => 'Lauko :attribute reikšmė turi būti paveikslėlis.',
    'in'                   => 'Pasirinkta negaliojanti :attribute reikšmė.',
    'in_array'             => 'Laukas :attribute neegzistuoja :other lauke.',
    'integer'              => 'Lauko :attribute reikšmė turi būti veikasis skaičius.',
    'ip'                   => 'Lauko :attribute reikšmė turi būti galiojantis IP adresas.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'Lauko :attribute reikšmė turi būti JSON tekstas.',
    'max'                  => [
        'numeric' => 'Lauko :attribute reikšmė negali būti didesnė nei :max.',
        'file'    => 'Failo dydis lauke :attribute reikšmė negali būti didesnė nei :max kilobaitų.',
        'string'  => 'Simbolių kiekis lauke :attribute reikšmė negali būti didesnė nei :max simbolių.',
        'array'   => 'Elementų kiekis lauke :attribute negali turėti daugiau nei :max elementų.',
    ],
    'mimes'                => 'Lauko reikšmė :attribute turi būti failas vieno iš sekančių tipų: :values.',
    'mimetypes'            => 'Lauko reikšmė :attribute turi būti failas vieno iš sekančių tipų: :values.',
    'min'                  => [
        'numeric' => 'Lauko :attribute reikšmė turi būti ne mažesnė nei :min.',
        'file'    => 'Failo dydis lauke :attribute turi būti ne mažesnis nei :min kilobaitų.',
        'string'  => 'Simbolių kiekis lauke :attribute turi būti ne mažiau nei :min.',
        'array'   => 'Elementų kiekis lauke :attribute turi būti ne mažiau nei :min.',
    ],
    'not_in'               => 'Pasirinkta negaliojanti reikšmė :attribute.',
    'numeric'              => 'Lauko :attribute reikšmė turi būti skaičius.',
    'present'              => 'Laukas :attribute turi egzistuoti.',
    'regex'                => 'Negaliojantis lauko :attribute formatas.',
    'required'             => 'Privaloma užpildyti lauką :attribute.',
    'required_if'          => 'Privaloma užpildyti lauką :attribute kai :other yra :value.',
    'required_unless'      => 'Laukas :attribute yra privalomas, nebent :other yra tarp :values reikšmių.',
    'required_with'        => 'Privaloma užpildyti lauką :attribute kai pateikta :values.',
    'required_with_all'    => 'Privaloma užpildyti lauką :attribute kai pateikta :values.',
    'required_without'     => 'Privaloma užpildyti lauką :attribute kai nepateikta :values.',
    'required_without_all' => 'Privaloma užpildyti lauką :attribute kai nepateikta nei viena iš reikšmių :values.',
    'same'                 => 'Laukai :attribute ir :other turi sutapti.',
    'size'                 => [
        'numeric' => 'Lauko :attribute reikšmė turi būti :size.',
        'file'    => 'Failo dydis lauke :attribute turi būti :size kilobaitai.',
        'string'  => 'Simbolių skaičius lauke :attribute turi būti :size.',
        'array'   => 'Elementų kiekis lauke :attribute turi būti :size.',
    ],
    'string'               => 'Laukas :attribute turi būti tekstinis.',
    'timezone'             => 'Lauko :attribute reikšmė turi būti galiojanti laiko zona.',
    'unique'               => 'Tokia :attribute reikšmė jau pasirinkta.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'Negaliojantis lauko :attribute formatas.',

    /*
    |--------------------------------------------------------------------------
    | Pasirinktiniai patvirtinimo kalbos eilutės
    |--------------------------------------------------------------------------
    |
    | Čia galite nurodyti pasirinktinius patvirtinimo pranešimus, naudodami
    | konvenciją "attribute.rule" eilučių pavadinimams. Tai leidžia greitai
    | nurodyti konkrečią pasirinktinę kalbos eilutę tam tikrai atributo taisyklei.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],


    'skype_required' => 'Nome Skype richiesto',
    'choose_package' => 'Prego, seleziona un pacchetto',
    'mobile_required_with_sms_checked' => 'Campo richiesto, se le notifiche sms sono attivate.',

    /* Javascript Validation */
    'max_files' => 'Devi selezionare almeno 4 file',
    'required_field' => 'Questo campo č richiesto',
    'default_package_required' => 'Il pacchetto base č richiesto',
    'gotm_package_required' => 'Campo richiesto',
    'lotm_package_required' => 'Campo richiesto',
    'url_invalid' => 'URL non valida',
    'numeric_error' => 'Questo campo deve essere numerico',
    'string_length' => 'Questo campo non deve superare i 200 caratteri',
    'older_than_18' => 'Devi aver compiuto almeno 18 anni di etŕ',
    'alpha_numerical' => 'Il nome deve contenere solo lettere',
    'max_str_length' => 'Questo campo non deve superare :max caratteri',

    /* Upload care validation */
    'file_too_large' => 'File troppo grande',
    'file_too_large_title' => 'Errore: grandezza massima raggiunta',
    'file_type' => 'Tipo dato non corretto',
    'file_type_title' => 'Errore: tipo di file errato.',
    'min_photo_dimensions' => 'La dimensione minima della foto deve essere almeno 490x560',
    'min_dimensions_title' => 'Errore: dimensione minima raggiunta',

    /*
    |--------------------------------------------------------------------------
    | Pasirinktiniai patvirtinimo atributai
    |--------------------------------------------------------------------------
    |
    | Sekančios kalbos eilutės naudojamos pakeisti vietos žymes
    | kuo nors labiau priimtinu skaitytojui (pvz. "El.Pašto Adresas" vietoj
    | "email". TTai tiesiog padeda mums padaryti žinutes truputi aiškesnėmis.
    |
    */

    'attributes'           => [
        'country'               => 'Nazione',
        'gender'                => 'Genere',
        'gender_type'           => 'Tipo genere',
        'day'                   => 'Giorno',
        'month'                 => 'Mese',
        'year'                  => 'Anno',
        'hour'                  => 'Ore',
        'minute'                => 'Minuti',
        'second'                => 'Secondi',
        'title'                 => 'Titolo',
        'content'               => 'Contenuto',
        'excerpt'               => 'Estratto',
        'time'                  => 'Orari',
        'available'             => 'Disponibile',
        'size'                  => 'Dimensioni',
        'photos_1'              => 'Foto',
        'nickname_1'            => 'Nickname',
        'client_photo'          => 'Foto',

        "type" => 'Tipo',
        "city" => 'Cittŕ',
        "radius" => 'Raggio',
        "canton" => 'Cantone',
        "services" => 'Servizi',
        "age" => 'Etŕ',
        "price_type" => 'Tipo',
        "nickname" => 'Nickname',
        "first_name" => 'Nome',
        "last_name" => 'Cognome',
        "height" => 'Altezza',
        "weight" => 'Peso',
        "nationality" => 'Nazionalitŕ',
        "sex" => 'Sesso',
        "sex_orientation" => 'Orientamento sessuale',
        "figure" => 'Corporatura',
        "breast_size" => 'Grandezza seno',
        "eye_color" => 'Colore occhi',
        "hair_color" => 'Colore capelli',
        "tattoos" => 'Tatuaggi',
        "piercings" => 'Piercing',
        "body_hair" => 'Peli corporei',
        "intimate" => 'Intimo',
        "smoker" => 'Fumatore',
        "alcohol" => 'Alcool',
        "about_me" => 'Su di me',
        "video" => 'Video',
        "sms_notifications" => 'Notifiche SMS',
        "email" => 'Email',
        "website" => 'Sito Web',
        "web" => 'Web',
        "phone" => 'Telefono',
        "mobile" => 'Cellulare',
        "skype_name" => 'Nome Skype',
        "zip_code" => 'CAP',
        "address" => 'Indirizzo',
        "club_name" => 'Nome locale',
        "incall" => 'Interno',
        "outcall" => 'Esterno',
        "service_duration" => 'Durata',
        "service_price" => 'Prezzi',
        "service_price_unit" => 'Unitŕ',
        "service_price_currency" => 'Valuta',
        "date" => 'Data',
        "client_name" => 'Nome',
        "client_phone" => 'Telefono',
        "photo" => 'Foto',
        "description" => 'Descrizione',
        "username" => 'Nome utente',
        "password" => 'Password',
        "password_confirmation" => 'Conferma Password',
        "user_type" => 'Tipo',
        "ancestry" => 'Appartenenza',
        "name" => 'Nome',
        "street" => 'Via',
        "zip" => 'CAP',
        "logo" => 'Logo',
        "photos" => 'Foto',
        "news_flyer" => 'Volantino',
        "news_title" => 'Titolo',
        "news_duration" => 'Durata',
        "duration" => 'Durata',
        "news_photo" => 'Foto',
        "events_flyer" => 'Volantino',
        "events_title" => 'Titolo',
        "events_venue" => 'Luogo',
        "events_date" => 'Data',
        "events_duration" => 'Durata',
        "events_photo" => 'Foto',
        "news_description" => 'Descrizione',
        "events_description" => 'Descrizione',
        "sexes[1]" => 'Tipo',
    ],

];
