<?php
 
/*
+--------------------------------------------------------+
| PHP-Fusion Content Management System                   |
| Copyright � 2002 - 2012 Nick Jones                     |
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
| Copyright � 2012 PHP-Fusion.at Development Team        |
| http://www.php-fusion.at/                              |
| http://development.php-fusion.at/                      |
+--------------------------------------------------------+
| Filename: user_birthdate_include_var.php               |
| Fileversion: 1.0                                       |
+--------------------------------------------------------+
*/
 
if (!defined("IN_FUSION")) {
   die("Access Diened");
}
 
$user_field_api_version = "1.01.00";
$user_field_name  = $locale['uf_birthdate'];
$user_field_desc = $locale['uf_birthdate_desc'];
$user_field_dbname = "user_birthdate";
$user_field_group = 2;
$user_field_dbinfo = "VARCHAR(10) NOT NULL DEFAULT '0000-00-00'";
 
?>