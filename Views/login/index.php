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
            <input type="text" class="form-control" name="login-user" placeholder="Usuario" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>">
            <input type="password" class="form-control" name="login-password" placeholder="Contraseña" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : '';?>">
            <div class="material-switch pull-left">
                <input id="remember-me" name="remember-me" type="checkbox" <?php echo isset($_COOKIE['password']) ? 'checked' : '';?>/>
                <label for="remember-me" class="label-primary"><span>Remember Me</span></label>
            </div>
            <input type="submit" class="col-xs-5 btn btn-primary pull-right" value="Entrar" name="entrar">
        </form>
    </div>
</div>
<div class="col-md-4 hidden-xs">
</div>