<?php
function getDataAndCutLastCharacter($results, $attribute) {
    $resultArr = array();
    if ($results) {
        foreach ($results as $result) {
            $resultArr[] = $result->$attribute;
        }
    }
    return implode(', ', array_map('ucfirst', $resultArr));
}

// upload care store files
function storeAndGetUploadCareFiles($file, $dbObject = null) {
    $imageFile = null;
    // $api = new Uploadcare\Api(config('uploadcare.public_key'), config('uploadcare.private_key'));
    if ($file) {
        if (strpos($file, '~') !== false) {
            // is multiple
            $group = app()->uploadcare->getGroup($file);
            $group->store();
            $imageFile = $group->getUrl();
        } else {
            // is single
            $file = app()->uploadcare->getFile($file);
            $file->store();
            $imageFile = $file->getUrl();
        }
    }
    return $imageFile;
}

function sendPlivoMessage($src, $dst, $text) {
    $params = array(
        'src' => $src,
        'dst' => $dst,
        'text' => $text
    );
    // dd($params);
    return \Plivo::sendSMS($params);
}

function getSexes() {
    return [__('functions.male'), __('functions.female'), __('functions.transsexual')];
}

function getSexOrientations() {
    return [__('functions.heterosexual'), __('functions.bisexual'), __('functions.homosexual')];
}

function getAnswers() {
    return [__('functions.yes'), __('functions.no'), __('functions.occasionally')];
}

function getTypes() {
    return [__('functions.asian'), __('functions.black'), __('functions.european'), __('functions.latina'), __('functions.indian'), __('functions.arabian'), __('functions.mixed'), __('functions.other')];
}

function getFigures() {
    return [__('functions.athletic'), __('functions.chubby'), __('functions.normal'), __('functions.slim'), __('functions.other')];
}

function getBreastSizes() {
    return [__('functions.a'), __('functions.b'), __('functions.c'), __('functions.d'), __('functions.e'), __('functions.f'), __('functions.g')];
}

function getEyeColors() {
    return [__('functions.black'), __('functions.brown'), __('functions.green'), __('functions.blue'), __('functions.gray'), __('functions.other')];
}

function getHairColors() {
    return [__('functions.black'), __('functions.brunette'), __('functions.blond'), __('functions.red'), __('functions.other')];
}

function getShaveOptions() {
    return [__('functions.shaved'), __('functions.partial'), __('functions.hairy')];
}

function getUnits() {
    return [__('functions.days'), __('functions.hours'), __('functions.minutes')];
}

function getPreferedOptions() {
    return [
        'sms_and_call' => __('functions.sms_and_call'),
        'sms_only' => __('functions.sms_only'),
        'call_only' => __('functions.call_only'),
    ];
}

function getIncallOptions() {
    return [
        'private_apartment' => __('functions.private_apartment'),
        'hotel' => __('functions.hotel'),
        'club_studio' => __('functions.club_studio'),
        'define_yourself' => __('functions.define_yourself'),
    ];
}

function getOutcallOptions() {
    return [
        'home' => __('functions.home'),
        'hotel' => __('functions.hotel'),
        'home_and_hotel' => __('functions.home_and_hotel'),
        'define_yourself' => __('functions.define_yourself'),
    ];
}

function getCurrencies() {
    return [__('functions.chf'), __('functions.eur'), __('functions.usd')];
}

function getPriceTypes() {
    return [__('functions.outcall'), __('functions.incall')];
}

function getFilterYears() {
    return [
        '18' => '25',
        '26' => '35',
        '36' => '60',
    ];
}

function getLanguages() {
    return [
        'de' => __('functions.de'),
        'fr' => __('functions.fr'),
        'it' => __('functions.it'),
        'en' => __('functions.en'),
    ];
}

function getQuickSearchTypes() {
    return [
        'venus' => __('functions.girl'),
        'transgender' => __('functions.trans'),
        'home' => __('functions.local'),
    ];
}

function makeStringFromFilterYears($startAge, $endAge) {
    return $startAge . '-' . $endAge;
}

function getHoursList() {
    $hours = [];
    for($i=0; $i<24; $i++){
        array_push($hours, sprintf("%02d", $i));
    }
    return $hours;
}

