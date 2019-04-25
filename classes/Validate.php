<?php

class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = Db::getInstance();
	}
	public function check($source,$items = array()){

		foreach ($items as $item => $rules) {
			# code...
			foreach ($rules as $rule => $rule_value) {
				# code...
				//echo "{$item} {$rule} must be {$rule_value}<br>";
				$value = trim($source[$item]);
				$item = escape($item);
				//echo $value; 
				//check if the data exists in the database
				if ($rule === 'required' && empty($value)) {
					# code...
					$this-> addError("{$item} is required");
				}else if(!empty($value)){

					switch ($rule) {
						case 'min':
							# code...
							if (strlen($value) < $rule_value) {
								# code...
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
							break;
						case 'max':
							# code...
							if (strlen($value) > $rule_value) {
								# code...
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
							break;
						case 'matches':
							# code...
							if ($value != $source[$rule_value]) {
								# code...
								$this->addError("{$rule_value} must match {$item}");
							}
							break;
						case 'unique':
							# code...
							$check = $this->_db->get($rule_value,array($item,'=' ,$value));
							if($check->count()){
								$this->addError("{$item} already exist");
							}
							break;
						
						default:
							# code...
							break;
					}

				}
			}
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;

	}
	private function addError($error){
		$this->_errors[] = $error;
	}
	public function errors(){
		return $this->_errors;
	}
	public function passed(){
		return $this->_passed;
	}
}