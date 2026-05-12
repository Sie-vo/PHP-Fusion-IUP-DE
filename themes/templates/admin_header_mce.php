<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: admin_header.php
| Author: Nick Jones (Digitanium)
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

define("ADMIN_PANEL", true);

require_once INCLUDES."output_handling_include.php";
require_once INCLUDES."header_includes.php";
require_once THEME."theme.php";

if ($settings['maintenance'] == "1" && !iADMIN) { redirect(BASEDIR."maintenance.php"); }
if (iMEMBER) { $result = dbquery("UPDATE ".DB_USERS." SET user_lastvisit='".time()."', user_ip='".USER_IP."', user_ip_type='".USER_IP_TYPE."' WHERE user_id='".$userdata['user_id']."'"); }

echo "<!DOCTYPE html>\n";
echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='".$locale['xml_lang']."' lang='".$locale['xml_lang']."'>\n";
echo "<head>\n<title>".$settings['sitename']."</title>\n";
echo "<meta http-equiv='Content-Type' content='text/html; charset=".$locale['charset']."' />\n";
echo "<link rel='stylesheet' href='".THEME."styles.css' type='text/css' media='screen' />\n";
if (file_exists(IMAGES."favicon.ico")) { echo "<link rel='shortcut icon' href='".IMAGES."favicon.ico' type='image/x-icon' />\n"; }
if (function_exists("get_head_tags")) { echo get_head_tags(); }
echo "<script type='text/javascript' src='".INCLUDES."jquery/jquery.js'></script>\n";
echo "<script type='text/javascript' src='".INCLUDES."jscript.js'></script>\n";
echo "<script type='text/javascript' src='".INCLUDES."jquery/admin-msg.js'></script>\n";

// HINT: relative URLs for 'content_css' does not work if Fusion Root is in subfolder of a domain! That's why we do not use THEME constants in definitions for css files.
if ($settings['tinymce_enabled'] == 1) {
	echo "<style type='text/css'>.mceIframeContainer iframe{width:100%!important;background-color: #00000;}</style>\n";
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
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help importcss'
		],
		toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect removeformat',
		toolbar2: 'cut copy paste | bold underline italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
		toolbar3: 'link unlink anchor | hr | image media | forecolor backcolor charmap emoticons | codesample | code | preview fullpage | fullscreen',
		menubar: 'edit insert view format table',
		file_browser_callback: RoxyFileBrowser,
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

function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = '".BASEDIR."filemanager/index.php';
  if (roxyFileman.indexOf(\"?\") < 0) {     
    roxyFileman += \"?type=\" + type;   
  }
  else {
    roxyFileman += \"&type=\" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'File Manager',
     width: 850, 
     height: 550,
     resizable: \"yes\",
     plugins: \"media\",
     inline: \"yes\",
     close_previous: \"no\"  
  }, {     window: win,     input: field_name    });
  return false; 
}
</script>\n";
}

echo "</head>\n<body>\n";

require_once THEMES."templates/panels.php";

ob_start();
?>
