var ROOT = 'https://localhost';
var router;

$(function() {

	var rt = $('div#content');

	ViewLogin.init(rt);
	ViewMenu.init(rt);
	ViewAllProjects.init(rt);

	router = new CoreRouter();

	Backbone.history.start({
		pushState: false,
		root: "/admin"
	});

});