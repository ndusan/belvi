<form name="form" action="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.'submit'.DS; ?>" method="post">
	
	<input type="hidden" name="id" value="<?php echo $contact['id']; ?>" />
	<div class="entry">
		<h2>Izmeni postojecu lokaciju</h2>
		<?php include_once '_form.php';?>
	</div>
</form>