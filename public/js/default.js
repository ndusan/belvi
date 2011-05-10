$(document).ready(function(){
	
	//Select mask
	$(".masked_styled select").each(function(){
			$(this).change(function(){
				$(this).parent().find('span').html($(this).find(':selected').text());
			});
	});
	
	$("input[type='submit']").click(function(){
		//Required fields
		var allOk = true;
		$(".r").each(function(){
			
			if($(this).val().length <= 0){
				$(this).addClass('warning');
				allOk = false;
			}else{
				$(this).removeClass('warning');
				var numRegEx = /^[0-9]+$/i;
				var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
				var telRegEx = /^[0-9-\/+]+$/i;
				//Check additional things if needed
				switch($(this).attr('name')){
					//Year
					case 'born': case 'year':
						if($(this).val().search(numRegEx) == -1){
							$(this).addClass('warning');
							allOk = false;
						}
					break;
					case 'email':
						if($(this).val().search(emailRegEx) == -1){
							$(this).addClass('warning');
							allOk = false;
						}
					break;
					case 'telephone':
						if($(this).val().search(telRegEx) == -1){
							$(this).addClass('warning');
							allOk = false;
						}
					break;
					default: //empty
				}
				
				
			}
		});
		
		if(!allOk) return false;
	});
});