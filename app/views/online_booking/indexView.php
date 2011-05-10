<div class="page_box_contact">
	<div class="page_title_bg">
		<div class="page_title_text cufon">On-line booking</div>			
	</div>
	<div class="onlinebooking_box">
		<form action="<?php echo BASE_PATH.'rezervacije'.DS.'submit'.DS; ?>" method="post">
		<div class="onlinebooking_subtitle">Osnovne informacije</div>
		<div class="onlinebooking_basic">
			<!-- Parent table -->
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td colspan="2" style="padding: 0 0 10px 0;">
							<strong>Informacije o odraslim putnicima:</strong>
						</td>
					</tr>
					<tr>
						<td style="width: 250px;">
							<label>Ime i prezime <strong>(*)</strong>:</label>
							<input name="parent[name][]" value="" class="mediumInput r" />
						</td>
						<td>
							<label>Datum rođenja <strong>(*)</strong>:</label>
							<input name="parent[birth_date][]" value="" class="smallInput r fl" />
							<span class="calendar"></span>
						</td>
						<td><!-- empty --></td>
					</tr>
					<tr>
						<td>
							<a href="javascript:;" id="add_parent" class="addParent"><!-- add parent --></a>
							<span style="float:left; margin: 15px 0px 0px 0px;">Dodaj putnika</span>
							<input type="hidden" value="1" id="parent_num" />
						</td>
						<td colspan="2"><!-- empty --></td>
					</tr>
				</tbody>
			</table>
		
			<br/>
		
			<!-- Child table -->
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td colspan="2" style="padding: 0 0 10px 0;">
							<strong>Informacije o deci:</strong>
						</td>
					</tr>
					<tr>
						<td style="width: 250px;">
							<a href="javascript:;" id="add_child" class="addParent"><!-- add child --></a>
							<span style="float:left; margin: 15px 0px 0px 0px;">Dodaj dete</span>
							<input type="hidden" value="0" id="child_num" />
						</td>
						<td colspan="2"><!-- empty --></td>
					</tr>
				</tbody>
			</table>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					$(".datepicker").datepicker();
				});
			</script>
			
			<br/>
			
			<!-- Period & other -->
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td colspan="2" style="padding: 0 0 10px 0;">
							<strong>Informacije o putovanju:</strong>
						</td>
					</tr>
					<tr>
						<td style="width: 250px;">
							<label>Period putovanja od <strong>(*)</strong>:</label>
							<input type="text" value="" name="date_from" class="datepicker r smallInput fl" />
							<span class="calendar"></span>
						</td>
						<td>
							<label>do <strong>(*)</strong>:</label>
							<input type="text" value="" name="date_to" class="datepicker r smallInput fl" />
							<span class="calendar"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Destinacija <strong>(*)</strong>:</label>
							<input type="hidden" name="destination" value="" />
						<div class="masked_styled150">
						<span>- - - - - - - - -</span>
							<select name="destination_id">
								<option value="0">- - - - - - - - -</option>
								<?php if(isset($at) && !empty($at)):?>
								<?php foreach($at as $d):?>
								<option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
								<?php endforeach; ?>
								<?php endif;?>
							</select>
							
						</div>	
						<script type="text/javascript">
							$(document).ready(function(){
								$("select[name='destination_id']").change(function(){
									var selText = $("select[name='destination_id'] option:selected").text();

									$(this).parent().find('span').html(selText);
									$("input[name='destination']").val(selText);
									
									$("select[name='accomodation']").parent().find('span').html("- - - - - - - - -");
									$.get(	'<?php echo BASE_PATH.'rezervacije'.DS.'ajax-get-hotels'.DS; ?>',
											{	'id' 	: $(this).val()},
											function(data){
												var output = "<option value='0'>- - - - - - - - -</option>";
												if(data){
													
													for(i=0; i<data.length; i++) 
														output += "<option value='"+data[i].name+"'>"+data[i].name+"</option>";

												}
												$("select[name='accomodation']").html(output);
											},
											"json"
									);
								});

								//On change
								$("select[name='accomodation']").change(function(){
									var selText = $("select[name='accomodation'] option:selected").text();
									$(this).parent().find('span').html(selText);
								});
							});
						</script>
						</td>
						<td>
							<label>Hotel/apartman <strong>(*)</strong>:</label>
							<div class="masked_styled150">
							<span>- - - - - - - - -</span>
							<select name="accomodation" class="mediumInput">
								<option value="0">- - - - - - - - -</option>
								<option value="">- - - - - - - - -</option>
								<option value="">- - - - - - - - -</option>
							</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="onlinebooking_subtitle"><br />Prevozno sredstvo</div>
		<div class="onlinebooking_basic">
		
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
				<tr>
					<td style="width: 33%;">
					    <div class="fl">
					    	<input type="radio" name="transport" value="autobus" checked="checked"/>
					    </div>
					    <div class="fl">
					    	<span class="bus_ico"></span>
					  		<label>autobus</label>
					    </div>
				    </td>
					<td style="width: 33%;">
						<div class="fl">
					    	<input type="radio" name="transport" value="avion"/>
					    </div>
					    <div class="fl">
							<span class="plane_ico"></span>
							<label>avion</label>
						</div>
					</td>
					<td style="width: 33%;">
						<div class="fl">
					    	<input type="radio" name="transport" value="automobil"/>
					    </div>
					    <div class="fl">
							<span class="car_ico"></span>
							<label>sopstveni prevoz</label>
						</div>
					</td>		
				</tr>
			</tbody>
			</table>
		</div>
		<div class="onlinebooking_subtitle">Način plaćanja</div>
		<div class="onlinebooking_basic">
		
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td style="width: 33%;">
							<div class="fl">
						    	<input type="radio" name="payment_method" value="gotovina" checked="checked"/>
					     	</div>
					     	<div class="fl">
					     		<span class="kes_ico"></span>
						  		<label>gotovina</label>
						  	</div>
					    </td>
						<td style="width: 33%;">
							<div class="fl">
						    	<input type="radio" name="payment_method" value="čekovi"/>
					     	</div>
					     	<div class="fl">
					     		<span class="cek_ico"></span>
						  		<label>čekovi</label>
						  	</div>
						</td>
						<td style="width: 33%;">
							<div class="fl">
						    	<input type="radio" name="payment_method" value="kreditna kartica"/>
					     	</div>
					     	<div class="fl">
					     		<span class="card_ico"></span>
						  		<label>kreditna kartica</label>
						  	</div>
						</td>		
					</tr>
				</tbody>
			</table>
		</div>	
		<div class="onlinebooking_subtitle">Vaše kontakt informacije</div>
		<div class="onlinebooking_basic">
		<table border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td>
							<label>Adresa <strong>(*)</strong>:</label>
							<input name="address" value="" class="mediumInput r" />
						</td>
						<td>
							<label>Mesto <strong>(*)</strong>:</label>
							<input name="city" value="" class="mediumInput r" />
						</td>
						
					</tr>
					<tr>
						<td>
							<label>Kontakt telefon <strong>(*)</strong>:</label>
							<input name="telephone" value="" class="mediumInput r" />
						</td>
						<td>
							<label>E-mail <strong>(*)</strong>:</label>
							<input name="email" value="" class="mediumInput r" />
						</td>
						
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<label>Napomena:</label>
							<textarea rows="" cols="" name="reason" class="bigInputTextarea"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<br/>
							<input type="submit" name="button" value="Pošalji" class="styled_submit"/>
							<input type="reset" name="restart" value="Obriši" class="styled_reset"/>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		</form>
	</div>
	
</div>	
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>