<?php
class Hash{

	//make a hash
	//salt improves the security of password hash
	public static function make($string,$salt = ''){
		return hash('sha256', $string . $salt);
	}
	public static function salt($length){

		return openssl_random_pseudo_bytes($length);

	}

	//unique salt
	public static function unique(){

		return self::make(uniqid());

	}
}