<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| https://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: pdo_functions_include.php
| Author: Yodix
| Co-Author: Joakim Falk (Domi)
| Integration to PHP-Fusion 7: Krelli (Systemweb)
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

// MySQL database functions
/**
 * Send a database query
 *
 * @param string $query SQL
 *
 * @param bool   $print
 *
 * @return \PDOStatement or FALSE on error
 * @global int   $mysql_queries_count
 * @global array $mysql_queries_time
 */

/*function dbquery($query, $print = FALSE) {
    global $mysql_queries_count, $mysql_queries_time;
    try {
        $mysql_queries_count++;
        $query_time = get_microtime();
        $result = dbconnection()->prepare($query);
        $result->execute();
        $query_time = substr((get_microtime() - $query_time), 0, 7);
        $mysql_queries_time[$mysql_queries_count] = [$query_time, $query];
        if ($print == 1)
            var_dump($query);
        return $result;
    } catch (PDOException $e) {
        trigger_error("Query Error: ".$query."<br/>Stack Trace: ".$e->getTraceAsString()."<br/>Error Nature: ".$e->getMessage(), E_USER_NOTICE);
        return NULL;
    }
}
 */
// MySQL database functions
/**
 * Send a database query
 * @global int   $mysql_queries_count
 * @global array $mysql_queries_time
 * @param string $query SQL
 * @ return \PDOStatement or FALSE on error . Wir können das return nicht setzen!
 */
function dbquery($query, $print = FALSE) {
	global $mysql_queries_count, $mysql_queries_time;
	try {
		$mysql_queries_count++;
        $query_time = get_microtime();
		$result = dbconnection()->prepare($query);
		$result->execute();
		$query_time = substr((get_microtime() - $query_time), 0, 7);
        $mysql_queries_time[$mysql_queries_count] = [$query_time, $query];
        db_last_statement($result);
		if ($print == 1) var_dump($query);
		return $result;
	} catch (PDOException $e) {
		trigger_error("Query Error: ".$query."\nError: ".$e->getMessage(), E_USER_WARNING);
		if ($print == 1) var_dump($query);
		echo $e;
		return FALSE;
	}
}

/**
 * Count the number of rows in a table filtered by conditions
 * @global int   $mysql_queries_count
 * @global array $mysql_queries_time
 * @param string $field      Parenthesized field name
 * @param string $table      Table name
 * @param string $conditions conditions after "where"
 * @return boolean
 */
function dbcount($field, $table, $conditions = "") {
	$cond = ($conditions ? " WHERE ".$conditions : "");
	$sql = "SELECT COUNT".$field." FROM ".$table.$cond;
	try {
		$statement = dbconnection()->prepare($sql);
		$statement->execute();
		return $statement->fetchColumn();
	} catch (PDOException $e) {
		trigger_error("Query Error: ".$sql."\nError: ".$e->getMessage(), E_USER_WARNING);
		echo $e;
		return FALSE;
	}
}

/**
 * Fetch the first column of a specific row
 * @param \PDOStatement $statement
 * @param int           $row
 * @return mixed
 */
function dbresult($statement, $row) {
	//seek
	for ($i = 0; $i < $row; $i++) {
		$statement->fetchColumn();
	}
	$result = $statement->fetchColumn();
	return $result;
}

/**
 * Count the number of affected rows by the given query
 * @param \PDOStatement $query
 * @return mixed  Auch hier kein return setzen!
 */
function dbrows(PDOStatement $query) {
	if (!($query instanceof PDOStatement)) {
		// ist auskommentiert wegen der Vielen Fehlerabfragen in PHP-Fusion
		//throw new InvalidArgumentException('dbrows expects a PDOStatement');
		return null;
	}
	return $query->rowCount();
}

/**
 * Fetch one row as an associative array
 * @param \PDOStatement $statement
 * @return array Associative array
 */
function dbarray($statement) {
	$statement->setFetchMode(PDO::FETCH_ASSOC);
	$result = $statement->fetch();
	return $result;
}

/**
 * Fetch one row as a numeric array
 * @param \PDOStatement $statement
 * @return array Numeric array
 */
function dbarraynum($statement) {
	$statement->setFetchMode(PDO::FETCH_NUM);
	$result = $statement->fetch();
	return $result;
}

/**
 * Connect to the database
 * @param string  $db_host
 * @param string  $db_user
 * @param string  $db_pass
 * @param string  $db_name
 * @  param boolean $halt_on_error If it is TRUE, the script will halt in case of error
 */
