<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="superAdmin-users.html">Usuarios</a></li>
                <li ><a href="#">Deportes</a></li>
                <li ><a href="superAdmin-reglamento.html">Reglamento</a></li>
            </ul>
        </div>

    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h1><?php echo $this->Html->link( "<",   array('action'=>'index') ); ?> Edit User </h1>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('email', array(
            'class' => 'form-control'));
        echo $this->Form->input('full_name', array(
            'class' => 'form-control'));
        echo $this->Form->input('password_update', array( 'label' => 'New Password (leave empty if you do not want to change)', 'maxLength' => 255, 'type'=>'password','required' => 0, 'class' => 'form-control'));
        echo $this->Form->input('password_confirm_update', array('label' => 'Confirm New Password *', 'maxLength' => 255, 'title' => 'Confirm New password', 'type'=>'password','required' => 0, 'class' => 'form-control'));
        echo $this->Form->input('role', array(
            'options' => array( 2 => 'Admin', 1 => 'Super Admin'), 'class' => 'form-control'
        ));
        echo "<br>";
        echo $this->Form->submit('Edit User', array('class' => 'btn btn-primary btn-lg',  'title' => 'Click here to add the user') );
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
</div>