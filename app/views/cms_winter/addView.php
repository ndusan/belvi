<form name="form" enctype="multipart/form-data" action="<?php echo BASE_PATH.'cms'.DS.'winter'.DS.'submit'.DS; ?>" method="post">
	<div class="entry">
		<h2>Dodaj novo zimovanje</h2>
		<?php include_once '_stepMenu.php';?>
		<?php 
		//Set per step
		if(isset($params['step']) && !empty($params['step']))
			if(file_exists(VIEW_PATH.'cms_summer'.DS.'_form'.ucfirst($params['step']).'Step.php'))
				include_once VIEW_PATH.'cms_summer'.DS.'_form'.ucfirst($params['step']).'Step.php';
			else include_once VIEW_PATH.'cms_summer'.DS.'_formFirstStep.php';
		else include_once VIEW_PATH.'cms_summer'.DS.'_formFirstStep.php';
		 ?>
	</div>
	<input type="hidden" name="id" value="<?php echo (isset($params['id'])?$params['id']:""); ?>" />
</form>