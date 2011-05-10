<form name="form" enctype="multipart/form-data" action="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.'submit'.DS; ?>" method="post">
	<input type="hidden" name="id" value="<?php echo $params['id']; ?>" />
	<div class="entry">
		<h2>Izmeni postojeću reklamu</h2>
		<?php include_once '_form.php';?>
	</div>
</form>