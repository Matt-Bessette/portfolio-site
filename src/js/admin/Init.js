$(function() {

	var ROOT = 'https://api.localhost';

	$.ajax({
		type: 'GET',
		url: ROOT+'/verify',
		dataType: 'jsonp',
	}).done(function(r) {

		console.log(r);

	}).fail(function() {
		console.log('Error checking session...');
	});

});