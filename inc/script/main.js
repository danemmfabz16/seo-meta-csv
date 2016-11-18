jQuery(document).ready(function(){
	
	jQuery('#upload-csv').on('submit', function(e){
		
		e.preventDefault();
		var formdata = new FormData(this);
		formdata.append('action', 'file_validate');

		jQuery.ajax({  
            url: ajax_object.ajax_url,  
            method: "POST",  
            data: formdata,  
            contentType: false,      
            cache: false,               
           	processData: false,     
            success: function(data){  
                alert(data);
            }  
        });  


	});

});