function getMinutesList() {
    $minutes = [];
    for($i=0; $i<60; $i++){
        array_push($minutes, sprintf("%02d",$i));
    }
    return $minutes;
}


function getDaysOfTheWeek() {
    return [__('functions.monday'), __('functions.tuesday'), __('functions.wednesday'), __('functions.thursday'), __('functions.friday'), __('functions.saturday'), __('functions.sunday')];
}

function getWorkingTime($days, $available_24_7, $timeFrom, $timeFromM, $timeTo, $timeToM, $showAsNightEscort = null, $nightEscorts = null) {
    $workingTime = null;
    // girl availability and working hours
    if ($available_24_7) {
        $workingTime = __('fields.available_24_7');
        if ($showAsNightEscort) {
            $workingTime .= '&' . __('fields.night_escort');
        }
    } elseif ($days) {
        // loop through each day and put in array day of the week delimited (|) with time from and time to
        foreach ($days as $key => $value) {
            if ($value) {
                $string = $value . '|' . $timeFrom[$key] . ':' . $timeFromM[$key] . ' - ' . $timeTo[$key] . ':' . $timeToM[$key];
                if (isset($nightEscorts[$key])) {
                    $string .= '&' . $nightEscorts[$key];
                    $workingTime[] = $string;
                } else {
                    $workingTime[] = $string;
                }
            }
        }
    }

    if (!$available_24_7 && $workingTime) {
        $workingTime = array_map('utf8_encode', $workingTime);
        $workingTime = json_encode($workingTime);
    }

    return $workingTime;
}

function getBioFields() {
    return [
        'age' => __('functions.age'),
        'type' => __('functions.type'),
        'country_id' => __('functions.country_id'),
        'eye_color' => __('functions.eye_color'),
        'hair_color' => __('functions.hair_color'),
        'height' => __('functions.height'),
        'weight' => __('functions.weight'),
        'breast_size' => __('functions.breast_size'),
        'intimate' => __('functions.intimate'),
        'smoker' => __('functions.smoker'),
        'alcohol' => __('functions.alcohol'),
    ];
}

function parseSingleUserData($fields, $user) {
    $html = '';
    foreach ($fields as $key => $field) {
        $value = $user->$key;
        if ($value) {
            $html .= '<tr>
            <td>' . $field . ':</td>
            <td>';
            if ($field == __('fields.nationality')) {
                $html .= \App\Models\Country::where('id', $value)->value('citizenship');
            } else {
                $html .= ucfirst($value);
            }
            $html .= '</td>
            </tr>';
        }
    }

    echo $html;
}

function getContactFields() {
    return [
        // 'email' => __('functions.email'),
        'phone' => __('functions.phone'),
        'mobile' => __('functions.mobile'),
        'website' => __('functions.website'),
        'contact_options' => [__('headings.available_apps') => 'contact_option_name'],
        'skype_name' => __('functions.skype_name'),
        'prefered_contact_option' => __('functions.prefered_contact_option'),
        'no_withheld_numbers' => __('functions.no_withheld_numbers'),
    ];
}

function parseSingleContactData($fields, $user) {
    $html = '';
    foreach ($fields as $key => $field) {
        $value = $user->$key;
        if ($value) {
            if (is_array($field) && $value->count()) {
                $keyInsideOfArray = key($field);
                $html .= '<tr>
                <td>' . $keyInsideOfArray . ':</td>
                <td>';
                $html .= getDataAndCutLastCharacter($value, $field[$keyInsideOfArray]);
                $html .= '</td></tr>';
            } else {
                $html .= '<tr>
                <td>' . $field . ':</td>
                <td>';
                if (array_key_exists($value, getPreferedOptions())) {
                    $html .= getPreferedOptions()[$value];
                } else {
                    if ($key == 'no_withheld_numbers') {
                        $html .= $value == 0 ? __('labels.yes') : __('labels.no');
                    } else {
                        $html .= $value;
                    }
                }
                $html .= '</td></tr>';
            }
        }
    }

    echo $html;
}

