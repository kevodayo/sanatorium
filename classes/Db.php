<!-- build a database wrapper in this class 

we use php database object to build this class(PDO)-->
<?php

class Db{

	//we use the singleton pattern here to prevent frequent connection of the database class
	private static $_instance = null; //used to store instance of the database if its available
	private $_pdo,//stores the pdo object when instanciated
			$_error = false, //shows whether the query failed or not
			$_query,//last query that is executed
			$_results, //stores the resultset
			$_count = 0;

// create a constructor function to connect to the database

	private function __construct(){

		try{

			//set the pdo property to pdo connection
			$this -> _pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
				//echo 'success';

		}catch(PDOException $e){
			die($e->getMessage());
		}

	}
	//create an instance method 
	public static function getInstance(){

		//check if the instance is set else set it
			if(!isset(self::$_instance)){
				self::$_instance = new Db();
			}
			return self::$_instance;
	}
	// the function takes two parameters, query string and array of parameters we would like to include
		public function query($sql,$params = array()){

			//reset the error back to false to allow us perform multiple queries one after the other
			$this ->error = false;
			//check if the query has been prepared properly
			// if the query is successful then you bind the parameters
			if($this->_query = $this->_pdo->prepare($sql)){
				//echo 'success';
				//if the prepared query is a success ,check if the parameters exists
				 $x = 1;
				if(count($params)){
					foreach ($params as $param) {
						# code...
						$this->_query->bindValue($x,$param);
						$x++;
					}
				}

				//execute the query
				if ($this->_query->execute()) {
					# code...
					//echo 'success';
					//if the query executed successfully , store the resultset
					$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
					//update the count of results we get 
					$this->_count = $this->_query->rowCount();
				}
				else{
					$this ->_error = true;
				}
			}
			//return the object within the query method to allow change to take place
			return $this;
		}
		//define a method to allow us perform actions quickly
		public function action($action,$table,$where= array()){
			if(count($where)=== 3){
				$operators = array('=','>','<','>=','<=');

				$field = $where[0];
				$operator = $where[1];
				$value = $where[2];
				//check if the operator is inside the array
				if (in_array($operator, $operators)) {
					# code...
					$sql = "{$action} from {$table} where {$field} {$operator} ?";
					if (!$this->query($sql,array($value))->error()) {
						# code...
						//return the current object
						return $this;
					}
				}
			}
			return false;
		}
		public function get($table,$where){

			return $this->action('select *',$table,$where);

		}
		public function delete($table,$where){
			return $this->action('delete *',$table,$where);
		}
		public function insert($table,$fields=array()){
			//check if fields have any data
			if(count($fields)){
				$keys = array_keys($fields);
				$values = ''; //keep track of the question marks
				$x = 1; //counter

				//loop through the fields that have been defined
				foreach ($fields as $field) {
					# code...
					$values .= '?';
					if ($x < count($fields)) {
						# code...
						$values .= ',';
					}
					$x++;
				}
				//die($values);
				//implode take the keys of the array and convert it to a string with a separator
				$sql = "insert into Admin(`" . implode('`, `',$keys). "`) values({$values})";
				//echo $sql;
				if (!$this->query($sql,$fields)->error()) {
					# code...
					return true;
				}
			}
			return false;

		}
		public function update($table,$id,$fields){

			$set = '';
			$x = 1;

			foreach ($fields as $name => $value) {
				# code...
				$set .= "{$name} = ?";
				if ($x < count($fields)) {
						# code...
						$set .= ', ';
					}
					$x++;
			}

			$sql = "update {$table} set {$set} where id = {$id}";
			echo ($sql);
			if (!$this->query($sql,$fields)->error()) {
					# code...
					return true;
				}
				return false;

		}
		public function results(){
			return $this->_results;
		}

		public function error(){
			return $this->_error;
		}
		public function first(){

        return $this->results()[0];
    	}
		//shows that queried data has been returned
		public function count(){
			return $this->_count;
		}
}
