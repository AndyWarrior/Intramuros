<script>

    function check(){
        document.getElementById("TeamMonday").disabled = false;
        document.getElementById("TeamTuesday").disabled = false;
        document.getElementById("TeamWednesday").disabled = false;
        document.getElementById("TeamThursday").disabled = false;
        document.getElementById("TeamFriday").disabled = false;
        document.getElementById("TeamSaturday").disabled = false;
        document.getElementById("TeamSunday").disabled = false;
        document.getElementById("TeamMonday").checked = false;
        document.getElementById("TeamTuesday").checked = false;
        document.getElementById("TeamWednesday").checked = false;
        document.getElementById("TeamThursday").checked = false;
        document.getElementById("TeamFriday").checked = false;
        document.getElementById("TeamSaturday").checked = false;
        document.getElementById("TeamSunday").checked = false;

        var sport = document.getElementById("TeamSportId");
        var sportId = sport.options[sport.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array('controller' => 'students', 'action' => 'check')); ?>',
            data: {
                sportId: sportId
            },
            success: function(data){
                if(data.charAt(0) == '0')
                    document.getElementById("TeamMonday").disabled = true;
                if(data.charAt(1) == '0')
                    document.getElementById("TeamTuesday").disabled = true;
                if(data.charAt(2) == '0')
                    document.getElementById("TeamWednesday").disabled = true;
                if(data.charAt(3) == '0')
                    document.getElementById("TeamThursday").disabled = true;
                if(data.charAt(4) == '0')
                    document.getElementById("TeamFriday").disabled = true;
                if(data.charAt(5) == '0')
                    document.getElementById("TeamSaturday").disabled = true;
                if(data.charAt(6) == '0')
                    document.getElementById("TeamSunday").disabled = true;
            }
        });
    }
</script>
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
	foreach ($sprt as $sport):
		$deporte[$sport['Sport']['id']] = $sport['Sport']['name'];
	endforeach;
	
	echo $this->Form->input('sport_id', array('onchange' => 'check()', 'label' => 'Deporte del equipo', 'class' => 'form-control','options' => $deporte ));

	
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
