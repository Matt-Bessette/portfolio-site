var ViewAllProjects = {

	$el:null,
	$div: null,
	$tbody: null,

	init: function($_el) {

		this.$el = $_el;

		this.$div = $(
			'<div class="projects">\
				<div class="title">Project Manager</div>\
				<button id="new_proj">+ Create Project</button>\
				<table>\
					<thead>\
						<tr>\
							<th>IMG</th>\
							<th>ID</th>\
							<th>Name</th>\
							<th>GitHub</th>\
						</tr>\
					</thead>\
					<tbody></tbody>\
				</table>\
			</div>'
		);

		this.$tbody = this.$div.find('tbody');

	},

	render: function() {

		var ctx = this;

		ctx.$el.append(ctx.$div);

		$.ajax({
			type: 'GET',
			url: ROOT+'/api/1/projects'
		}).done(function(data) {

			$.each(data, function(row) {
				
				var r = $('<tr></tr>');

				r.append($('<td>'+row.img+'</td>'));
				r.append($('<td>'+row._id+'</td>'));
				r.append($('<td>'+row.name+'</td>'));
				r.append($('<td>'+row.github+'</td>'));

				ctx.$tbody.append(r);

			});

			$('#new_proj').click(function() {
				router.navigate('/projman/new', {trigger: true});
			});

		}).fail(function() {
			console.log('Error getting projects...');
		});

	}

};