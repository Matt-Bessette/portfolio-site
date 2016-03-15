<?php

# Get standardized constants
require_once 'includes/Definitions.php';

# Get function to build the configuration to access the database
require_once CONFIG;

# Get function to build the connection to the database
require_once CON;

# Get function to log errors if any occur
require_once LOGGER;

# Retrieve the array with configuration settings
# WARNING: NEVER DISPLAY CONTENTS OF THIS ARRAY
$c = getConfig();

# Create a PDO connection to the database
$con = GetCon($c);

# Query to recieve all the projects from the database
$nabProjects = $con->prepare('select _id, name, description, github, date, img from projects order by date desc');

# Execute the query and if there is an error, log it and display the 500 page to the user
try {

	$nabProjects->execute();

} catch(Exception $e) {

	Logger(__FILE__, $e->getMessage());

	echo file_get_contents(_500);

	exit;

}

?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MBes Projects</title>
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/projects.min.css">
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="projects.js"></script>
	</head>
	<body>
		<?php echo file_get_contents(HEADER); ?>

		<div class='mbes_projects_list'>
			<div class="cards">
				<?php while($project = $nabProjects->fetch(PDO::FETCH_ASSOC)): ?>
  				<div class="card" onclick="loadPage(<?php echo $project['_id'] ?>)">
    				<div class="card-image">
      					<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/mountains.png" alt="">
    				</div>
    				<div class="card-header">
      					<h2>
      						<?php echo $project['name'] ?>
      					</h2>
      				</div>
      				<div class="card-copy">
      					<h4><?php echo $project['date'] ?></h4>
      					<p><?php echo substr($project['description'], 0, 500) ?></p>
      				</div>
				</div> 
				<?php endwhile ?> 
			</div>
		</div>

		<?php echo file_get_contents(MODAL); ?>

		<?php echo file_get_contents(FOOTER); ?>
	</body>
</html>