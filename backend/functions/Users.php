<?php

require_once '../settings/Codes.php';

function _PasswordEnforce($pass) {

	$score = 3;

	if(count($pass) < 8)
		return PASSTOOSHORT;

	if(strpos($pass, ' ') === false)
		$score--;

	if(preg_match('/[0-9]/') !== 1)
		$score--;

	if($score < 2)
		return PASSTOWEAK;

	return true;

}

function FetchUsers($con) {

	$all = $con->prepare('select _id, email, username, admin, last_login, failed_attempts, locked from users');

	$all->execute();

	return $all->fetchAll(PDO::FETCH_ASSOC);

}

function FetchUserById($con, $id) {

	$all = $con->prepare('select _id, email, username, admin, last_login, failed_attempts, locked from users where _id = ?');

	$all->execute([$id]);

	return $all->fetchAll(PDO::FETCH_ASSOC);

}

function CreateUser($con, $profile) {

	if(!isset($profile['email'], $profile['password']))
		throw new Exception(MISSINGDATA);

	$pchk = _PasswordEnforce($profile['password']);

	if($pchk !== true)
		throw new Exception($pchk);

	$nuser = $con->prepare('insert into user (email, username, hash, admin, last_login) values (:email, :username, :hash, :admin, 0)');

	$nuser->bindParam(':email', $profile['email'], PDO::PARAM_STR, 256);
	$nuser->bindParam(':username', $profile['username'], PDO::PARAM_STR, 128);
	$nuser->bindParam(':hash', password_hash($profile['password'], PASSWORD_DEFAULT), PDO::PARAM_STR, 256);
	$nuser->bindParam(
		':admin', 
		(int) $profile['admin'] < 2 ? abs((int) $profile['admin']) : 0,
		PDO::PARAM_INT
	);

	$nuser->execute();

	return OK;

}

function UpdateUser($con, $id, $profile) {

	if(!isset($id))
		throw new Exception(MISSINGDATA);

	$o = [];

	if(isset($profile['email'])) 
		$o[] = 'email=:email';
	if(isset($profile['username'])) 
		$o[] = 'username=:username';
	if(isset($profile['password'])) {

		$pchk = _PasswordEnforce($profile['password']);

		if($pchk !== true)
			throw new Exception($pchk);

		$o[] = 'hash=:hash';
	}
	if(isset($profile['admin']) && (int) $profile['admin'] < 2) 
		$o[] = 'admin=:admin';
	if(isset($profile['locked']) && (int) $profile['locked'] < 2) 
		$o[] = 'locked=:locked';

	if(count($o) === 0)
		throw new Exception(MISSINGDATA);

	$uuser = $con->prepare('update users set '.implode(',', $o).' where _id = :id');

	if(isset($profile['email'])) 
		$uuser->bindParam(':email', $profile['email'], PDO::PARAM_STR, 256);
	if(isset($profile['username'])) 
		$uuser->bindParam(':username', $profile['username'], PDO::PARAM_STR, 128);
	if(isset($profile['password'])) 
		$uuser->bindParam(':hash', password_hash($profile['password'], PASSWORD_DEFAULT), PDO::PARAM_STR, 256);
	if(isset($profile['admin']) && (int) $profile['admin'] < 2) 
		$uuser->bindParam(':admin', abs($profile['admin']), PDO::PARAM_INT);
	if(isset($profile['locked']) && (int) $profile['locked'] < 2) 
		$uuser->bindParam(':locked', $profile['locked'], PDO::PARAM_INT);

	$uuser->bindParam(':id', $id, PDO::PARAM_INT);

	$uuser->execute();

	return OK;
}

function DeleteUser($con, $id) {

	$duser = $con->prepare('delete from users where _id = ?');

	$duser->execute([$id]);

	return OK;

}