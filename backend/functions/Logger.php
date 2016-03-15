<?php

# Append the given error to the error log file
function Logger($file, $error) {
	$f = fopen('../logs/Error.log', 'a');
	$date = date("Y-m-d H:i:s");
	fwrite("[$date] [$file] $error");
	fclose($f);
	return 1;
}