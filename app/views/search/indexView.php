<div class="content">
	<div class="page_content">
		<div class="page_box">	
			<?php if(isset($res) && !empty($res)):?>
			<div class="page_title_bg">
				<?php //print_r($res);?>
				<div class="page_title_text cufon">Rezultati pretrage</div></div>
				<?php foreach($res as $r):?>
				<div class="search_rezults">
					<div class="search_textHolder">
						<!-- Accomodation type -->
						<div class="search_hotelName"><?php echo $r['accmodation_type']; ?></div>
						
						<!-- Accomodation -->
						<div class="search_location cufon"><a href="<?php echo BASE_PATH.$l.DS.$r['accomodation_type_link'].DS.$r['link_name']; ?>"><?php echo $r['name']; ?></a></div>
						
						
						
						<?php 
						switch($r['accomodation']){
							case 'summer': $l = 'letovanja'; break;
		    				case 'winter': $l = 'zimovanja'; break;
		    				case 'city_break': $l = 'city-break'; break;
		    				case 'other': default: $l = 'specijalno'; break;
						}
						?>
						<!-- Description -->
						<div class="search_description"><?php echo $r['add'];?></div>
						</div>
				</div>
				<?php endforeach;?>
			
			<?php else:?>
			<div style="clear: both;"></div>
			<div class="noResults">
				Za traženi kriterijum ne postoje rezultati pretrage
			</div>
			<?php endif;?>
		</div>
	</div>
</div>
<!-- Loading address box -->
<?php include_once VIEW_PATH.'home'.DS.'_addressBox.php';?>