<?php 

require_once 'includes/Definitions.php'; 

require_once CONFIG;	$c = GetConfig();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MBes Admin</title>
	<link rel="icon" href="/img/ico.png" type="image/png" />
	<link rel="stylesheet" type="text/css" href="lib/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/admin.min.css">
	<script src="lib/jquery.min.js"></script>
	<script src="lib/underscore.js"></script>
	<script src="lib/backbone.js"></script>
</head>
<body>
	<?php require_once HEADER; ?>

	<div id="content">
		
	</div>

	<?php require_once FOOTER; ?>
	<script src="js/admin.js"></script>
</body>
</html>