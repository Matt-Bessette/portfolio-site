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
					'build/css/admin.min.css': 'src/scss/admin/admin.scss'
		
		# Copy normalize css into build
		copy:
			build:
				files: [
					{
						expand: false
						src: ['node_modules/normalize.css/normalize.css']
						dest: 'build/css/normalize.css'
					}
					{
						expand: false
						src: ['node_modules/backbone/backbone.js']
						dest: 'build/js/backbone.js'
					}
					{
						expand: false
						src: ['node_modules/backbone/node_modules/underscore/underscore.js']
						dest: 'build/js/underscore.js'
					}
				]

		concat:
			build:
				src: ['src/js/admin/*.js']
				dest: 'build/js/admin.js'

		watch:
			jsbuild:
				files:
					'src/js/admin/*.js'
				tasks:
					'concat:build'
			sassbuild:
				files:
					'src/scss/**'
				tasks:
					'sass:build'


	})
	# Plug-ins
	grunt.loadNpmTasks 'grunt-contrib-sass'
	grunt.loadNpmTasks 'grunt-contrib-copy'
	grunt.loadNpmTasks 'grunt-contrib-concat'
	grunt.loadNpmTasks 'grunt-contrib-watch'

	# Tasks
	grunt.registerTask 'build', [
		'sass:build'
		'copy:build'
		'concat:build'
	]