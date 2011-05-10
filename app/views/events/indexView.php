<div class="page_box_contact">
	<div class="page_title_bg">
		<div class="page_title_text cufon">Live in Europe - Koncerti</div></div>
			<?php if(isset($event) && !empty($event)):?>
			<div class="event_text_box">
				
				<div class="event_box_bg">					
					<div class="event_img">
						<img alt="<?php echo $event['name'];?>" src="<?php echo FILE_PATH.'events'.DS.'resized'.DS.$event['id'].'-'.$event['image']; ?>" />
					</div>
					<div class="event_mask cufon">
						<a href="<?php echo FILE_PATH.'events'.DS.'original'.DS.$event['id'].'-pdf-'.$event['pdf']; ?>" target="_blank">saznaj više</a>
					</div>
					<div class="event_title cufon"><?php echo $event['name'];?></div>
					<div class="event_price cufon"><?php echo $event['price'];?>€</div>
					<div class="event_text"><?php echo $event['place'];?></div>
				</div>		
			</div>
			<div class="event_note_bg">
					<div class="event_note"><?php echo $event['date']; ?></div>
			</div>
			<div class="event_description">
				<?php echo $event['desc'];?>
			</div>
			
			
			<div class="event_title_others">
			Ostali aktuelni događaji
			</div>
			<div class="event_page_carusel">		
				<!-- Include carousel -->
				<?php include_once VIEW_PATH.'home'.DS.'_customCarousel.php';?>	
			</div>
			<?php else:?>
			<div class="noResults">Trentutno ne postoji aktuelni događaj</div>
			<?php endif;?>
</div>	
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>