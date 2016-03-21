<?php
	
/* V.1.4.1b */
class Api {


	private $methods,	# Store of registered api calls
			$session,	# Session object
			$con,		# PDO Connection
			$conf;		# Database Configuration

	public function __construct($conf, $con, $session) {

		$this->conf = $conf;

		$this->con = $con;

		$this->session = $session;

		$this->methods = array(
			"GET"	=> 	[], 
			"POST"	=> 	[],
			"PUT"	=> 	[],
			"DELETE"=> 	[],
			"OPTIONS"=> []
		);
	}

	/* This function is to be called when all calls are registered */
	public function run() {
		try {

			# The pieces of the API call
			$pieces = explode('/', $_SERVER['REQUEST_URI']);

			$query1 = "";	# Without variable
			$query2 = "";	# With variable

			$GETS1 = null;
			$GETS2 = array();

			foreach($pieces as $k=>$piece) {

				$query1 .= "_$piece";		# Query1

				if($k < count($pieces)-1)
					$query2 .= "_$piece";	# Query2
				else
					$GETS2[] = $piece;
			}

			# Check if query without variable exists, if so pull the array
			if(isset($this->methods[$_SERVER['REQUEST_METHOD']][$query1])) {
				$last = $this->methods[$_SERVER['REQUEST_METHOD']][$query1];
				$GETS = $GETS1;
			}

			# Check if query with variable exists, if so pull the array
			elseif(isset($this->methods[$_SERVER['REQUEST_METHOD']][$query2."__VAR"])) {
				$last = $this->methods[$_SERVER['REQUEST_METHOD']][$query2."__VAR"];
				$GETS = $GETS2;
			}

			# If query does not exist, throw it
			else {
				$last = "Bad Call";
				$GETS = null;
			}

			# Send the GET variables as one
			if(count($GETS) < 2 && count($GETS) > 0)
				$GETS = $GETS[0];

			# Throw the error if array wasnt found
			if(!isset($last['function']) && !isset($last['allow'])){
				$this->_400("Bad Call");
				echo $last['function'];
			}

			switch($_SERVER['REQUEST_METHOD']) {

				# Call the function with GET structure
				case 'GET':
					$resp = call_user_func($last['function'], $this->con, $GETS, $this->session);
					break;

				# Call the function with POST structure
				case 'POST':
					$resp = call_user_func($last['function'], $this->con, $this->POST_JSON(), $GETS, $this->session);
					break;

				# Call the function with PUT structure
				case 'PUT':
					$resp = call_user_func($last['function'], $this->con, $GETS, $this->POST_JSON(), $this->session);
					break;

				# Call the function with DELETE structure
				case 'DELETE':
					$resp = call_user_func($last['function'], $this->con, $GETS, $this->session);
					break;

				# Display the options
				case 'OPTIONS':
					$str = "Allow: ";
					for($i=0; $i<count($last['allow'])-1; $i++)
						$str .= "{$last['allow'][$i]}, ";
					$str .= $last['allow'][count($last['allow'])-1];
					// $this->session->save_and_close();
					header('Content-Type : application/json; charset=utf-8');
					header("Allow : $str");
					exit;
					break;
				default:
					$this->_400("Bad Method");
			}
			if($resp === OK)
				$this->_200("Success");
		
			else
				$this->_200("", json_encode($resp));
		}
		catch(Exception $e) {
			switch($e->getMessage()){
				case BADACCT: case LOCKEDACCT: case BADEMAIL: case BADPASS: case PASSTOOSHORT: case PASSTOOWEAK: case MISSINGDATA: case OK:
					$this->_400($e->getMessage());
				default:
					Logger(__FILE__, $e->getMessage());
					$this->_500();
			}
		}
	}
	public function get($url, $callback) {
		return $this->register("GET", $url, $callback);
	}
	public function post($url, $callback) {
		return $this->register("POST", $url, $callback);
	}
	public function put($url, $callback) {
		return $this->register("PUT", $url, $callback);
	}
	public function delete($url, $callback) {
		return $this->register("DELETE", $url, $callback);
	}
	public function options($url, $allow) {
		return $this->register("OPTIONS", $url, $allow);
	}

	/*
		Order the permission lowest to highest if overloading
		0 then 2 etc...
	*/
	private function register($method, $url, $callback) {
		$pieces = explode('/', $url);
		$query = "";
		foreach($pieces as $piece) {
			if(strpos($piece, ':') === false) 
				$query .= "_$piece";
			else
				$query .= "__VAR";
		}
		if(is_array($callback))
			$toWrite = array("allow"=>$callback);
		else
			$toWrite = array("function"=>$callback);

		$this->methods[$method][$query] = $toWrite;
		return true;
	}

	private function POST_JSON() {
		try {
			if(strtolower(@$_SERVER["CONTENT_TYPE"]) === "application/json; charset=utf-8") {
			
				$POST = json_decode(file_get_contents('php://input'));
				return $POST;
			}
			else
				return null;
		} catch(Exception $e) {	// TODO : clarify exception and handle different responses
			return null;
		}
	}
	private function _500() {
		// $this->session->save_and_close();
		header("Accept: application/json");
		header("Content-Type : application/json; charset=utf-8");
		header("HTTP/1.1 500 Internal Server Error", true, 500);
		exit;
	}
	private function _400($message) {
		// $this->session->save_and_close();
		header("Accept: application/json");
		header("Content-Type : application/json; charset=utf-8");
		header("HTTP/1.1 400 $message", true, 400);
		exit;
	}
	private function _401() {
		// $this->session->save_and_close();
		header("Accept: application/json");
		header("Content-Type : application/json; charset=utf-8");
		header("HTTP/1.1 401 Not Logged In", true, 401);
		exit;
	}
	private function _200($message, $body=null) {

		// $this->session->save_and_close();
		if($body === null){
			header("Accept: application/json");
			header("Content-Type : application/json; charset=utf-8");
			header("HTTP/1.1 200 $message", true, 200);
		}
		else {
			header("Accept: application/json");
			header("Content-Type : application/json; charset=utf-8");
			echo $body;
		}
		exit;
	}
}
?>