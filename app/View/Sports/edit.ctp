<div class="container">
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'sports', 'action' => 'index')
        ); ?> Editar Deporte</h1>
    <?php
    echo $this->Form->create('Sport');
	
    echo $this->Form->input('name', array('label' => 'Nombre de deporte', 'class' => 'form-control'));
	
	$encargado = array();
	foreach ($users as $user):
		$encargado[$user['User']['id']] = $user['User']['full_name'];
	endforeach;
	
	echo $this->Form->input('user_id', array('label' => 'Encargado del deporte', 'class' => 'form-control','options' => $encargado ));

	
	echo $this->Form->input('gender', array('label' => 'Genero', 'class' => 'form-control','options' =>  array(1 => 'Masculino', 2 => 'Femenino', 3 => 'Mixto')));

	echo $this->Form->input('category', array('label' => 'Categoria', 'class' => 'form-control'));
	
	echo $this->Form->input('monday', array(
                                  'label' => 'Lunes','type'=>'checkbox'));
								  
	echo $this->Form->input('tuesday', array(
                                  'label' => 'Martes','type'=>'checkbox'));
	
	echo $this->Form->input('wednesday', array(
                                  'label' => 'Miercoles','type'=>'checkbox'));
								  
	echo $this->Form->input('thursday', array(
                                  'label' => 'Jueves','type'=>'checkbox'));
								  
	echo $this->Form->input('friday', array(
                                  'label' => 'Viernes','type'=>'checkbox'));
	
	echo $this->Form->input('saturday', array(
                                  'label' => 'Sabado','type'=>'checkbox'));
								  
	echo $this->Form->input('sunday', array(
                                  'label' => 'Domingo','type'=>'checkbox'));
								  
	echo $this->Form->input('id', array('type' => 'hidden'));
								  
    echo "<br>";
    echo $this->Form->submit('Guardar', array('class' => 'btn btn-primary btn-lg',  'title' => 'Guardar') );
    echo $this->Form->end();
    ?>
</div>