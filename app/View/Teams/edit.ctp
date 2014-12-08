
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'teams', 'action' => 'index')
        ); ?> Editar Equipo</h1>
    <?php
    echo $this->Form->create('Team');
	
    echo $this->Form->input('name', array(
        'label' => 'Nombre del equipo','class' => 'form-control'));
		
	echo $this->Form->input('status', array('label' => 'Estatus del equipo', 'class' => 'form-control','options' =>  array(1 => 'Sin asignar', 2 => 'Campeon', 3 => 'Segunda etapa', 4 => 'No califico', 5 => 'Baja por default', 6 => 'Baja por reglamento')));
	
	$deporte = array();
	foreach ($sports as $sport):
		$deporte[$sport['Sport']['id']] = $sport['Sport']['name'];
	endforeach;
	
	echo $this->Form->input('sport_id', array('label' => 'Deporte del equipo', 'class' => 'form-control','options' => $deporte ));

	
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
    echo $this->Form->submit('Editar equipo', array('class' => 'btn btn-primary btn-lg',  'title' => 'Editar equipo') );
    echo $this->Form->end();
    ?>
