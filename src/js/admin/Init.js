var ROOT = 'https://api.localhost';
var router;

$(function() {
	router = new CoreRouter();

	Backbone.history.start({
		pushState: false,
		root: "/admin"
	});

});