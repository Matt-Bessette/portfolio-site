<?php

require_once 'settings/Codes.php';

require_once 'settings/Config.php';

$c = getConfig();

require_once 'functions/Con.php';

$con = GetCon($c);

require_once 'functions/Logger.php';

require_once 'core/Session.class.php';

$session = new Session($c, $con);

$session->open();

$login = $session->get('login');
$admin = $session->get('admin');

# Remove GET variables (can be from jsonp)
$cleanup = explode('?', $_SERVER['REQUEST_URI']);

# If user is not logged in...
if($login !== 1) {

	# And they are not trying to login or check status...
	if($cleanup[0] !== '/login' and $cleanup[0] !== '/verify' ) {

		# Tell them no
		header('HTTP/1.1 401', true, 401);
		$session->save_and_close();
		exit;
	}
}

# If user is not admin...
if($admin !== 1) {

	# And they are not trying GET or OPTIONS calls...
	if($_SERVER['REQUEST_METHOD'] !== 'GET' and $_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {

		# Tell them no
		header('HTTP/1.1 401', true, 401);
		$session->save_and_close();
		exit;
	}
}

require_once 'core/Api.class.php';

require_once 'functions/Projects.php';
require_once 'functions/Users.php';
require_once 'functions/Login.php';

$api = new Api($c, $con, $session);

$api->options('/projects', ['GET', 'POST', 'PUT', 'DELETE']);

$api->get('/projects', function($con, $nil) {

	return FetchAllProjects($con);

});

$api->get('/projects/:id', function($con, $id) {

	return FetchProjectById($con, $id);

});

$api->post('/projects', function($con, $payload) {

	return CreateProject($con, $payload);

});

$api->put('/projects/:id', function($con, $id, $payload) {

	return UpdateProject($con, $id, $payload);

});

$api->delete('/projects/:id', function($con, $id) {

	return DeleteProject($con, $id);

});

$api->options('/users', ['GET', 'POST', 'PUT', 'DELETE']);

$api->get('/users', function($con, $nil) {

	return FetchAllUsers($con);

});

$api->get('/users/:id', function($con, $id) {

	return FetchUserById($con, $id);

});

$api->post('/users', function($con, $payload) {

	return CreateUser($con, $payload);

});

$api->put('/users/:id', function($con, $id, $payload) {

	return UpdateUser($con, $id, $payload);

});

$api->delete('/users/:id', function($con, $id) {

	return DeleteUser($con, $id);

});

$api->get('/verify', function($con, $nil, $session) {

	return [
		'login'	=>	(int) $session->get('login'),
		'admin'	=>	(int) $session->get('admin')
	];

});

$api->options('/verify', ['GET']);

$api->post('/login', function($con, $payload, $nil, $session) {

	return ValidateLogin($con, $session, $payload['username'], $payload['password']);

});

$api->run();
