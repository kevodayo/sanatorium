<?php  

	session_start(); //allow users to log in

// set up a conection between php files and mysql database
	// use 127.0.0.1 instead of localhost to reduce the processing time
	// set cookie and session names
	$GLOBALS['config'] = array('mysql' => array('host' => '127.0.0.1','username' => 'root','password' => '','db' =>'sanatorium'),
		'remember' => array('cookie_name'=>'hash', 'cookie_expiry'=>60987),
		'session' => array('session_name'=>'user','token_name'=>'token'));
// use autoloader to load classes quickly and efficiently
	spl_autoload_register(function($class){
		require_once 'classes/'. $class .'.php';

	});

	require_once 'functions/sanitize.php';

?>