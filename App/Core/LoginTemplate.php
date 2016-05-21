<?php

namespace App\Core;

use App\Utility\Debug as Debug;

class LoginTemplate {

    public function __construct() {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Armduino | Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/admin-lte/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/admin-lte/css/AdminLTE.min.css">
        <!-- AdminLTE Skin Blue  -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/admin-lte/css/skins/skin-blue.min.css">

        <link rel="stylesheet" href="<?php echo URL; ?>public/css/login.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/switch-pro.css">

        <!-- REQUIRED JS SCRIPTS -->
        <!-- jQuery 2.2.0 -->
        <script src="<?php echo URL; ?>public/admin-lte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo URL; ?>public/admin-lte/bootstrap/js/bootstrap.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo URL; ?>public/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo URL; ?>public/admin-lte/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo URL; ?>public/admin-lte/js/app.min.js"></script>


    </head>
    <body class="hold-transition login-page">
    <?php
    }

    public function __destruct() {
                ?> 

    </body>
    </html>
  
        
    <?php
    }

}


?>

