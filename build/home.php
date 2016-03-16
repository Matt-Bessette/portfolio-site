<?php
	
require_once 'includes/Definitions.php';

?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>MBes Home</title>
		<link rel="icon" href="/img/ico.png" type="image/png" />
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/index.min.css">
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	</head>
	<body>
		<?php require_once(HEADER); ?>
		<div class="portfolio">
			<div>
				<span class='left'><img src="http://ratemyprofessors.mtvnimages.com/prof/t_Patrick_Logan_813936.jpeg"></span>
				<span class='right'>Hi I am Matthew Bessette. I am a Computer Science major at the University of Rhode Island. I intend to graduate in Spring of 2016 with a Bachelors of Science with a minor in Cybersecurity. This is my portfolio website. The projects I have listed on this site are a collection of work that I did in my personal time, my classes, and while employed at the university.</span>
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