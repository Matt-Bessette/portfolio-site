<?php

# Location of the api directory for backend services
define('API_LOC' , '/var/www/html/backend/');

# Location of the configuration file
define('CONFIG', API_LOC.'/settings/Config.php');

# Location of the create PDO connection file
define('CON', API_LOC.'/functions/Con.php');

# Location of error logger
define('LOGGER', API_LOC.'/functions/Logger.php');

# Location of page head
define('HEADER', 'includes/Header.php');

# Location of page foot
define('FOOTER', 'includes/Footer.php');

# Location of 500 error page
define('_500', 'includes/500.php');