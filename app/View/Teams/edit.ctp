<div class="container">
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'teams', 'action' => 'index')
        ); ?> Editar Equipo</h1>
    <?php
    echo $this->Form->create('Team');
	
    echo $this->Form->input('name', array(
        'class' => 'form-control'));
		
	echo $this->Form->input('status', array('label' => 'Estatus del equipo', 'class' => 'form-control','options' =>  array(0 => 'Sin estatus', 1 => 'Campeon', 2 => 'Segunda etapa', 3 => 'No califico', 4 => 'Baja por default', 5 => 'Baja por reglamento')));
	
	$deporte = new array();
	foreach ($sports as $sport):
		$deporte[$sport['Sport']['id']] = $sport['Sport']['name'];
	endforeach;
	
	echo $this->Form->input('sport_id', array('label' => 'Deporte del equipo', 'class' => 'form-control','options' => $deporte ));

	
	echo $this->Form->input('monday', array(
                                  'type'=>'checkbox'));
								  
	echo $this->Form->input('tuesday', array(
                                  'type'=>'checkbox'));
	
	echo $this->Form->input('wednesday', array(
                                  'type'=>'checkbox'));
								  
	echo $this->Form->input('thursday', array(
                                  'type'=>'checkbox'));
								  
	echo $this->Form->input('friday', array(
                                  'type'=>'checkbox'));
	
	echo $this->Form->input('saturday', array(
                                  'type'=>'checkbox'));
								  
	echo $this->Form->input('sunday', array(
                                  'type'=>'checkbox'));
	
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo "<br>";
    echo $this->Form->submit('Editar equipo', array('class' => 'btn btn-primary btn-lg',  'title' => 'Editar equipo') );
    echo $this->Form->end();
    ?>
</div>