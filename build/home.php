<?php
	
require_once 'includes/Definitions.php';

?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>MBes Home</title>
		<link rel="icon" href="/img/ico.png" type="image/png" />
		<link rel="stylesheet" type="text/css" href="lib/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/index.min.css">
		<script src="lib/jquery.min.js"></script>
	</head>
	<body>
		<?php require_once(HEADER); ?>
		<div class="portfolio">
			<div>
				<span class='left'><img src="/img/uri-logo.png"></span>
				<span class='right'>Thank you for visiting my portfolio, my name is Matthew Bessette. I am a Computer Science major at the University of Rhode Island. I will be graduating in the Spring of 2016 with a Bachelors of Science with a minor in Cyber security. This site is a collection of work that I have developed in either my personal time, my classes, or while employed at the university.</span>
			</div>
			<div>
				<span class='left'>
					<label>Programming Languages and Frameworks</label>
					<ul>
						<li>PHP5</li>
						<li>SQL</li>
						<li>JavaScript</li>
						<li>HTML5 / CSS3</li>
						<li>Python</li>
						<li>Java</li>
					</ul>
					<ul>
						<li>Twig</li>
						<li>React.js</li>
						<li>Backbone.js</li>
						<li>jQuery</li>
						<li>SCSS</li>
						<li>Grunt</li>
					</ul>
				</span>
				<span class='right'>
					<label>Systems and Softwares</label>
					<ul>
						<li>Linux: Ubuntu</li>
						<li>Linux: CentOS</li>
						<li>Windows</li>
						<li>Mac OS X</li>
						<li>Android</li>
						<li>VirtualBox</li>
					</ul>
					<ul>
						<li>Apache2</li>
						<li>Git</li>
						<li>MySQL</li>
						<li>WordPress</li>
						<li>CouchDB</li>
						<li>Sublime Text 3</li>
					</ul>
				</span>
			</div>
		</div>
		<?php require_once(FOOTER); ?>
	</body>
</html>