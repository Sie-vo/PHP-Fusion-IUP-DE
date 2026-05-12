<?php
require_once __DIR__.'../../../../maincore.php';
require_once __DIR__.'../../../../config.php';

return [
    'session_name'           => COOKIE_PREFIX.'session',
    'wordlist_file_encoding' => 'UTF-8',
	'code_length' => 5,
	'num_lines' => 10,
	'noise_level' => 5
];
