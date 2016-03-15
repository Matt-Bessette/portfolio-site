<?php

require_once 'settings/Config.php';

$c = getConfig();

require_once 'functions/Con.php';
require_once 'functions/Logger.php';

require_once 'core/Api.class.php';

$api = new Api($c, GetCon($c));

$api->options('/description', ['GET']);

$api->get('/description/:id', function($con, $id) {

	$desc = $con->prepare('select description from projects where _id = ?');

	$desc->execute([$id]);

	$data = $desc->fetch(PDO::FETCH_ASSOC);

	return $data;

});

$api->run();
