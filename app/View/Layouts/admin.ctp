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
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Intramutos</a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <?php if($user['user_type'] == 1) { ?>
                <li>
                    <a href="#">SuperAdmin</a>
                </li>
            <?php } ?>
            <li>
                <a href="#">Deporte</a>
            </li>
        </ul>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> <?php echo $user['username'] ?> </a></li>
                <li>
                    <?php
                    echo $this->Html->link( "Logout",   array('controller' => 'security', 'action'=>'logout') );
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="container">
    <div id="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>

</div>
</div>
</body>
</html>
