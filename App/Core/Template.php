<?php 

namespace App\Core;

use App\Core\View as View;
use App\Core\Session as Session;

class Template{
	public function __construct(){
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Admin Robotsite</title>
	<link rel="stylesheet" href="<?php echo URL; ?>Libs/bootstrap/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="<?php echo URL; ?>Views/template/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="<?php echo URL; ?>Libs/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>Views/template/css/login.css">
    <script type="text/javascript" src="<?php echo URL; ?>Libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>Libs/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	}

	public function __destruct(){
?>
<?php 
	if(!empty($_GET)){
		//$pos es bool si no troba coincidencia, un enter si la troba
		$pos = strpos($_GET["url"], "login");
		if(Session::get("user") == "" && is_bool($pos)){
			View::redirect("login.index");
		}
	}
?>
</body>
</html>
<?php
	}

}

?>