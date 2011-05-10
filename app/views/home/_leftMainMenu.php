<div class="nav">
	<?php if(isset($leftNav) && !empty($leftNav)):?>
	<?php foreach($leftNav as $ln):?>
    <div class="nav_title_bg">
    	<div class="nav_title_text cufon"><?php echo $ln['name']; ?></div>
    	<?php if(isset($ln['image']) && !empty($ln['image'])):?>
    	<div class="nav_flag"><img src="<?php echo FILE_PATH.'destinations'.DS.'resized'.DS.$ln['id'].'-'.$ln['image'];?>" alt="<?php echo $ln['image']; ?>"/></div>
    	<?php endif;?>
    </div>
    <?php if(isset($ln['sub_nav']) && !empty($ln['sub_nav'])):?>
    <div class="nav_links">
    	<ul>
    		<?php foreach($ln['sub_nav'] as $sn):?>
    		<li>
    			<?php 
    			switch($sn['accomodation']){
    				case 'summer': $l = 'letovanja'; break;
    				case 'winter': $l = 'zimovanja'; break;
    				case 'city_break': $l = 'evropski-gradovi'; break;
    				case 'other': default: $l = 'specijalno'; break;
    			}
    			?>
    			<a href="<?php echo BASE_PATH.$l.DS.$sn['link_name'].DS;?>" >
    				<?php echo $sn['name']; ?>
    			</a>
    		</li>
    		<?php endforeach; ?>
    	</ul>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
</div>