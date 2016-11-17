jQuery(document).ready(function(){
	
	jQuery('#upload-csv').on('submit', function(e){
		e.preventDefault();
		var data = {
			'action': 	'my_action'
		};

		jQuery.post(ajax_object.ajax_url, data, function(response) {
			alert(response);
		});
	});

});