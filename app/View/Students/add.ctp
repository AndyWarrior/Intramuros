<div class="container">
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'students', 'action' => 'index',$sid)
        ); ?> Crear Nuevo Equipo</h1>
    <?php
    echo $this->Form->create('Team');
	
    echo $this->Form->input('name', array(
        'label' => 'Nombre del equipo','class' => 'form-control'));
			
	$deporte = array();
	foreach ($sports as $sport):
		$deporte[$sport['Sport']['id']] = $sport['Sport']['name']."-".$sport['Sport']['category'];
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
								  
	echo $this->Form->input('status', array('type' => 'hidden', 'default' => 1));
	echo $this->Form->input('student_id', array('type' => 'hidden', 'default' => $sid));
	
	echo $this->Form->input('period_id', array('type' => 'hidden', 'default' => $period['Period']['id']));
	
    echo "<br>";
    echo $this->Form->submit('Crear equipo', array('class' => 'btn btn-primary btn-lg',  'title' => 'Crear equipo') );
    echo $this->Form->end();
    ?>
</div>