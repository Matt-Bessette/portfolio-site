var CoreRouter = Backbone.Router.extend({

	routes: {
		"":				"index",
		"menu": 		"menu",
		"login": 		"login",
		"userman": 		"userman",
		"userman/:uid": "usermanId",
		"projman": 		"projman",
		"projman/:pid": "projmanId"
	},

	index: 	function() {

		var ctx = this;

		$.ajax({
			type: 'GET',
			url: ROOT+'/api/1/verify',
			dataType: 'json'
		}).done(function(r) {

			console.log(r);

			var view;

			if(r.login === 1)
				ctx.navigate('menu');
			else
				ctx.navigate('login');
			

		}).fail(function() {
			console.log('Error checking session...');
		});
	},

	menu: function() {

	},

	login: function() {

		console.log('Called login');
		ViewLogin.render();

	},

	userman: function() {

	},

	usermanId: function(uid) {

	},

	projman: function() {

	},

	projmanId: function(pid) {

	}

});