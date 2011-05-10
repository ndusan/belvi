<div class="page_box_contact">
	<div class="page_title_bg">
		<div class="page_title_text cufon">Prijava za zaposlenje</div></div>
			<div class="zaposlenje_text_box">
				<div class="zaposlenje_text">
				Poštovani posetioci,<br /><br />

				Agencija Belvi Travel je u stalnoj potrazi za novim, kvalitetnim kadrom. Ukoliko želite da radite u našoj firmi kao šalterski službenik na prodaji aranžmana ili da budete deo našeg kreativnog tima komercijalista, popunite ovaj upitnik. 
				</div>
				<form action="<?php echo BASE_PATH.'zaposlenje'.DS.'submit'.DS; ?>" method="post" enctype="multipart/form-data">
				<div class="zaposlenje_table">
					<table border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
						    	<td style="width: 40%;">Ime i prezime <span class="zvezdica">(*)</span> :</td>
					      		<td style="width: 60%;">
					    			<input type="text" name="candidat" value="" class="bigInput r" />
						    	</td>
					  		</tr>
						  	<tr>
						    	<td>Konkurišem za radno mesto <span class="zvezdica">(*)</span> :</td>
						    	<td>
						    		<?php if(isset($pos) && !empty($pos)):?>
									<div class="masked_styled">
						    	 		<span><?php echo $pos[0]['name'];?></span>
								    	<select name="position">
								    		<?php foreach($pos as $p):?>
											<option value="<?php echo $p['name'];?>"><?php echo $p['name'];?></option>
											<?php endforeach;?>
										</select>
							    	</div>
							    	<?php else:?>
							    	<b>Trenutno nemamo otvorenih pozicija</b>
							    	<?php endif;?>
								</td>
							</tr>
						  	<tr>
						    	<td>Stručna sprema <span class="zvezdica">(*)</span> :</td>
						    	<td>
									<div class="masked_styled">
								    	<span>Srednja</span>
								    	<select name="level">
											<option value="Srednja">Srednja</option>
											<option value="Viša">Viša</option>
											<option value="Višoka">Višoka</option>
										</select>
						    		</div>
								</td>
						  	</tr>
						  	<tr>
						    	<td>Godište <span class="zvezdica">(*)</span> :</td>
						    	<td>
						    		<input type="text" name="born" value="" class="smallInput r"/>
						    	</td>
						  	</tr>
						  	<tr>
						    	<td>Profesija:</td>
						    	<td>
						    		<input type="text" name="profession" value="" class="bigInput"/>
						    	</td>
						  	</tr>
						  	<tr>
						    	<td>Godina sticanja stručne spreme:</td>
						    	<td>
						    		<input type="text" name="year" value="" class="smallInput"/>
						    	</td>
						  	</tr>
						  	<tr>
						    	<td style="vertical-align: top; ">Da li imate radnog iskustva u traženom poslu, i ako imate navedite kakva, u kojim firmama i na kojim pozicijama:</td>
						    	<td>
									<textarea rows="" cols="" name="expirience" class="bigInputTextarea"></textarea>
								</td>
						  	</tr>
						  	<tr>
						    	<td style="vertical-align: top; ">Koji su vaši razlozi zbog kojih želite da radite u Belvi-Travel-u?</td>
						    	<td>
									<textarea rows="" cols="" name="reason" class="bigInputTextarea"></textarea>
								</td>
						  	</tr>
						  	<tr>
						    	<td style="vertical-align: top; ">Navedite vaše posebne kvalitete:</td>
						    	<td>
									<textarea rows="" cols="" name="features" class="bigInputTextarea"></textarea>
								</td>
						  	</tr>
						  	<tr>
						    	<td>El.adresa <span class="zvezdica">(*)</span> :</td>
						    	<td>
									<input type="text" name="email" value="" class="mediumInput r"/>
								</td>
						  	</tr>
						  	<tr>
						    	<td>Kontakt telefon <span class="zvezdica">(*)</span> :</td>
						    	<td>
									<input type="text" name="telephone" value="" class="mediumInput r"/>
								</td>
						  	</tr>
						  	<tr>
							    <td></td>
								<td>
									<input type="submit" name="button" value="Pošalji" class="styled_submit"/>
									<input type="reset" name="restart" value="Obriši" class="styled_reset"/>
								</td>
						  	</tr>
						</tbody>
					</table>
				
			  	</div>
			  	</form>
				<div style="clear: both;"></div>
				<br/>
				<div class="zaposlenje_text">
				<strong>Napomena:</strong>  Uneseni podaci predstavljaju strogo poslovnu tajnu i kao takvi nece biti prikazivani trecim licima i nece se koristiti u druge svrhe. Slanjem prijave potvrdjujete verodostojnost unesenih podataka. Nepotpune prijave se neće razmatrati.
				<br/><br/>
				<span class="zvezdica">(*)</span>  polja koja su obavezna
				</div> 
				
			</div>
			
	
</div>	
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>