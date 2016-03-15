module.exports = (grunt) ->
	
	module.exports = (grunt) ->
	# Project configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json')

		# Sass compile and concat config
		sass:
			options:
				# banner: '/*! <%= pkg.name %> v<%= pkg.version %> by <%= pkg.author.name %> <<%= pkg.author.email %>> (<%= pkg.author.url %>) */'
				sourcemap: 'none'
				style: 'compressed'
			build:
				files:
					'build/css/projects.min.css': 'src/scss/projects/projects.scss'
		
	})
	# Plug-ins
	grunt.loadNpmTasks 'grunt-contrib-sass'

	# Tasks
	grunt.registerTask 'build', [
		'sass:build'
	]