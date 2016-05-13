<?php 
if(isset($data)){
	if (array_key_exists("alert", $data)) {
		echo '<div class="alert alert-danger" role="alert">' . $trans[$data["alert"]] . '</div>';
	}	
}
?>
<div class="col-md-4 hidden-xs">
</div>
<div class="form-block col-md-4 col-xs-12 panel panel-primary">
    <div class="panel-body">
        <h2><?php echo $trans["sign_in"] ?></h2>
        <form method="post" action="">
            <input type="text" class="form-control" name="login-user" placeholder="Usuario">
            <input type="password" class="form-control" name="login-password" placeholder="Contraseña">
            <input type="submit" class="btn btn-primary form-control" value="Entrar" name="entrar">
        </form>
    </div>
</div>
<div class="col-md-4 hidden-xs">
</div>