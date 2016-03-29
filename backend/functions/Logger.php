<?php

# Append the given error to the error log file
function Logger($file, $error) {
	$f = fopen(__DIR__.'/logs/Error.log', 'a');
	$date = date("Y-m-d H:i:s");
	fwrite($f, "[$date] [$file] ".(is_array($error) ? '['.implode(',').']' : $error)." \n");
	fclose($f);
	return 1;
}