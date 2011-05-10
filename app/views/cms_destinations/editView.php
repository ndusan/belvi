<form name="form" enctype="multipart/form-data" action="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.'submit'.DS.$params['id'].DS; ?>" method="post">
	<div class="entry">
		<h2>Izmeni postojeću destinaciju</h2>	
		<?php include_once '_form.php'; ?>
	</div>
</form>