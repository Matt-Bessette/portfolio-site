var ROOT = 'https://localhost';
var router;

$(function() {

	var rt = $('div#content');

	ViewLogin.init(rt);


	console.log('hay now');
	router = new CoreRouter();

	Backbone.history.start({
		pushState: false,
		root: "/admin"
	});

});