
<h1><?php echo $this->Html->link(
        '< ',
        array('controller' => 'users', 'action' => 'index')
    ); ?> Editar Usuario</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('password', array('label' => 'Contraseña', 'class' => 'form-control', 'maxLength' => 255, 'type'=>'password'));
echo "<br>";
echo $this->Form->submit('Cambiar contraseña', array('class' => 'btn btn-primary btn-lg',  'title' => 'Cambiar contraseña') );
echo $this->Form->end();
?>