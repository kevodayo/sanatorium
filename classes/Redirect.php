<?php  

class Redirect{

	public static function to($location,$permanent = false){

		// if($location){
			header('location :'.$location,true,$permanent ? 301 : 302);
			 exit();
		// }
	}
}
?>