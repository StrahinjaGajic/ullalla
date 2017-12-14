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

function getSexes() {
    return ['male', 'female', 'transsexual'];
}

function getSexOrientations() {
    return ['heterosexual', 'bisexual', 'homosexual'];
}

function getAnswers() {
    return ['yes', 'no', 'occasionally'];
}

function getTypes() {
    return ['asian', 'black', 'european', 'latina', 'indian', 'arabian', 'mixed', 'other'];
}

function getFigures() {
    return ['athletic', 'chubby', 'normal', 'slim', 'other'];
}

function getBreastSizes() {
    return ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
}

function getEyeColors() {
    return ['black', 'brown', 'green', 'blue', 'gray', 'other'];
}

function getHairColors() {
    return ['black', 'brunette', 'blond', 'red', 'other'];
}

function getShaveOptions() {
    return ['shaved', 'partial', 'hairy'];
}

function getUnits() {
    return ['days', 'hours', 'minutes'];
}

function getPreferedOptions() {
    return [
        'sms_and_call' => 'SMS And Call',
        'sms_only' => 'SMS Only',
        'call_only' => 'Call Only',
    ];
}

function getIncallOptions() {
    return [
        'private_apartment' => 'Private Apartment',
        'hotel' => 'Hotel',
        'club_studio' => 'Club/Studio',
        'define_yourself' => 'Define Yourself',
    ];
}

function getOutcallOptions() {
    return [
        'home' => 'Home',
        'hotel' => 'Hotel',
        'home_and_hotel' => 'Home And Hotel',
        'define_yourself' => 'Define Yourself',
    ];
}

function getCurrencies() {
    return ['chf', 'eur', 'usd'];
}

function getPriceTypes() {
    return ['outcall', 'incall'];
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
        'de' => 'German',
        'fr' => 'French',
        'it' => 'Italian',
        'en' => 'English',
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
    return ['Monday', 'Thuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
}

function getWorkingTime($days, $available_24_7, $timeFrom, $timeFromM, $timeTo, $timeToM, $showAsNightEscort = null, $nightEscorts = null) {
    $workingTime = null;
    // girl availability and working hours
    if ($available_24_7) {
        $workingTime = 'Available 24/7';
        if ($showAsNightEscort) {
            $workingTime .= '&' . 'Night Escort';
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
        'age' => 'Age',
        'type' => 'Type',
        'country_id' => 'Nationality',
        'eye_color' => 'Eyes',
        'hair_color' => 'Hair',
        'height' => 'Height',
        'weight' => 'Weight',
        'breast_size' => 'Breast Size',
        'intimate' => 'Intimate',
        'smoker' => 'Smoker',
        'alcohol' => 'Alcohol',
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
            if ($field == 'Nationality') {
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
        'email' => 'Email',
        'phone' => 'Phone',
        'mobile' => 'Mobile Phone',
        'website' => 'Website',
        'contact_options' => ['Available Apps' => 'contact_option_name'],
        'skype_name' => 'Skype Name',
        'prefered_contact_option' => 'I Prefer',
        'no_withheld_numbers' => 'Withheld Numbers',
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
                        $html .= $value == 0 ? 'Yes' : 'No';
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
        'club_name' => 'Club',
        'city' => 'City',
        'address' => 'Address',
        'incall_type' => 'Incall',
        'outcall_type' => 'Outcall',
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
            foreach ($services as $service) {
                $html .= '<td>
				<i class="fa fa-check"></i>'
                    . $service->service_name .
                    '</td>';
            }
            $html .= '</tr>';
            echo $html;
        });
    }
}

function getshowNumbers() {
    return ['9', '12', '24', '36'];
}

function getOrderBy() {
    return [
        'nickname_asc' => 'Nickname',
        'created_at_desc' => 'Newest',
        'created_at_asc' => 'Oldest',
        'service_price_asc' => 'Price Ascending',
        'service_price_desc' => 'Price Descending',
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
        'bio' => 'Bio',
        'about_me' => 'About Me',
        'languages' => 'Languages',
        'gallery' => 'Gallery',
        'contact' => 'Contact',
        'services' => 'Services',
        'workplace' => 'Workplace',
        'working_time' => 'Working Time',
        'prices' => 'Prices',
        'packages' => 'Packages',
        'banners' => 'Banners'
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

function getPackageExpiryDate($days) {
    return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "+" . $days . " days"));
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
        'username_asc' => 'Username',
        'created_at_desc' => 'Newest',
        'created_at_asc' => 'Oldest',
    ];
}

function getEditLocalProfilePages() {
    return [
        'contact' => 'Contact',
        'gallery' => 'Gallery',
        'working_time' => 'Working Time',
        'about_me' => 'About me',
        'club_info' => 'Club Info',
        'girls' => 'Girls',
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
            return "N / A";
        } elseif ($data->value == 2) {
            if ($data->free == 1) {
                return "Yes (Free)";
            } elseif ($data->free == 2) {
                return "Yes (With cost)";
            } else {
                return "Yes";
            }
        } elseif ($data->value == 3) {
            return "No";
        }
    } else {
        if ($data->free == 1) {
            return "Free";
        } elseif ($data->free == 2) {
            return "With cost";
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

?>
