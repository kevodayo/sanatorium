<?php 
class Input{

//by default the type should be post
	public static function exists($type = 'post'){
		switch ($type) {
			case 'post':
				# code...
				return (!empty($_POST)) ? true : false;
				break;

			case 'get':
				# code...
				return (!empty($_GET)) ? true : false;
				break;
			
			default:
				# code...
				return false;
				break;
		}

	}
	public static function get($item){

		if(isset($_POST[$item])){
			return $_POST[$item];
		}else if (isset($_GET[$item])) {
			# code...
			return $_GET[$item];
		}
		return '';
	}
}

 ?>