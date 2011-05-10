$(document).ready(function(){
	
	//Check if all fields are entered
	$("button[type='submit']").click(function(){
		
		var allOk = true;
		$("input[type='text'], input[type='file']").each(function(){
			if($(this).hasClass('r')){
				if($(this).val().length <= 0){
					allOk = false;
					$(this).addClass("w");
				}else $(this).removeClass("w");
			}
		});
		
		var checked = false;
		var hasCheckbox = false;
		$("input[type='checkbox']").each(function(){
			hasCheckbox = true;
			if($(this).hasClass('r') && $(this).is(':checked')) checked = true;
		});
		if(hasCheckbox){
			if(!checked){
				//There are no checked
				$("input[type='checkbox']").each(function(){
					if($(this).hasClass('r') && !$(this).is(':checked')) $("label[for='" + $(this).attr('id') + "']").addClass("w_text");
				});
				allOk = false;
			}else{
				$("input[type='checkbox']").each(function(){
					$("label[for='" + $(this).attr('id') + "']").removeClass("w_text");
				});
			}
		}
		
		
		if(!allOk) return false;
	});
	
	//Show / hide submenu
	$(".submenu-action").click(function(){
		
		var id = $(this).attr('id');
		id = id.substring(8, id.length);
		
		//check if it's open close first all
		$(".submenu").each(function(){
			
			if($(this).hasClass('show') && $(this).attr('id') != id) $(this).removeClass('show').addClass('hide').slideUp(300);
			
		});
		
		if($("#" + id).hasClass('hide')) $("#" + id).removeClass('hide').addClass('show');
		else $("#" + id).addClass('hide').removeClass('show');
		
		$("#" + id).slideToggle();
	});
	
	//Confirm delete
	$('.j_del').each(function(){
		$(this).click(function(){
			if(confirm('Siguno želite da obrišete: ' + $(this).attr('rel') + "?")) return true;
			else return false;
		});
	});
	
	$(".logout").click(function(){
		if(confirm("Da li ste sigurni da želite da se odjavite?")) return true;
		else return false;
	});
	
	
	//Carriere - popUp
	$(".details").each(function(){
		$(this).click(function(){
			var id = $(this).attr('id');
			id = id.substring(8, id.length);
			
			$("#popUp-" + id).toggle();
		});
	});

});

function confirmDelete(who){
	if(confirm(who)) return true;
}