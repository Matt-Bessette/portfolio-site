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
					'build/css/index.min.css': 'src/scss/index/index.scss'
					'build/css/contact.min.css': 'src/scss/contact/contact.scss'
		
		# Copy normalize css into build
		copy:
			build:
				files: [
					{
						expand: false
						src: ['node_modules/normalize.css/normalize.css']
						dest: 'build/css/normalize.css'
					}
				]

	})
	# Plug-ins
	grunt.loadNpmTasks 'grunt-contrib-sass'
	grunt.loadNpmTasks 'grunt-contrib-copy'

	# Tasks
	grunt.registerTask 'build', [
		'sass:build'
		'copy:build'
	]