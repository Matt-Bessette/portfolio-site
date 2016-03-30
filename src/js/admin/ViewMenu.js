var ViewMenu = {

	$el:null,
	$div:null,

	init: function($_el) {
		
		this.$el = $_el;

		this.$div = $('\
			<div class="menu-container">\
				<div class="title">Menu</div>\
				<div class="menu">\
					<span id="projman">Projects</span>\
					<span id="userman">Users</span>\
				</div>\
			</div>\
		');

	},

	render: function() {

		if(!$.contains(document, this.$div))
			this.$el.html(this.$div);

		$('span.selected').removeClass('selected');

		$('span#'+Backbone.history.getFragment().split('/')[0]).addClass('selected');

		$('span').click(function() {
			var id = $(this).attr('id');
			router.navigate(id, {trigger:true});
		});

	}
};