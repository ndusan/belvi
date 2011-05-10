<div class="steps">
	<?php
		if(isset($params['step']) && !empty($params['step']))
			switch(strtolower($params['step'])){
				case 'first': default:
					$step1 = "active";
					$step2 = "inactive";
					$step3 = "inactive";
				break;
				case 'second':
					$step1 = "done";
					$step2 = "active";
					$step3 = "inactive";
				break;
				case 'third':
					$step1 = "done";
					$step2 = "done";
					$step3 = "active";
				break;
			}
		else{
			$step1 = "active";
			$step2 = "inactive";
			$step3 = "inactive";
		}
	?>
	<div class="step <?php echo $step1; ?>">	
			Prvi korak
	</div>
	<div class="step <?php echo $step2; ?>">
			Drugi korak
	</div>
	<div class="step <?php echo $step3; ?>">
			Treći korak
	</div>
	<div class="line"></div>
	
</div>