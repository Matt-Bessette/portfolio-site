<?php

function ValidateLogin($con, $session, $user, $password) {

	$session->set('login', 0);

	$getuser = $con->prepare('select _id, email, username, hash, admin, locked, failed_attempts from users where email = :user or username = :user');

	$getuser->bindParam(':user', $user, PDO::PARAM_STR, 256);

	$getuser->execute();

	$prof = $getuser->fetch(PDO::FETCH_ASSOC);

	if(count($prof) === 0)
		throw new Exception(BADACCT);

	if((int) $prof['locked'] === 1)
		throw new Exception(LOCKEDACCT);

	if((int) $prof['failed_attempts'] >= 3) {
		$upduser = $con->prepare('update users set locked = 1 where _id = ?');
		$upduser->execute([$profile['_id']]);
		throw new Exception(LOCKEDACCT);
	}

	if(!password_verify($password, $prof['hash'])) {
		$upduser = $con->prepare('update users set failed_attempts = failed_attempts + 1 where _id = ?');
		$upduser->execute([$profile['_id']]);
		throw new Exception(BADACCT);
	}

	$session->set('login', 1);
	$session->set('admin', $prof['admin']);
	$session->set('username', $prof['username']);

	$upduser = $con->prepare('update users set last_login = ?, failed_attempts = 0 where _id = ?');

	$upduser->execute([microtime(true)]);

	return true;

}