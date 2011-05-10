<div class="rentacar_content">
	<div class="page_title_bg">
		<div class="page_title_text cufon">Rent-a-car</div>
	</div>
	<?php if(isset($cars) && !empty($cars)):?>
	<?php foreach($cars as $car):?>
	<div class="rentacar_carImage"><img src="<?php echo FILE_PATH.'rent_a_car'.DS.'resized'.DS.$car['id'].'-'.$car['image']; ?>" alt=""/></div>
	<div class="rentacar_carInfo">
		<div class="arrow"><img src="<?php echo IMAGE_PATH.'arrow.png'; ?>" alt=""/></div>
		<div class="rentacar_title cufon">
			<?php echo $car['type']; ?>
		</div>
		
		<div class="rentacar_list">	
			<?php echo $car['desc']; ?>
		</div>
	</div>
	<?php if(isset($car['additional']) && !empty($car['additional'])):?>
	<div class="rentacar_table">
			<table width="100%" cellspacing="1" cellpadding="1">
              <tbody>
              	  <tr>
					<?php foreach($car['additional'] as $p):?>
	                <td><div align="center"><?php echo $p['period']; ?></div></td>
	              <?php endforeach;?>
	              </tr>
	              <?php $count = 0;?>
				  <tr>
	              <?php foreach($car['additional'] as $p):?>
	              <?php $count++; ?>
	                <td><div align="center"><?php echo $p['price']; ?> €</div></td>
	              <?php endforeach;?>
				  </tr>
              </tbody>
              <thead>
	              <tr>
	                <th colspan="<?php echo $count; ?>" scope="col">
	                	<div align="center">Broj dana / Numbers of days</div>
	                </th>
	              </tr>
              </thead>
            </table>
	</div>
	<?php endif; ?>
	<?php endforeach;?>
	<?php else:?>
	<div class="noResults">Trenutno nemamo nijedan automobil na raspolaganju</div>
	<?php endif; ?>
	
	<br/>

		<div class="rentacar_text_bold">*POSEBNI USLOVI ZA VIŠEMESEČNO RENTIRANJE POJEDINCIMA I FIRMAMA</div>
		<div class="rentacar_text">
			PDV je uključen u cenu / All prices include 18% VAT.<br />
			DOSTAVA PRE 8h ILI 21h, NEDELJOM I PRAZNICIMA SE NAPLAĆUJE 10 € <br /> 
			CAR DELIVERS BEFORE 8h OR 21h, ON SUNDAY AND HOLIDAYS IS CHARGED 10 €<br />
			SVE CENE SE PRERACUNAVAJU U DINARE PO ZVANIČNOM PRODAJNOM KURSU<br />
			ALL RATES WILL BE CONVERTED IN DINARS<br /><br /><br />
			Vozacka dozvola mora biti stara najmanje 2 godine
			Vozaceva starost iznad 23 godina<br />
			Depozit: predvidjeni iznos najma + 20%<br />
			Gornje ne vazi za imaoce kreditnih kartica: Dina, Master card, Visa, Maestro<br />
			Cena ukljucuje: dnevni najam sa 100km, osiguranje u slucaju nezgode(CPW), osiguranje u slucaju kradje vozila (T.P.), PDV<br />  
			Cena ne ukljucuje: osiguranje putnika (P.A.I), gorivo<br />
			Korisnik je duzan kod vracanja vozila da vrati pun rezervar goriva, inace naplacujemo razliku od 10,00 EUR za punjenje goriva<br />
			Minimalni najam je 1 dan (24 casa)<br />
			Dodatni sat je 1/3 dnevnog najma<br />
			Za gubljenje dokumenata ili kljuceva zaracunavamo 250,00 €<br /><br /><br />
			
			You have had a full driving licence for at least 2 years (2 x 365 days).<br />
			You are at least 23<br />
			Payment in advance : calculated rental amount + 20%<br />
			Upper not applicable to credit card holders: Dina, Master Card,Visa, Maestro<br />
			The charge we quote you includes: basic rental, any discounts, basic insurance<br />(3rd party insurance, theft protection and damage waiver-CDW and T.P.) and VAT.<br />
			Charge does not include :personal accident insurance (PAI), fuel<br />
			Car is delivered and must be returned by renter with full tank of fuel, else  10,00 EUR will be charged<br />
			You need to rent for at least one day. If daily rate is exceeded by more then 1 hour an additional  third of a day will be charged<br />
			Car key or document lost is charged by 250,00 €
					
		
		
		
		
		</div>

</div>
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>