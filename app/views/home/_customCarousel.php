<?php echo $html->js('jquery.jcarousel.min');?>
<?php echo $html->css('skin');?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mycarousel').jcarousel({
					wrap: 'circular',
			    	auto: 10,
			    	scroll: 1
		});
	});
</script>
<?php echo $html->carousel($carouselImage, $carouselFolder, $carouselAction, $carouselPage); ?>