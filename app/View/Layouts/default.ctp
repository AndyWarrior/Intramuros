<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$user = $this->Session->read('Auth.User');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        Intramuros
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('dashboard');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            </button>
            <a class="navbar-brand" href="#">Intramuros</a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <?php if($user['user_type'] == 1) { ?>
                <li>
                    <?php echo $this->Html->link(
                        "Super-Admin", array('controller' => 'users', 'action' => 'index'));?>
                </li>
            <?php } ?>
            <li>
                <?php echo $this->Html->link(
                    "Deportes", array('controller' => 'teams', 'action' => 'index'));?>
            </li>
        </ul>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> <?php echo $user['username'] ?> </a></li>
                <li>
                    <?php echo $this->Html->link(
                        "Cerrar sesion", array('controller' => 'security', 'action' => 'logout'));?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="container">
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li ><?php echo $this->Html->link(
                                "Usuarios", array('controller' => 'users', 'action' => 'index'));?></li>
                        <li ><?php echo $this->Html->link(
                                "Deportes", array('controller' => 'sports', 'action' => 'index'));?></li>
                        <li ><?php echo $this->Html->link(
                                "Reglamento", array('controller' => 'rules', 'action' => 'index'));?></li>
                        <li ><?php echo $this->Html->link(
                                "Reporte de equipos", array('controller' => 'sadmin', 'action' => 'rptTeams'));?></li>
                        <li ><?php echo $this->Html->link(
                                "Reporte de actividad", array('controller' => 'sadmin', 'action' => 'rptActionLogs'));?></li>
                        <li ><?php echo $this->Html->link(
                                "Aviso General", array('controller' => 'sadmin', 'action' => 'sendAll'));?></li>
                        <li ><?php
                            echo $this->Form->postLink(
                                'Terminar periodo',
                                array('controller' =>'sadmin','action' => 'changePeriod'),
                                array('confirm' => 'Seguro que quieres terminar el periodo actual?')
                            );
                            ?></li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="users form">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
                <?php echo $this->element('sql_dump'); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
