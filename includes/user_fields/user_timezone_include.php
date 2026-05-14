<?php
/*-------------------------------------------------------+
| PHPFusion Content Management System
| Copyright (C) PHP Fusion Inc
| https://phpfusion.com/
+--------------------------------------------------------+
| Filename: user_timezone_include.php
| Author: Core Development Team
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
/** @var array $locale
 *  @var array $user_data
 *  @var array $settings
 *  @var string $required
*/
defined('IN_FUSION') || exit;

// Display user field input
if ($profile_method == "input") {
    $user_timezone = isset($user_data['user_timezone']) ? $user_data['user_timezone'] : $settings['default_timezone'];
    /*$json_file = @file_get_contents(INCLUDES.'geomap/timezones.json', FALSE);
    $timezones_json = json_decode($json_file, TRUE);
    $timezone_array = [];
    $timezone_options = "";
    
    
    foreach ($timezones_json as $zone => $zone_city) {
        $date = new DateTime('now', new DateTimeZone($zone));
        $offset = $date->getOffset() / 3600;
        $timezone_array[$zone] = '(GMT'.($offset < 0 ? $offset : '+'.$offset).') '.$zone_city;
        $timezone_options .= "<option value='".$zone."'".($user_timezone == $zone ? " selected='selected'" : "").">".$timezone_array[$zone]."</option>\n";
    }
    echo "<tr>\n";
	echo "<td class='tbl".$this->getErrorClass("user_timezone")."'><label for='user_timezone_input'>".$locale['uf_timezone'].$required."</label></td>\n";
	echo "<td class='tbl".$this->getErrorClass("user_timezone")."'><select id='user_timezone_input' name='user_timezone' class='textbox' style='width:200px;'>\n";
    echo $timezone_options;
    echo "</select></td>\n";
	echo "</tr>\n";*/

    $timezones = timezone_abbreviations_list();
    $timezoneArray = [];
    foreach ($timezones as $zones) {
        foreach ($zones as $zone) {
            if (!empty($zone['timezone_id']) && preg_match('/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'])) {
                if (!in_array($zone['timezone_id'], $timezoneArray)) {
                    $timezoneArray[] = $zone['timezone_id'];
                }
            }
        }
    }

    unset($dummy); unset($timezones);
    sort($timezoneArray);

    $timezoneOptions = "";
    foreach ($timezoneArray AS $timezone) {
	    $timezoneOptions .= "<option ".($user_timezone == $timezone ? "selected='selected'" : "").">".$timezone."</option>\n";
    }

    echo "<tr>\n";
	echo "<td class='tbl".$this->getErrorClass("user_timezone")."'><label for='user_timezone_input'>".$locale['uf_timezone'].$required."</label></td>\n";
	echo "<td class='tbl".$this->getErrorClass("user_timezone")."'><select id='user_timezone_input' name='user_timezone' class='textbox' style='width:200px;'>\n";
    echo $timezoneOptions;
    echo "</select></td>\n";
	echo "</tr>\n";
    

}
// Display in profile
elseif ($profile_method == "display") {
	if ($user_data['user_timezone']) {
		echo "<tr>\n";
		echo "<td class='tbl1'>".$locale['uf_timezone']."</td>\n";
		echo "<td align='right' class='tbl1'>".$user_data['user_timezone']."</td>\n";
		echo "</tr>\n";
	}
}
// Insert and update
elseif ($profile_method == "validate_insert"  || $profile_method == "validate_update") {
	// Get input data
	if (isset($_POST['user_timezone']) && ($_POST['user_timezone'] != "" || $this->_isNotRequired("user_timezone"))) {
		// Set update or insert user data
		$this->_setDBValue("user_timezone", stripinput(trim($_POST['user_timezone'])));
	} else {
		$this->_setError("user_timezone", $locale['uf_timezone_error'], true);	
	}
}
