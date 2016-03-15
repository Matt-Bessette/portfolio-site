<?php

# Takes the config array and returns the PDO object
function GetCon($c) {

	return new PDO(
		$c['db_type'].
		':host='.$c['db_host'].
		';dbname='.$c['db_name'],
		$c['db_user'],
		$c['db_pass'],
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);

}