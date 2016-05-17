<?php

namespace App\Core;

class Template {

    public function __construct() {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <?php
                $login = false;
                $admin = false;
                if (isset($_GET['url'])) {
                    $expUrl = explode("/", $_GET['url']);
                    if ($expUrl[0] == "login") {
                        $login = true;
                    } elseif ($expUrl[0] == "admin") {
                        $admin = true;
                    }
                }
                ?>
                <meta charset="UTF-8">
                <title>Admin Robotsite</title>
                <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap-theme.min.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/bootstrap/css/bootstrap-datetimepicker.min.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/css/switch-pro.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/css/login.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/css/heading.css">
                <link rel="stylesheet" href="<?php echo URL; ?>public/css/index-orders.css">
                <!--<link rel="stylesheet" href="<?php echo URL; ?>public/datatables/css/datatables.min.css">-->
                <link rel="stylesheet" href="<?php echo URL; ?>public/datatables/css/datatables.bootstrap.min.css">
                <script src="<?php echo URL; ?>public/js/jquery.js"></script>
                <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
                <script src="<?php echo URL; ?>public/bootstrap/js/moment.js"></script>
                <script src="<?php echo URL; ?>public/bootstrap/js/bootstrap-datetimepicker.js"></script>
                <script src="<?php echo URL; ?>public/datatables/js/datatables.min.js"></script>
                <script src="<?php echo URL; ?>public/datatables/js/datatables.bootstrap.min.js"></script>
                <script src="<?php echo URL; ?>public/js/index_orders.js"></script>

                <?php if ($admin) {
                    ?>
                    <link rel="stylesheet" href="<?php echo URL; ?>public/css/adminSidebar.css">
                    <script src="<?php echo URL; ?>public/js/admin/index_workers.js"></script>
                    <script src="<?php echo URL; ?>public/js/admin/index_teams.js"></script>
                    <?php
                }
                ?>

            </head>
            <body>
                <?php
                if (!$login) {
                    ?>
                    <nav class="navbar navbar-default navbar-fixed-top header-navbar">
                        <!--<div class="navbar-header">-->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Project name</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo URL . 'worker/logout' ?>">Logout</a></li>
                            <li><a href="../navbar-static-top/">Static top</a></li>
                            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
                        </ul>

                        <!--</div>/.nav-collapse -->


                </nav>
                <?php
                if ($admin) {
                    ?>
                    <div id="wrapper">
                        <div id="sidebar-wrapper" class="col-md-2">
                            <div id="sidebar">
                                <ul class="nav list-group">
                                    <li>
                                        <a class="list-group-item" href="#"><i class="icon-home icon-1x"></i>Sidebar Item 1</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#"><i class="icon-home icon-1x"></i>Sidebar Item 2</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#"><i class="icon-home icon-1x"></i>Sidebar Item 9</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#"><i class="icon-home icon-1x"></i>Sidebar Item 10</a>
                                    </li>
                                    <li>
                                        <a class="list-group-item" href="#"><i class="icon-home icon-1x"></i>Sidebar Item 11</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="main-wrapper" class="col-md-10 pull-right">
                            <?php
                        } else {
                            ?>

                            <div class="nav-separator"></div>
                            <?php
                        }
                    }
                }

                public function __destruct() {
                    ?>
                    <?php
                    $login = false;
                    $admin = false;
                    if (isset($_GET['url'])) {
                        $expUrl = explode(DS, $_GET['url']);
                        if ($expUrl[0] == "admin") {
                            ?>
                        </div>
                        <?php
                    }
                }
                if (isset($_GET['url'])) {

                    if (strpos($_GET['url'], "Ajax") === false) {
                        ?>
                </body>
                </html>
                <?php
            }
        } else {
            ?>
            </body>
            </html>
            <?php
        }
    }

}
?>