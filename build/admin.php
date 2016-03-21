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
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin.min.css">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="js/underscore.js"></script>
	<script src="js/backbone.js"></script>
	<script src="js/admin.js"></script>
</head>
<body>
	<?php require_once HEADER; ?>

	<div class='content'>

	</div>

	<?php require_once FOOTER; ?>
</body>
</html>