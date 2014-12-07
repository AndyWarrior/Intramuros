<h1>Editar Usuario</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('username', array(
    'class' => 'form-control', 'label' => 'Nomina'));
echo $this->Form->input('full_name', array('label' => 'Nombre',
    'class' => 'form-control'));
echo $this->Form->input('email', array(
    'class' => 'form-control'));
echo $this->Form->input('password', array('label' => 'Contraseña', 'class' => 'form-control', 'maxLength' => 255, 'type'=>'password'));
echo $this->Form->input('user_type', array('label' => 'Tipo de usuario', 'class' => 'form-control','options' =>  array(1 => 'Super Admin', 2 => 'Admin')));
echo "<br>";
echo $this->Form->submit('Guardar usuario', array('class' => 'btn btn-primary btn-lg',  'title' => 'Guardar usuario') );
echo $this->Form->end();
?>