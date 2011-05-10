$(document).ready(function(){
	
	$("#add_parent").click(function(){
		var id = parseInt($("#parent_num").val());
		id += 1;
		var html = "<tr id='parent-" + id + "'>" + 
						"<td>" + 
							"<label>Ime i prezime <strong>(*)</strong>:</label>" + 
							"<input name='parent[name][]' value='' class='mediumInput r' />" + 
						"</td>" + 
						"<td>" + 
							"<label>Datum rođenja <strong>(*)</strong>:</label>" + 
							"<input name='parent[birth_date][]' value='' class='smallInput r fl' />" +
							"<span class='calendar'></span>" +
						"</td>" +
						"<td><a href='javascript:;' onClick='javascript:remove(\"parent\", " + id + ");' class='remove_parent'><!--remove parent--></td>" +		
					"</tr>";
		
		//Add new line and increment counter
		$(this).parent().parent().before(html);
		$("#parent_num").val(id);
	
	});
	
	$("#add_child").click(function(){
		var id = parseInt($("#child_num").val());
		id += 1;
		var html = "<tr id='child-" + id + "'>" + 
						"<td>" + 
							"<label>Ime i prezime <strong>(*)</strong>:</label>" + 
							"<input name='child[name][]' value='' class='mediumInput r' />" + 
						"</td>" + 
						"<td>" + 
							"<label>Datum rođenja <strong>(*)</strong>:</label>" + 
							"<input name='child[birth_date][]' value='' class='smallInput r fl' />" +
							"<span class='calendar'></span>" +
						"</td>" +
						"<td><a href='javascript:;' onClick='javascript:remove(\"child\", " + id + ");' class='remove_parent'><!--remove parent--></td>" +		
					"</tr>";
		
		//Add new line and increment counter
		$(this).parent().parent().before(html);
		$("#child_num").val(id);
	});
});

function remove(type, id){
	$("#" + type + "-" + id).remove();
	return true;
}

