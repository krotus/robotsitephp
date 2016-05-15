<form role="form" action="" method="POST">
	<div class="form-group">
		<label for="worker_username">Username:</label>
		<input type="text" class="form-control" name="worker_username" id="worker_username">
	</div>
	<div class="form-group">
		<label for="worker_password">Password:</label>
		<input type="password" class="form-control" name="worker_password" id="worker_password">
	</div>
	<div class="form-group">
		<label for="worker_re_password">Re-Password:</label>
		<input type="password" class="form-control" name="worker_re_password" id="worker_re_password">
	</div>
	<div class="form-group">
		<label for="worker_nif">NIF:</label>
		<input type="text" class="form-control" name="worker_nif" id="worker_nif">
	</div>
	<div class="form-group">
		<label for="worker_name">Name:</label>
		<input type="text" class="form-control" name="worker_name" id="worker_name">
	</div>
	<div class="form-group">
		<label for="worker_surname">Surname:</label>
		<input type="text" class="form-control" name="worker_surname" id="worker_surname">
	</div>
	<div class="form-group">
		<label for="worker_telephone">Telephone:</label>
		<input type="text" class="form-control" name="worker_telephone" id="worker_telephone">
	</div>
	<div class="form-group">
		<label for="worker_category">Category:</label>
		<input type="text" class="form-control" name="worker_category" id="worker_category">
	</div>
    <div class="form-group">
    <?php 
    	App\Utility\QuickForm::createSelect("worker_team", "name", $data['teams']);
     ?>
    </div>
	<div class="form-group">
		<label for="worker_is_admin">Is Admin:</label>
		<label class="radio-inline"><input type="radio" name="worker_is_admin">Yes</label>
		<label class="radio-inline"><input type="radio" name="worker_is_admin">No</label>
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?php 
if(isset($data)){
	if (array_key_exists("error", $data)) {
		echo '<div class="alert alert-danger" role="alert"><ul>';
		foreach ($data["error"] as $key => $error) {
			echo "<li>".$error."</li>";
		}
		echo '</ul></div>';
	}	
}
?>