<?php

namespace App\Core;

use App\Utility\Debug as Debug;

class AdminTemplate {

    public function __construct() {
        $user = unserialize(Session::get('user'));
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Armduino | Admin</title>
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

        <!-- Andreu -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/index-orders.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/admin-lte/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap-slider.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/validation.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/sweetalert/css/sweetalert.css">

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

        <!-- Andreu -->
        <script src="<?php echo URL; ?>public/js/bootstrap-slider.min.js"></script>
        <script src="<?php echo URL; ?>public/bootstrap/js/moment.js"></script>
        <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo URL; ?>public/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo URL; ?>public/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>public/js/index_orders.js"></script>
        <script src="<?php echo URL; ?>public/js/validation/jquery.validate.js"></script>
        <script src="<?php echo URL; ?>public/js/validation/additional-methods.js"></script>
        <script src="<?php echo URL; ?>public/js/validation/localization/messages_<?php echo Session::get('lang') ?>.js"></script>
        <script src="<?php echo URL; ?>public/sweetalert/js/sweetalert.min.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_workers.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_teams.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_robots.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_processes.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_orders.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/index_tasks.js"></script>
        <script src="<?php echo URL; ?>public/js/admin/stadistics_orders.js"></script>
        <script src="<?php echo URL; ?>public/three/three.min.js"></script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo URL; ?>admin" class="logo">

                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>RM</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>ARM</b>duino</span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">   
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?php echo URL; ?>public/admin-lte/img/avatar.png" class="user-image" alt="Profile">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $user->getName();?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?php echo URL; ?>public/admin-lte/img/avatar.png" class="img-circle" alt="Profile Image">

                                        <p>
                                            <?php echo $user->getName() . " " . $user->getSurname();  ?>
                                            <small>Forma parte del equipo: <?php echo $user->getTeam()->getName() ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo URL . 'admin/profile' ?>" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-user"></span> Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo URL . 'worker/logout' ?>" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo URL; ?>public/admin-lte/img/avatar.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user->getName() . " " . $user->getSurname();  ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <li class="header">MENÚ PRINCIPAL</li>
                        <!-- Logic active list items -->
                        <?php 
                            if(!isset($_GET['url'])) $_GET['url'] = NULL; 
                        ?>

                        <li <?php echo (!isset($_GET['url']) || $_GET['url'] == "admin") ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "order")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/order">
                                <i class="fa fa-table"></i> <span>Ordenes</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "robot")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/robot">
                                <i class="fa fa-table"></i> <span>Robots</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "task")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/task">
                                <i class="fa fa-table"></i> <span>Tareas</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "worker")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/worker">
                                <i class="fa fa-table"></i> <span>Trabajadores</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "team")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/team">
                                <i class="fa fa-table"></i> <span>Equipos</span>
                            </a>
                        </li>
                        <li <?php echo (strpos($_GET['url'], "process")) ? "class='active'" : ""; ?>>
                            <a href="<?php echo URL; ?>admin/process">
                                <i class="fa fa-table"></i> <span>Procesos</span>
                            </a>
                        </li>
                        <li class="treeview <?php echo (strpos($_GET['url'], "stadistic")) ? "active" : "" ?>" >
                            <a href="#"><i class="fa fa-line-chart"></i> <span>Estadisticas</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-table"></i> Tabla</a></li>
                                <li><a href="#"><i class="fa fa-area-chart"></i> Graficos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside> <!-- ./left side column -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            
    <?php
    }

    
    public function __destruct() {
        if (isset($_GET['url'])) {
            if (strpos($_GET['url'], "Ajax") === false) {
                ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">

                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    ArduinoARM
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="#">M12 Project</a>.</strong> All rights reserved.
            </footer>
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->
    </body>
    </html>
                <?php
            }
        }
    }

}


?>

