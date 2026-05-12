<?php
/*
+--------------------------------------------------------+
| PHP-Fusion Content Management System                   |
| Copyright © 2002 - 2012 Nick Jones                     |
| http://www.php-fusion.co.uk/                           |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------+
| Birthdate User Field                                   |
| Copyright © 2012 PHP-Fusion.at Development Team        |
| http://www.php-fusion.at/                              |
| http://development.php-fusion.at/                      |
+--------------------------------------------------------+
| Filename: user_birthdate_include.php                   |
| Fileversion: 1.0                                       |
+--------------------------------------------------------+
*/
 
if (!defined("IN_FUSION")) {
   die("Access denied");
}
 
// Handle Display, viewed by all
if ($profile_method == "display") {
    if (isset($user_data['user_birthdate']) && $user_data['user_birthdate'] != "0000-00-00") {
      $user_birthdate = explode("-", $user_data['user_birthdate']);
      $months = explode("|", $locale['months']);
      // neue Berechnung:
      $today = date("Ymd");
      $birthday = $user_birthdate[0].$user_birthdate[1].$user_birthdate[2];
      $years = floor(($today - $birthday) / 10000);
 
      echo "<tr>\n";
      echo "<td class='tbl1'>".$locale['uf_birthdate']."</td>\n";
      echo "<td class='tbl1' align='right'>".number_format($user_birthdate[2]).". ".$months[number_format($user_birthdate[1])]." ".$user_birthdate[0]." (".$years." ".($years == 1 ? $locale['uf_birthdate_year'] : $locale['uf_birthdate_years']).")</td>\n";
      echo "</tr>\n";
   }
}
 
// Handle Input, only if admin or unregistered
elseif ($profile_method == "input") {
   if (isset($user_data['user_birthdate'])) {
      $user_birthdate = $user_data['user_birthdate'];
   } else {
      $user_birthdate = "0000-00-00";
   }
   $user_birthdate = explode("-", $user_birthdate);
   $months = explode("|", $locale['months']);
   echo "<tr>\n";
   echo "<td class='tbl".$this -> getErrorClass("user_birthdate")."'><label for='user_day'>".$locale['uf_birthdate'].$required."</label></td>\n";
   echo "<td class='tbl".$this -> getErrorClass("user_birthdate")."'>\n";
   echo "<select name='user_day' id='user_day' class='textbox'>\n";
   echo "<option value='00'".($user_birthdate[2] == "00" ? " selected='selected'" : "").">".$locale['uf_birthdate_day']."</option>\n";
   for ($j = 1; $j <= 31; $j++) {
      echo "<option value='".$j."'".($user_birthdate[2] == $j ? " selected='selected'" : "").">".$j."</option>\n";
   }
   echo "</select>\n";
   echo "<select name='user_month' id='user_month' class='textbox'>\n";
   echo "<option value='00'".($user_birthdate[1] == "00" ? " selected='selected'" : "").">".$locale['uf_birthdate_month']."</option>\n";
   for ($j = 1; $j <= 12; $j++) {
      echo "<option value='".$j."'".($user_birthdate[1] == $j ? " selected='selected'" : "").">".$months[$j]."</option>\n";
   }
   echo "</select>\n";
   echo "<select name='user_year' id='user_year' class='textbox'>\n";
   echo "<option value='00'".($user_birthdate[0] == "0000" ? " selected='selected'" : "").">".$locale['uf_birthdate_year']."</option>\n";
   for ($j = date("Y"); (date("Y") - 99) <= $j; $j--) {
      echo "<option value='".$j."'".($user_birthdate[0] == $j ? " selected='selected'" : "").">".$j."</option>\n";
   }
   echo "</select>\n";
    echo "</td>\n";
   echo "</tr>\n";
    if ($required) {
      $this -> setRequiredJavaScript("user_day",   $locale['uf_birthdate_error']);
      $this -> setRequiredJavaScript("user_month", $locale['uf_birthdate_error']);
      $this -> setRequiredJavaScript("user_year",  $locale['uf_birthdate_error']);
   }
}
 
// Handle Register and Update, Update only if admin or unregistered
elseif ($profile_method == "validate_insert"  || $profile_method == "validate_update") {
   $user_day = "00";
   $user_month = "00";
   $user_year = "0000";
   if (isset($_POST['user_day']) && isNum($_POST['user_day']) && $_POST['user_day'] != "00") {
      $user_day = $_POST['user_day'];
   }
   if (isset($_POST['user_month']) && isNum($_POST['user_month']) && $_POST['user_month'] != "00") {
      $user_month = $_POST['user_month'];
   }
   if (isset($_POST['user_year']) && isNum($_POST['user_year']) && $_POST['user_year'] != "0000") {
      $user_year = $_POST['user_year'];
   }
   if (($user_day != "00" && $user_month != "00" && $user_year != "0000") || $this -> _isNotRequired("user_birthdate")) {
      $this -> _setDBValue("user_birthdate", $user_year."-".str_pad($user_month, 2, "0", STR_PAD_LEFT)."-".str_pad($user_day, 2, "0", STR_PAD_LEFT));
   } else {
      $this -> _setError("user_birthdate", $locale['uf_birthdate_error'], TRUE);
   }
}
?>