function dbconnect($db_host, $db_user, $db_pass, $db_name, $db_port = 3306) {
	$db_connect = TRUE;
	$db_select = TRUE;
	$halt_on_error = TRUE;
	try {
		$pdo = dbconnection(new PDO("mysql:host=".$db_host.";dbname=".$db_name.";charset=utf8;port=".$db_port, $db_user, $db_pass));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	} catch (PDOException $error) {
		$db_connect = $error->getCode() === 1049; //unknown database
		$db_select = FALSE;
		if ($halt_on_error and !$db_connect) {
			die("<strong>Unable to establish connection to MySQL</strong><br />".$error->getCode()." : ".$error->getMessage());
		} elseif ($halt_on_error) {
			die("<strong>Unable to select MySQL database</strong><br />".$error->getCode()." : ".$error->getMessage());
		}
	}
	return array('connection_success' => $db_connect,
		'dbselection_success' => $db_select);
}

/**
 * Get the last inserted auto increment id
 * @return int
 */
function db_lastid() {
	return (int)dbconnection()->lastInsertId();
}

/**
 * Get and set the \PDO instance
 * @static \PDO|null $_pdo
 * @param \PDO|null $pdo
 * @return \PDO|null
 */
function dbconnection(?\PDO $pdo = null) {
	static $_pdo = null;
	if (func_num_args() === 1) {
		$_pdo = $pdo;
	}
	return $_pdo;
}

function db_last_statement(?\PDOStatement $statement = null) {
    static $_last_statement = null;
    if (func_num_args() === 1) {
        $_last_statement = $statement;
    }
    return $_last_statement;
}

//wird bei PDO eigentlich nicht mehr benötigt. Ausser bei Multiseiten mit verschiedenen Datenbanken
function dbclose() {
    db_last_statement(null);
    dbconnection(null);
    return null;
}

function dbnew_result(string $res,string  $row, $field=0) {
    if ($res instanceof \PDOStatement) {
        $rows = $res->fetchAll(PDO::FETCH_BOTH);
        return isset($rows[$row][$field]) ? $rows[$row][$field] : null;
    }
    return null;
}

function db_affrows() {
    $statement = db_last_statement();
    return $statement instanceof \PDOStatement ? $statement->rowCount() : null;
}

// new added functions
function db_server_info() {
	return dbconnection()->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));
}

function db_fieldcount(PDOStatement $result) {
    return $result->columnCount();
}

function db_fetchfieldname(PDOStatement $result,mixed $field_offset) {
    $properties = $result->getColumnMeta($field_offset);
	return $properties['name'];
}

function db_fetch_row(PDOStatement $result) {
	return $result->fetch(PDO::FETCH_NUM);
}

function db_use_result(mixed $result){
	$query = dbconnection()->prepare($result);
    $query->execute();
    db_last_statement($query);
	return true;
}

function db_fetchrow(mixed $result){
    return $result->fetch(PDO::FETCH_NUM);
}

// added for compatibility to older mysql commands:
if(!function_exists("mysql_field_name")) {
	function mysql_field_name(mixed $result,mixed $field_offset) {
		return db_fetchfieldname($result, $field_offset);
	}
}
if(!function_exists("mysql_free_result")) {
	function mysql_free_result(mixed $result) {
		return $result->closeCursor();
	}
}
if(!function_exists("mysql_escape_string")) {
	function mysql_escape_string(mixed $query) {
		$pdo = dbconnection();
		if ($pdo) {
			$quoted = $pdo->quote($query);
			if ($quoted !== false) {
				return substr($quoted, 1, -1);
			}
		}
		return addslashes($query);
	}
}
if(!function_exists("mysql_real_escape_string")) {
	function mysql_real_escape_string(mixed $query) {
		$pdo = dbconnection();
		if ($pdo) {
			$quoted = $pdo->quote($query);
			if ($quoted !== false) {
				return substr($quoted, 1, -1);
			}
		}
		return addslashes($query);
	}
}
if(!function_exists("mysql_query")) {
	function mysql_query(mixed $query) {
		return dbquery($query);
	}
}
if(!function_exists("mysql_num_rows")) {
	function mysql_num_rows(mixed $result) {
		return dbrows($result);
	}
}
if(!function_exists("mysql_insert_id")) {
	function mysql_insert_id() {
		return db_lastid();
	}
}
if(!function_exists("mysql_connect")) {
	function mysql_connect(string $db_host,string $db_user,string $db_pass) {
    global $db_name;
        dbconnect($db_host, $db_user, $db_pass, $db_name, true);
	}
    function mysql_select_db(string $name) {
        return true;
    }
}
if(!function_exists("mysql_close")) {
	function mysql_close(string $dummy="") {
        dbclose();
        return true;
	}
}
if(!function_exists("mysql_affected_rows")) {
	function mysql_affected_rows(string $dummy="") {
        return db_affrows();
	}
}
if(!function_exists("mysql_field_name")) {
	function mysql_field_name(mixed $result,mixed $field_offset) {
		return db_fetchfieldname($result, $field_offset);
	}
}
