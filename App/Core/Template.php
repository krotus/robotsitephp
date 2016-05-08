<?php 

namespace App\Core;

class Template{
	public function __construct(){
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Admin Robotsite</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/login.css">
    <script src="<?php echo URL; ?>public/js/jquery.js"></script>
    <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	}

	public function __destruct(){
?>
</body>
</html>
<?php
	}

}

?>