function getWorkplaceFields() {
    return [
        'club_name' => __('functions.club_name'),
        'city' => __('functions.city'),
        'address' => __('functions.address'),
        'incall_type' => __('functions.incall_type'),
        'outcall_type' => __('functions.outcall_type'),
    ];
}

function parseWorkplaceDate($fields, $user) {
    $html = '';
    foreach ($fields as $key => $field) {
        if ($user->$key) {
            $html .= '<tr>
            <td>' . $field . ':</td>
            <td>';
            $value = $user->$key;
            $explodedValue = explode('|', $value);
            if (isset($explodedValue[1])) {
                $html .= $explodedValue[1];
            } else {
                $html .= $value;
            }
            $html .= '</td></tr>';
        }
    }
    echo $html;
}

function parseChunkedServices($user) {
    if ($user->services()->count()) {
        $user->services()->chunk(5, function ($services) {
            $html = '';
            $html .= '<tr>';
            $var = 'service_name_'. config()->get('app.locale');
            foreach ($services as $service) {
                $html .= '<td>
                <i class="fa fa-check"></i>'
                . $service->$var .
                '</td>';
            }
            $html .= '</tr>';
            echo $html;
        });
    }
}

function getshowNumbers() {
    return ['12', '24', '36'];
}

function getOrderBy() {
    return [
        'nickname_asc' => __('functions.nickname_asc'),
        'created_at_desc' => __('functions.created_at_desc'),
        'created_at_asc' => __('functions.created_at_asc'),
        'service_price_asc' => __('functions.service_price_asc'),
        'service_price_desc' => __('functions.service_price_desc'),
    ];
}

function getOrderByParameter($str) {
    if (strpos($str, 'asc') !== false) {
        return 'asc';
    }

    return 'desc';
}

function getAfterLastChar($str, $char) {
    return substr($str, strrpos($str, $char) + 1);
}

function getBeforeLastChar($str, $char) {
    return substr($str, 0, strrpos( $str, $char));
}

function getUrlWithFilters($input, $query, $i, $inputName, $obj) {
    $value = is_object($obj) ? $obj->id : $obj;
    if ($input) {
        if (!in_array($value, $input)) {
            $ids[$i] = $value;
        } else {
            $ids = null;
            if (($key = array_search($value, $input)) !== false) {
                unset($query[$inputName][$key]);
            }
        }
    } else {
        $ids[$i] = $value;
    }

    return array_merge($query, [$inputName . '[' . $i . ']' => $ids[$i]]);

}

function getEditProfilePages() {
    return [
        'bio' => __('functions.bio'),
        'about_me' => __('functions.about_me'),
        'languages' => __('functions.languages'),
        'gallery' => __('functions.gallery'),
        'contact' => __('functions.contact'),
        'services' => __('functions.services'),
        'workplace' => __('functions.workplace'),
        'working_time' => __('functions.working_time'),
        'prices' => __('functions.prices'),
        'packages' => __('functions.packages'),
        'banners' => __('functions.banners')
    ];
}

function parseEditProfileMenu($currentPage) {
    $html = '';
    foreach (getEditProfilePages() as $href => $pageTitle) {
        $path = url('@' . Auth::user()->username . '/' . $href);
        $active = $href == $currentPage ? 'active' : '';
        $html .= '<a href=' . $path . ' class=' . $active . '>' . $pageTitle . '</a>';
    }
    return $html;
}

function getSelectedOption($dbOption, $option) {
    return $dbOption == $option ? 'selected' : '';
}

function checkIfItemExists($itemsArray, $item) {
    return in_array($item, $itemsArray) ? $item : null;
}

function arrayHasString($array, $string) {
    foreach ($array as $key => $value) {
        if (stripos($value, $string) !== false) {
            $values = $value;
            break;
        } else {
            $values = '|:-';
        }
    }
    return $values;
}

