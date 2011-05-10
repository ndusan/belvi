<div class="address_holder">



		<form action="<?php echo BASE_PATH.'pretraga'.DS; ?>" method="get">
		<div class="search">
			<div class="search_title cufon"> BRZA PRETRAGA</div>
			<div class="search_box">
				<div class="masked_styledS">
					<span>- Tip putovanja -</span>
					<select name="s_destination_id" class="req">
						<option value="0">- Tip putovanja -</option>
						<?php if(isset($s_dest) && !empty($s_dest)):?>
						<?php foreach($s_dest as $s_d):?>
						<option value="<?php echo $s_d['id'];?>"><?php echo $s_d['name'];?></option>
						<?php endforeach;?>
						<?php endif; ?>
					</select>
				</div>
				<div class="masked_styledS">
					<span>- Destinacija -</span>
					<select name="s_accomodation_type_id">
						<option value="0">- Destinacija -</option>
					</select>
				</div>
				<div class="masked_styledS">
					<span>- Prevozno sredstvo -</span>
					<select name="s_transport_id">
						<option value="0">- Prevozno sredstvo -</option>
						<?php if(isset($s_tr) && !empty($s_tr)):?>
						<?php foreach($s_tr as $s_t):?>
						<option value="<?php echo $s_t['id'];?>"><?php echo $s_t['name'];?></option>
						<?php endforeach;?>
						<?php endif; ?>
					</select>
				</div>
				<div>
					<input type="submit" name="search" value="Pretraži" class="search_button cufon" />
				</div>
			</div>
		</div>
		</form>
		<script type="text/javascript">
			$(document).ready(function(){

				$("select[name='s_destination_id']").change(function(){
					var selVal = $("select[name='s_destination_id'] option:selected").val();
					var selText = $("select[name='s_destination_id'] option:selected").text();
					$(this).parent().find('span').html(selText);

					$("select[name='s_accomodation_type_id']").parent().find('span').html('- Destinacija -');
					$.get(	'<?php echo BASE_PATH.'pretraga'.DS.'get-destinations'.DS; ?>',
							{'id': selVal},
							function(data){
									var output = "<option value='0'>- Tip putovanja -</option>";
									if(data){
										
										for(i=0; i<data.length; i++) 
											output += "<option value='"+data[i].id+"'>"+data[i].name+"</option>";

									}
									$("select[name='s_accomodation_type_id']").html(output);
							},
							"json"
					);
				});

				$("select[name='s_accomodation_type_id']").change(function(){
					var selText = $("select[name='s_accomodation_type_id'] option:selected").text();
					$(this).parent().find('span').html(selText);
				});

				$("select[name='s_transport_id']").change(function(){
					var selText = $("select[name='s_transport_id'] option:selected").text();
					$(this).parent().find('span').html(selText);
				});
				
				$("input[name='search']").click(function(){
					var allOk = true;

					$(".req").each(function(){

						if($(this).val() <= 0){
							allOk = false;
							$(this).addClass('required');
						}else $(this).removeClass('required');
					});

					if(!allOk) return false;
				});
			});
		</script>
		<div class="banner_box">
			<div class="banner cufon">
				<div class="banner_img"><img src="<?php echo IMAGE_PATH.'banner-primer.png'; ?>" alt=""/></div>
				<div class="banner_mask"><a href="<?php echo BASE_PATH.'rent-a-car'.DS; ?>">saznaj vise</a></div>
			</div>
			<div class="banner cufon">
				<div class="banner_img"><img src="<?php echo IMAGE_PATH.'banner_koncerti.png'; ?>" alt=""/></div>
				<div class="banner_mask"><a href="<?php echo BASE_PATH.'dogadjaji'.DS; ?>">saznaj vise</a></div>
			</div>
			<div class="banner cufon">
				<div class="banner_img"><img src="<?php echo IMAGE_PATH.'banner-opstiUslovi.png'; ?>" alt=""/></div>
				<div class="banner_mask"><a href="<?php echo BASE_PATH.'uslovi'.DS; ?>">saznaj vise</a></div>
			</div>		
	  	</div>
</div>