$( document ).ready( function () {
	$( "#upload-file" ).validate( {
		
		rules: {
			title: {
				extension: "mp4, mp3, avi"
			},
		},
	});
});
