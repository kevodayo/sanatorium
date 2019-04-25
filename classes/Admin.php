<?php
class Admin{

	private $_db,
			$_data,
			$_sessionName,
			$_isLoggedIn;

	public function __construct($admin = null){
		$this->_db = Db::getInstance();

		$this->_sessionName = Config::get('session/session_name');
	}

	public function create($fields = array()){

		if(!$this->_db->insert('Admin',$fields)){
			throw new Exception("There was a problem creating an account.");
			echo 'inserted';
		}

	}
	public function find($admin = null){
		if ($admin) {
			# code...
			$field = (is_numeric($admin)) ? 'id' : 'name';
			$data = $this->_db->get('Admin',array($field ,'=',$admin));

			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	public function login($username = null,$password = null){

		$admin = $this->find($username);

		//print_r($this->_data);
		//return false if the user does not exists
		//echo $this->data()->password===Hash::make($password,$this->data()->salt);
		$this->_isLoggedIn = true;
		if($admin){
			if($this->data()->password===Hash::make($password,$this->data()->salt)){
				//echo 'ok';
				Session::put($this->_sessionName,$this->data()->id);
				return true;
			}else{
				echo 'false';
			}
		}
		return false;
	}

	private function data(){
		return $this->_data;
	}

	public function isLoggedIn(){

		return $this->_isLoggedIn = true;
	}
// 	public function first(){
//     $results = $this->_db->results();
//     return $results[0];
// }

}

?>