var ViewProject = {

	$el:null,
	$div:null,
	$bod1:null,

	init: function($_el) {

		this.$el = $_el;

		this.$div = $(
			'<div class="project_edit">\
				<div class="project">\
					<div class="title">Project <span id="pid"></span></div>\
					<div class="bod">\
						<label>Name: </label>\
						<input type="text" id="name" placeholder="Name">\
						<label>Description: </label>\
						<textarea id="description" placeholder="Description..."></textarea>\
						<label>GitHub or Local Download Link </label>\
						<input type="text" id="github" placeholder="GitHub URL">\
						<label>Local IMG: </label>\
						<input type="text" id="img" placeholder="/img/uri_logo.png">\
						<label>Date: </label>\
						<input type="number" max-width="4" id="year" placeholder="YYYY">-<input placeholder="MM" type="number" id="month" max-width="2">-<input placeholder="DD" type="number" id="day" max-width="2">\
					</div>\
				</div>\
				<div class="danger">\
					<div class="title">Danger Zone</div>\
					<div class="bod">\
						<label>Delete Project: </label>\
						<button id="delete">Delete</button>\
					</div>\
				</div>\
			</div>'
		);

		this.$bod1 = this.$div.find('div.bod');

		var ctx = this;

		this.$div.on('click', 'button#delete', function() {
			ctx.DeleteProject($(this).data('id'));
		});

	},

	render: function() {

		

	},

	CreateProject: function() {

		$.ajax({
			type:'POST',
			url: ROOT+'/api/1/projects',
			data: JSON.stringify({
				name: $('input#name').val(),
				description: $('textarea#description').val(),
				github: $('input#github').val(),
				img: $('input#img').val(),
				date: $('input#year').val()+'-'+$('input#month').val()+'-'+$('input#day').val()
			})
		}).done(function() {

			alert('Project created');
			router.navigate('projman', {trigger: true});

		}).fail(function() {
			console.log('Error creating project...');
		});
	},

	UpdateProject: function(id) {

		$.ajax({
			type:'PUT',
			url: ROOT+'/api/1/projects/'+id,
			data: JSON.stringify({
				name: $('input#name').val(),
				description: $('textarea#description').val(),
				github: $('input#github').val(),
				img: $('input#img').val(),
				date: $('input#year').val()+'-'+$('input#month').val()+'-'+$('input#day').val()
			})
		}).done(function() {

			alert('Project updated');

		}).fail(function() {
			console.log('Error creating project...');
		});
	},

	DeleteProject: function(id) {

		if(confirm('Are you sure you want to delete this project? ('+id+')')) {
			$.ajax({
				type: 'DELETE',
				url: ROOT+'/api/1/projman/'+id,
			}).done(function() {

				alert('Project deleted');
				router.navigate('projman', {trigger: true});

			}).fail(function() {
				console.log('Error deleting project...');
			});
		}
	}
};