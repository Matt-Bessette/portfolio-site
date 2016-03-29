var ViewLogin = {

	$el:null,
	$div:null,
	$span:null,

	init: function(rt) {

		this.$el = rt;

		/*jshint multistr: true */
		this.$div = $(
			'<div class="login">\
				<p>Please login</p>\
				<input type="text" name="username" placeholder="Username or Email" id="username" >\
				<input type="password" name="password" placeholder="********" id="password" >\
				<button onclick="ViewLogin.AttemptLogin()">Login</button>\
			</div>'
		);

		this.$span = $('<span id="error"></span>');

	},

	AttemptLogin: function() {

		this.$span.html('');

		var ctx = this;

		var email = $('input#username').val();
		var pass = $('input#password').val();

		$.ajax({
			type:'POST',
			url: ROOT+'/api/1/login',
			dataType:'json',
			data: JSON.stringify({username:email, password:pass}),
			contentType: 'application/json; charset=utf-8'
		}).done(function(resp) {

			if(resp === false)
				ctx.$span.html('Invalid username/password');
			else
				router.navigate('');

		}).fail(function(jqXHR) {
			console.log(jqXHR)
			console.log('Error logging in...');
			ctx.$span.html('There was a server error');
		});
	},

	render: function() {

		console.log('render login');

		var ctx = this;

		this.$el.html(this.$div);

		this.$div.append(this.$span);
	}

};