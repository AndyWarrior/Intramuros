<h1>Editar información</h1>
<?php
echo $this->Form->create('Student');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('name', array(
    'class' => 'form-control', 'label' => 'Nombre', 'required'));
echo $this->Form->input('email', array('label' => 'E-mail',
    'class' => 'form-control', 'required'));
echo $this->Form->input('cellphone', array('label' => 'Celular',
    'class' => 'form-control', 'required'));
echo $this->Form->input('gender', array('label' => 'Sexo', 'class' => 'form-control','options' =>  array(1 => 'Masculino', 2 => 'Femenino')));
echo "<br>";
echo $this->Form->submit('Guardar cambios', array('class' => 'btn btn-primary btn-lg',  'title' => 'Guardar usuario') );
echo $this->Form->end();
?>