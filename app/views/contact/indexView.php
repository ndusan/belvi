<div class="page_box_contact">
	<div class="page_title_bg">
		<div class="page_title_text cufon">Kontakt</div></div>	
		<div class="contact_box_border">
			<?php if(isset($locations) && !empty($locations)):?>
			<?php foreach($locations as $l): ?>
			<div class="contact_box">
				<div class="contact_info">
					<div class="contact_text">	
						<div class="contact_text_title">
							<?php echo $l['location']; ?>
						</div>
						<div class="contact_text_info">
							<?php echo $l['address']; ?>		
						</div>
					</div>
					<div class="contact_map">
						<?php echo $l['map']; ?>
					</div>
				</div>
				<div class="dots"></div>
			</div>	
			<?php endforeach; ?>
			<?php else: ?>
				<div style="padding: 10px; font-size: 12px;font-family: Arial;">
					Trenutno ne postoje unete lokacije
				</div>
			<?php endif; ?>
		</div>	
	
</div>
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>