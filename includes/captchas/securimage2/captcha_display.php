<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: captcha_display.php
| Author: Hans Kristian Flaatten
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
echo "<div class='clearfix p-l-15'>";
// Display Capthca
echo "<img id='captcha' src='".INCLUDES."captchas/securimage2/securimage_show.php' alt='".$locale['global_600']."' align='left' style='max-width: 90%'/>\n";
echo "<a href='".INCLUDES."captchas/securimage2/securimage_play.php'>";
echo "<img src='".INCLUDES."captchas/securimage2/images/audio_icon.gif' alt='' align='top' class='tbl-border' style='width: 20px; margin-bottom:1px' /></a><br />\n";
// Display New Capthca Button
echo "<a href='#' onclick=\"document.getElementById('captcha').src = '".INCLUDES."captchas/securimage2/securimage_show.php?sid=' + Math.random(); return false\">";
echo "<img src='".INCLUDES."captchas/securimage2/images/refresh.gif' alt='' align='bottom' class='tbl-border' style='width: 20px;' /></a>\n";
if (isset($this)) {
	$this->setRequiredJavaScript("captcha_code", $locale['u195']);
}
echo "</div>\n";
