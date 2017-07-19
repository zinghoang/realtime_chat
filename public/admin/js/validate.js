$( document ).ready( function () {
	$( "#room" ).validate( {
		
		rules: {
			name: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
		}
	});
	$( "#emotion" ).validate( {
		
		rules: {
			name: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
			code: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
		}
	});
});