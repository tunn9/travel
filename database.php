<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	// 'hostname' => $_SERVER['RDS_HOSTNAME'],
	// 'database' => $_SERVER['RDS_DB_NAME'],
	// 'username' => $_SERVER['RDS_USERNAME'],
	// 'password' => $_SERVER['RDS_PASSWORD'],
	'hostname' => 'localhost',
	'database' => 'ubuk',
	'username' => 'root',
	'password' => '',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);