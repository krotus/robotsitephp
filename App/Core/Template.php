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
	<link rel="stylesheet" href="<?php echo URL; ?>Views/template/css/bootstrap.min.css">
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