var ROOT = 'https://localhost';
var router;

$(function() {

	$.ajaxSetup({
		contentType: 'application/json; charset=utf-8',
		dataType: 'json'
	});

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