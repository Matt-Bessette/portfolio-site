<?php

class Session
{
	private $con, $conf, $cookie, $client, $SESSION, $started, $changed;

	const TEMP = 2;

	public function __construct($conf, $con) {

		$this->con = $con;

		$this->conf = $conf;

		$this->cookie = '';
		$this->started = false;
		$this->SESSION = array();
		$this->changed = false;
	}

	private function random_hash() {
		return hash('md5', bin2hex(openssl_random_pseudo_bytes(25)) . uniqid());
	}

	private function new_session() {
		$this->con->beginTransaction();
		try {
			$add = $this->con->prepare('insert into _session (cookie, data, client, death_date) values (?, ?, ?, ?)');
			$this->cookie = $this->random_hash();
			$add->execute(
				array(
					$this->cookie,
					'{}',
					$this->client,
					time()+$this->conf['cookie_lifetime']
				) 
			);
			$this->started = true;
			setcookie($this->conf['cookie_name'], $this->cookie, time()+$this->conf['cookie_lifetime'], "/");
			$this->con->commit();
			return true;
		}
		catch(Exception $e) {
			$this->con->rollback();
			throw $e;
		}
	}

	public function open() {
		$this->client = $_SERVER['HTTP_USER_AGENT'];
		if(!isset($_COOKIE[$this->conf['cookie_name']])) {
			$this->new_session();
			return true;
		}
		$this->cookie = $_COOKIE[$this->conf['cookie_name']];
		$get = $this->con->prepare('select data, client, death_date from _session where cookie = ?');
		$del = $this->con->prepare('delete from _session where death_date < ?');
		$get->execute(array($this->cookie));
		$del->execute(array(time()));
		$fetch = $get->fetch(PDO::FETCH_ASSOC);
		if($fetch === false) {
			$this->new_session();
			return true;
		}
		if($fetch['client'] !== $this->client)
			throw new Exception(CLIENT_MISMATCH);
		elseif($fetch['death_date'] < time()) {
			$this->destroy();
			throw new Exception(SESSION_EXPIRED);
		}
		$this->SESSION = json_decode($fetch['data'], true);
		$this->started = true;
		return true;
	}

	public function get_all() {
		if($this->started === false)
			throw new Exception(NO_SESSION);
		
		return $this->SESSION;
	}

	public function get($key) {
		if($this->started === false) 
			throw new Exception(NO_SESSION);
		if(isset($this->SESSION[$key]))	
			return $this->SESSION[$key];
		return '';
	}

	public function set($key, $val) {
		if($this->started === false) 
			throw new Exception(NO_SESSION);
		$this->changed = true;
		$this->SESSION[$key] = $val;
		return true;
	}

	public function deset($key) {
		if($this->started === false)
			throw new Exception(NO_SESSION);
		$this->changed = true;
		unset($this->SESSION[$key]);
		return true;
	}

	public function save_and_close() {
		if($this->started === false)
			throw new Exception(NO_SESSION);
		$this->save();
		$this->close();
		return true;
	}

	private function save() {
		$this->con->beginTransaction();
		try {
			if($this->started === false)
				throw new Exception(NO_SESSION);
			$query; $params;
			if($this->changed) {
				$query = 'update _session set death_date = ?, data = ? where cookie = ?';
				$params = array(
					time()+self::TEMP,
					json_encode($this->SESSION),
					$this->cookie
				);			
			}
			else {
				$query = 'update _session set death_date = ? where cookie = ?';
				$params = array(
					time()+self::TEMP,
					$this->cookie
				);
			}
			$update = $this->con->prepare($query);
			$insert = $this->con->prepare('insert into _session (cookie, data, death_date, client) values (?, ?, ?, ?)');
			$update->execute($params);
			$this->cookie = $this->random_hash();
			$newDeath = time()+$this->conf['cookie_lifetime'];
			$insert->execute(array(
				$this->cookie,
				json_encode($this->SESSION),
				$newDeath,
				$this->client
			));
			setcookie($this->conf['cookie_name'], $this->cookie, $newDeath, "/");
			$this->changed = false;
			$this->con->commit();
			return true;
		}
		catch(Exception $e) {
			$this->con->rollback();
			throw $e;
		}
	}

	public function close() {
		if($this->started === false)
			throw new Exception(NO_SESSION);
		
		$this->started = false;
		$this->SESSION = array();
		$this->cookie = "";
		return true;
	}

	public function destroy() {
		$stmt = $this->con->prepare("delete from _session where cookie = ?");
		$stmt->execute( array( $this->cookie ) );
		$this->started = false;
		$this->SESSION = array();
		$this->cookie = "";
		return true;
	}
}
?>