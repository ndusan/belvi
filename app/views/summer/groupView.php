<div class="details_content">
	<div class="offer_page_title_bg">
		<div class="page_title_text cufon"><?php echo $accType['acc_type']['name']; ?></div>
	</div>
	<div class="details_page_carusel">
		<!-- Include carousel -->
		<?php include_once VIEW_PATH.'home'.DS.'_customCarousel.php';?>	
	</div>
	
	<div class="fb"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>&amp;layout=standard&amp;show_faces=false&amp;width=430&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=45" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:430px; height:45px;" allowTransparency="true"></iframe></div>
	
	<div style="clear:both"></div>
	
	<div class="currPart">
	<?php echo $accType['acc_type']['desc']; ?>
	</div>
	
	<div class="tabelar">
		<?php if(isset($accType) && !empty($accType)):?>
		<table cellspacing="1px" width="100%">
			<thead>
              	<tr>
				    <th scope="col" width="170px">TIP SMEŠTAJA</th>
				    <th scope="col">Kat.</th>
				    <th scope="col">USLUGA</th>
				    <?php foreach($accType['dates'] as $d):?>
				    <th scope="col">
						<?php
							$array = explode("-", $d['date']);
							echo strtoupper($html->toSerbian(date("M", mktime(0, 0, 0, $array[1], $array[0], $array[2])))) . "<br/>" .$array[0];
						?>
					</th>
				   	<?php endforeach;?>
				</tr>
				<tr>
				  	<th colspan="3" scope="col" class="nights">broj noćenja &raquo;</th>
				  	<?php foreach($accType['dates'] as $d):?>
				    <th scope="col" class="nights_num"><?php echo $d['nights']; ?></th>
					<?php endforeach;?>
  				</tr>
  				<?php if(isset($accType['prices']) && !empty($accType['prices'])):?>
  				<?php foreach($accType['prices'] as $p):?> 
  				<tr>
				    <td colspan="3" scope="col"><?php echo $p['transport'];?></td>
				    <td scope="col" colspan="<?php echo count($accType['dates']);?>"><?php echo $p['price']; ?></td>
				 </tr>
				 <?php endforeach;?>
				 <?php endif; ?>
            </thead>
            <?php if(isset($accom) && !empty($accom)):?>
            <tbody><?php 
            			$basicName = "";
            		  	$firstLetter = "";
            		  	foreach($accom['acc'] as $ac):
            		  	
	            		  	if($basicName != $ac['type']):
	            		  		$basicName = $ac['type'];
	            		  		$firstLetter = substr($ac['type'], 0, 1);?>
            	<tr>
    				<th colspan="<?php echo 3 + count($accType['dates']); ?>" scope="col"><?php echo strtoupper($ac['type']); ?></th>
 			   </tr>
	 			<?php  		endif;
 			   		 
 			   		 		if(isset($ac['service']) && !empty($ac['service'])):
	 			   		 		$first = true;
	 			   		 		$cnt=0;
	 			  		 		foreach(($ac['service']) as $a):?>
			   <tr class="<?php echo (++$cnt%2==0?'lite':'dark');?>">
				<?php 				if($first):$first = false;?>
			    <td rowspan="<?php echo count($ac['service']); ?>" scope="row">
			    	<a href="<?php echo BASE_PATH.'letovanja'.DS.$params['group'].DS.$ac['link_name'].DS; ?>" class="tooltip" title="<?php echo $ac['type_desc']; ?>">
			    		<?php echo strtoupper($ac['name']); ?><br />
			    		<?php echo $ac['add']; ?>
			    	</a>
			    </td>
			    
			    <td rowspan="<?php echo count($ac['service']); ?>" scope="row"><?php echo $ac['cat']; ?></td>
			    <?php 				endif;?>
			    <td class="al"><strong><?php echo $a['service']; ?></strong></td>
			    <?php foreach($a['price'] as $price):?>
			    <td><?php echo $price['price']; ?></td>
			    <?php endforeach;?>
		      </tr>
		      <?php				endforeach;
		      
 			   		 		endif;
            		  endforeach;?>
            </tbody>
            <?php endif; ?>
		</table>
		<?php else: ?>
		<div class="noResults" style="width: 98%;">
			Trenutno ne postoji cenovnik za izabrani tip aranžmana
		</div>
		<?php endif;?>
	</div>
	<?php if(isset($accType['acc_type']['desc_bottom']) && !empty($accType['acc_type']['desc_bottom'])):?>
	<div class="currPart_bottom">
	<?php echo $accType['acc_type']['desc_bottom']; ?>
	</div>
	<?php endif; ?>
	
	<!-- Check if PDF File set -->
	<?php if(isset($accType['acc_type']['pdf']) && !empty($accType['acc_type']['pdf'])):?>
	
	<!-- PDF file -->
	<div class="pdf_holder">
		<div class="pdf">
			<a target="_blank" href="<?php echo FILE_PATH.'accomodation_type'.DS.'original'.DS.$accType['acc_type']['id']."-".$accType['acc_type']['pdf'];?>">Cenovnik za štampu</a>
		</div>
	</div>
	<?php endif;?>
	
	<div class="boxHolder">
		<div class="tabs">
			 <ul>
	            <li><a href="javascript:;" class="tab active" id="link-desc" rel="<?php echo $params['group']; ?>">Program putovanja i uslovi</a></li>
	            <li><a href="javascript:;" class="tab" id="link-conditions" rel="<?php echo $params['group']; ?>">Opis</a></li>
	         </ul>
		</div>
		<div class="tabContent"><!-- load content --></div>
	</div>
	<script type="text/javascript">
        $(document).ready(function(){
        	//Load by default
			$(".tabContent").addClass('loader');
			$.get(	'<?php echo BASE_PATH.'ajax_get_tab_page'; ?>',
					{'tab'	:	'link-desc',
					 'name'	:	'<?php echo $params['group']; ?>'
					},
					function(data){
						if(data){
							$(".tabContent").removeClass('loader').html(data);
						}
					},
					"html"
			);
            
			$(".tab").each(function(){
				$(this).click(function(){
					var id = $(this).attr('id');
					//Hide all tabs
					$(".tab").each(function(){
						if($(this).attr('id') != id) $(this).removeClass('active');
						else{
							$(this).addClass('active');
							$(".tabContent").addClass('loader').html('');
							//Ajax call for page
							$.get(	'<?php echo BASE_PATH.'ajax_get_tab_page'; ?>',
									{'tab'	:	$(this).attr('id'),
									 'name'	:	$(this).attr('rel')
									},
									function(data){
										if(data){
											$(".tabContent").removeClass('loader').html(data);
										}
									},
									"html"
							);
						}
					});
				});
			});
        });
	</script>
</div>
