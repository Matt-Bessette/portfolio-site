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

if((int) $session->get('login') !== 1 && $_SERVER['REQUEST_URI'] !== '/login' && $_SERVER['REQUEST_URI'] !== '/verify' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('HTTP/1.1 401', true, 401);
	exit;
}

# All accounts can use the GET calls
if((int) $session->get('admin') === 0 && ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'OPTIONS')) {
	header('HTTP/1.1 401', true, 401);
	exit;
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

$api->post('/login', function($con, $payload, $nil, $session) {

	return ValidateLogin($con, $session, $payload['username'], $payload['password']);

});

$api->run();