function stringHasString($needle, $haystack) {
    if (!is_array($haystack)) {
        if (stripos($haystack, $needle) !== false) {
            return true;
        }
    }

    return false;
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function getDaysForExpiry($package_id) {
    $days = [];
    if ($package_id == 1) {
        $days = [
            '2'
        ];
    } else if ($package_id == 2) {
        $days = [
            '4',
            '2',
        ];
    } elseif ($package_id == 3 || $package_id == 4) {
        $days = [
            '7',
            '4',
            '2',
        ];
    } elseif ($package_id == 5) {
        $days = [
            '15',
            '7',
            '4',
            '2',
        ];
    } elseif ($package_id == 6) {
        $days = [
            '30',
            '15',
            '7',
            '4',
            '2',
        ];
    }

    return $days;
}

function getDaysForExpiryLocal($package_duration) {
    $days = [];
    if ($package_duration == 'month') {
        $days = [
            '7',
            '4',
            '2',
        ];
    } else if ($package_duration == 'year') {
        $days = [
            '30',
            '15',
            '7',
            '4',
            '2',
        ];
    }

    return $days;
}

function getPackageExpiryDate($days) {
    return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "+" . $days . " " . __('functions.days')));
}

function daysToAddToExpiry($package_id) {
    $days = '';
    if ($package_id == 1) {
        $days = '7';
    } else if ($package_id == 2) {
        $days = '14';
    } elseif ($package_id == 3) {
        $days = '30';
    } elseif ($package_id == 4) {
        $days = '90';
    } elseif ($package_id == 5) {
        $days = '180';
    } elseif ($package_id == 6) {
        $days = '360';
    }

    return $days;
}

function array_search_reverse($key, $array){
    if (isset($array[$key])) {
        return $array[$key];
    }
    return null;
}

# LOCAL FUNCTIONS
function getLoclasOrderBy() {
    return [
        'username_asc' => __('functions.username_asc'),
        'created_at_desc' => __('functions.created_at_desc'),
        'created_at_asc' => __('functions.created_at_asc'),
    ];
}

function getEditLocalProfilePages() {
    return [
        'contact' => __('functions.contact'),
        'gallery' => __('functions.gallery'),
        'working_time' => __('functions.working_time'),
        'about_me' => __('functions.about_me'),
        'club_info' => __('functions.club_info'),
        'girls' => __('functions.girls'),
        'packages' => __('functions.packages'),
    ];
}

function parseEditLocalProfileMenu($currentPage) {
    $html = '';
    foreach (getEditLocalProfilePages() as $href => $pageTitle) {
        $path = url('locals/@' . Auth::guard('local')->user()->username . '/' . $href);
        $active = $href == $currentPage ? 'active' : '';
        $html .= '<a href=' . $path . ' class=' . $active . '>' . $pageTitle . '</a>';
    }
    return $html;
}

function setClubInfo($name, $data, $data_free) {
    if (isset($data)) {
        $value = $data;
        if ($data == 2) {
            if (isset($data_free)) {
                $free = $data_free;
            } else {
                $free = 0;
            }
        } else {
            $free = 1;
        }
    } else {
        $value = 0;
        if (isset($data_free)) {
            $free = $data_free;
        } else {
            $free = 0;
        }
    }
    $club = new App\Models\ClubInfo;
    $club->name = $name;
    $club->value = $value;
    $club->free = $free;
    $club->save();
    return $club->id;
}

function getClubInfo($data) {
    if ($data->value != 0) {
        if ($data->value == 1) {
            return __('labels.n_a');
        } elseif ($data->value == 2) {
            if ($data->free == 1) {
                return __('functions.yes_free');
            } elseif ($data->free == 2) {
                return __('functions.yes_with_cost');
            } else {
                return __('labels.yes');
            }
        } elseif ($data->value == 3) {
            return __('labels.no');
        }
    } else {
        if ($data->free == 1) {
            return __('labels.free');
        } elseif ($data->free == 2) {
            return __('labels.with_cost');
        }
    }
}

function editClubInfo($id, $data, $data_free) {
    if (isset($data)) {
        $value = $data;
        if ($data == 2) {
            if (isset($data_free)) {
                $free = $data_free;
            } else {
                $free = 0;
            }
        } else {
            $free = 1;
        }
    } else {
        $value = 0;
        if (isset($data_free)) {
            $free = $data_free;
        } else {
            $free = 0;
        }
    }
    $club = App\Models\ClubInfo::find($id);
    $club->value = $value;
    $club->free = $free;
    $club->save();
    return $club->id;
}

function getNavUris() {
    return ['/', 'signin', 'signup'];
}

?>
