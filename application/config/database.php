<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
        'hostname' => 'db',
        'port'     => '3306',
        'username' => 'root',
	'password' => 'root',
	'dbdriver' => 'mysqli',
	'database' => 'siasfo2',
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


// db1 spc
$db['spc'] = array(
	'dsn'	=> '',
	'hostname' => '36.91.91.54',
	'username' => 'spcNewSiakad',
	'password' => '$newSi4kad19',
	'database' => 'spc',
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

$db['ulangtosiakad2'] = array(
	'dsn'	=> '',
	'hostname' => '36.66.41.91',
        'port'     => '3306',
        'username' => 'siakadBatam',
	'password' => 'Si@kAdB4TAm2020',
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

$db['daftarulang'] = array(
	'dsn'	=> '',
        #'hostname' => '36.66.41.91',
        #'port'     => '3306',
        #'username' => 'siakadBatam',
	#'password' => 'Si@kAdB4TAm2020',
	'hostname' => 'db',
	'port'	   => '',
	'username' => 'root',
	'password' => 'root',
	'database' => 'ulang',
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

// db2 siakad
$db['siakad'] = array(
	'dsn'	=> '',
	'hostname' => 'db',
	'username' => 'root',
	//'password' => 'Zuhri@$A',
	'password' => 'root',
	'database' => 'siasfo1',
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

// db3 wisuda
$db['wisuda'] = array(
	'dsn'	=> '',
	'hostname' => 'db',
	// 'username' => 'wisuda',
	'username' => 'root',
	// 'password' => 'w1sud4@unt4d16%',
	'password' => 'root',
	'database' => 'wisuda',
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

$db['sapta'] = array(
	'dsn'	=> '',
	// 'hostname' => 'sapta.untad.ac.id',
	'hostname' => 'db',
	'username' => 'root',
	'password' => 'root',
	// 'password' => 'unt4d@54pt417^^',
	'database' => 'sapta',
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

$db['kkn'] = array(
	'dsn'	=> '',
	'hostname' => 'db',
	'username' => 'root',
	'password' => 'root',
	'database' => 'kkn',
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

