<div class="content">
	<div class="page_content">
		<?php if(isset($other) && !empty($other)):?>
		<?php foreach($other as $cb):?>
		<div class="page_box">	
			<div class="page_title_bg">
				<div class="page_title_text cufon"><?php echo $cb['name']; ?></div>
			</div>
			<?php if(isset($cb['acc']) && !empty($cb['acc'])):?>
			<?php $count = 0; ?>
			<?php foreach($cb['acc'] as $info):?>
			<div class="info_box" <?php echo ($count%2==0?"style='clear:both'":"");?>>
				<div class="info_box_bg">					
					<div class="info_img">
						<img src="<?php echo FILE_PATH.'accomodation_type'.DS.'resized'.DS.$info['id'].'-'.$info['image']; ?>" alt="<?php echo $info['name']; ?>"/>
					</div>
					<div class="info_mask cufon">
						<a href="<?php echo BASE_PATH.'zanimljivo'.DS.$info['link_name'].DS; ?>">
							saznaj vi�e
						</a>
					</div>
					<div class="info_title cufon"><?php echo $info['name']; ?></div>
					<div class="info_price cufon"><?php echo $info['from']; ?></div>
				</div>	
				<div class="info_note_bg">
					<div class="info_note"><?php echo $info['start']; ?></div>
				</div>
			</div>
			<?php $count++; ?>
			<?php endforeach; ?>
			<?php if($count%2 != 0):?>
			<div class="emptyBox"><!-- empty box --></div>
			<?php endif;?>
			
			<?php else:?>
			<div class="noResults">Trenutno ne postoje podaci za izabranu destinaciju</div>
			<?php endif;?>
		</div>
		<?php endforeach;?>
		<?php else:?>
		<div class="noResults">Trenutno ne postoje uneti podaci za tra�eni kriterijum</div>
		<?php endif;?>
	
	</div>
</div>
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>