<?php

require_once 'core/init.php';
	echo 'Yesssss';
$user = Db::getInstance()->get('Admin',array('name','=','kevine'));
	//$user = Db::getInstance()->update('Admin',2,array(

	// 'password' => 'kef',
	// //'salt'     => 'salt',
	// 'name'     => 'okeyo'		
	// ));

if(!$user->count()){
	echo 'No user';
}else{

	echo $user->first()->name;
	//echo 'OK!';
	// foreach ($user->results() as $user) {
	// 	# code...
	// 	echo $user->name;
	// }
}