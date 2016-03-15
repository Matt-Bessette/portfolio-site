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
$nabProjects = $con->prepare('select _id, name, description, github, date, img from projects order by date asc');

# Execute the query and if there is an error, log it and display the 500 page to the user
try {

	$nabProjects->execute();

} catch(Exception $e) {

	Logger(__FILE__, $e->getMessage());

	require_once 'includes/500.php';

	exit;

}

?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MBes Projects</title>
		<link rel="stylesheet" type="text/css" href="css/projects.min.css">
	</head>
	<body>
		<div class='mbes_projects_list'>
			<ul class="bullets">
				<?php while($project = $nabProjects->fetch(PDO::FETCH_ASSOC)): ?>
  				<li class="bullet">
    				<div class="bullet-icon <?php echo $project['img'] ?>">
      					<span class="<?php echo $project['img'] ?>"><?php echo $project['img'] ?></span>
    				</div>
    				<div class="bullet-content">
      					<h2>
      						<a href="<?php echo $project['github'] ?>">
      							<?php echo $project['name'] ?>
      						</a>
      					</h2>
      					<p><?php echo $project['description'] ?></p>
      				</div>
				</li> 
				<?php endwhile ?> 
			</ul>
		</div>
	</body>
</html>