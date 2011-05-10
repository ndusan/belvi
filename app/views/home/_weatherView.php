<div class="details_div_content">
	<?php 
		$output = HTML::getWeather($content['info']);
		if($output) echo $output;
		else "Vremenska prognoza trenutno nije dostupna!";
	?>
</div>