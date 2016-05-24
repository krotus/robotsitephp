<?php 
if(isset($data)){
	if (array_key_exists("alert", $data)) {
		echo '<div class="alert alert-danger" role="alert">' . $data["alert"] . '</div>';
	}	
}
?>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>ARM</b>duino</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar sessión</p>

        <form method="post" action="">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="login-user" placeholder="Usuario" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="login-password" placeholder="Contraseña" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : '';?>">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="material-switch pull-left">
                        <input id="remember-me" name="remember-me" type="checkbox" <?php echo isset($_COOKIE['password']) ? 'checked' : '';?>/>
                        <label for="remember-me" class="label-primary"><span>Recordar</span></label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->