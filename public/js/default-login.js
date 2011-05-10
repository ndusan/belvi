$(document).ready(function(){
	
	//Remove default value
	$(".r").each(function(){
		$(this).focus(function(){
			if($(this).val() == $(this).attr("defaultValue")){
				$(this).val('');
				$(this).removeClass('lite');
			}
		}).blur(function(){
			if($(this).val() == ''){
				$(this).val($(this).attr("defaultValue"));
				$(this).addClass('lite');
			}
		});
	});
});