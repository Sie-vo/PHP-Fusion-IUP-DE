<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: header_mce.php
| Author: Nick Jones (Digitanium)
| Co-Author: Daywalker
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

require_once INCLUDES."output_handling_include.php";
require_once INCLUDES."header_includes.php";
require_once THEME."theme.php";
require_once THEMES."templates/render_functions.php";

if ($settings['maintenance'] == "1" && ((iMEMBER && $settings['maintenance_level'] == "1" 
	&& $userdata['user_id'] != "1") || ($settings['maintenance_level'] > $userdata['user_level'])
)) { 
	redirect(BASEDIR."maintenance.php");
 }
if (iMEMBER) { 
	$result = dbquery(
		"UPDATE ".DB_USERS." SET user_lastvisit='".time()."', user_ip='".USER_IP."', user_ip_type='".USER_IP_TYPE."'
		WHERE user_id='".$userdata['user_id']."'"
	); 
}

echo "<!DOCTYPE html>\n";
echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='".$locale['xml_lang']."' lang='".$locale['xml_lang']."'>\n";
echo "<head>\n<title>".$settings['sitename']."</title>\n";
echo "<meta http-equiv='Content-Type' content='text/html; charset=".$locale['charset']."' />\n";
echo "<meta name='description' content='".$settings['description']."' />\n";
echo "<meta name='keywords' content='".$settings['keywords']."' />\n";
echo "<link rel='stylesheet' href='".THEME."styles.css' type='text/css' media='screen' />\n";
if (file_exists(IMAGES."favicon.ico")) { echo "<link rel='shortcut icon' href='".IMAGES."favicon.ico' type='image/x-icon' />\n"; }
if (function_exists("get_head_tags")) { echo get_head_tags(); }
echo "<script type='text/javascript' src='".INCLUDES."jquery/jquery.js'></script>\n";
echo "<script type='text/javascript' src='".INCLUDES."jscript.js'></script>\n";
if ($settings['tinymce_enabled'] == 1) {
	echo "<style type='text/css'>.mceIframeContainer iframe{width:100%!important;}</style>\n";
	echo "<script language='javascript' type='text/javascript' src='".INCLUDES."jscripts/tiny_mce/tinymce.min.js'></script>\n
<script type='text/javascript'>
function advanced() {
	tinymce.init({
		selector: 'textarea',
		resize: 'both',
		height: 300,
		theme: 'modern',
		branding: false,
		language:'".$locale['tinymce']."',
		plugins: [
			'advlist autolink lists link image charmap print hr anchor pagebreak',
			'searchreplace visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'paste textcolor colorpicker textpattern imagetools importcss'
		],
		importcss_append: false,
		toolbar1: 'undo redo | insert | styleselect | link image media | forecolor backcolor | fullscreen',
		toolbar2: 'bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
		menubar: 'edit insert view format table tools',
		image_advtab: true,
		relative_urls : false,
		remove_script_host : false,
		document_base_url : '".$settings['siteurl']."',
		content_css: [
			'".(file_exists(THEME."editor.css") ? 
                $settings['siteurl']."themes/".$settings['theme']."/editor.css":
                $settings['siteurl']."themes/".$settings['theme']."/styles.css"
               )."',
		],
		content_style: 'body.mceDefBody {background:#".(IsSet($settings['tinymce_bgcolor']) ? $settings['tinymce_bgcolor'] : "FFFFFF").";}',
		body_class: 'mceDefBody'
	});
}

function simple() {
	tinymce.init({
		selector: 'textarea',
		height: 200,
		menubar: false,
		branding: false,
		plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code'
		],
		toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		content_css: [
			'".(file_exists(THEME."editor.css") ? 
                $settings['siteurl']."themes/".$settings['theme']."/editor.css":
                $settings['siteurl']."themes/".$settings['theme']."/styles.css"
               )."',
		],
		content_style: 'body.mceDefBody {background:#".(IsSet($settings['tinymce_bgcolor']) ? $settings['tinymce_bgcolor'] : "FFFFFF").";}',
		body_class: 'mceDefBody'
	});
}

function toggleEditor(id) {
	if (!tinyMCE.get(id))
		tinyMCE.execCommand('mceAddControl', false, id);
	else
		tinyMCE.execCommand('mceRemoveControl', false, id);
}
</script>\n";
}
echo "</head>\n<body>\n";

require_once THEMES."templates/panels.php";
ob_start();
