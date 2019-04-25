<?php 

	class Config{

		public static function get($path = null){

		if($path){

			// define the config path
			$config = $GLOBALS['config'];
			$path =explode('/', $path );

			//print_r($path);

			foreach ($path as $bit) {
				// check if mysql exist in the config
				if(isset($config[$bit])){

					// set config as a bit
					$config = $config[$bit];
				}
			}
			return $config;
		}

		return false;
	}
	}

 ?>