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

	_verify: function(goto) {

		var ctx = this;

		$.ajax({
			type: 'GET',
			url: ROOT+'/api/1/verify'
		}).done(function(r){
			if(r.login === 1) {
				if(goto !== undefined)
					ctx.navigate(goto, {trigger:true});
			}
			else
				ctx.navigate('login', {trigger:true});
		}).fail(function() {
			console.log('Error checking session...');
		});
	},

	index: 	function() {

		this._verify('projman');
	},

	login: function() {

		console.log('Called login');
		ViewLogin.render();

	},

	userman: function() {

		this._verify();
		ViewMenu.render();


	},

	usermanId: function(uid) {

		this._verify();
		ViewMenu.render();


	},

	projman: function() {

		this._verify();
		ViewMenu.render();
		ViewAllProjects.render();

	},

	projmanId: function(pid) {

		this._verify();
		ViewMenu.render();


	}

});