
    <h1 class="page-header">Informacion del Equipo</h1>

	
	<dl>
				<dt> Nombre del equipo </dt>
				<dd> <?php  echo $team['Team']['name']; ?> </dd>
				
				<dt> Nombre del delegado </dt>
				<dd> <?php  echo $student['Student']['name']; ?> </dd>
				
				<dt> Correo </dt>
				<dd> <?php  echo $student['Student']['email']; ?> </dd>
				
				<dt> Celular </dt>
				<dd> <?php  echo $student['Student']['cellphone']; ?> </dd>
				
				<dt> Dias de juego </dt>
				<?php  if($team['Team']['monday'] == 1) 
					echo 'Lunes, ' ;?>
					<?php  if($team['Team']['tuesday'] == 1) 
					echo 'Martes, ' ;?>
					
					<?php  if($team['Team']['wednesday'] == 1) 
					echo 'Miercoles, ' ;?>
					
					<?php  if($team['Team']['thursday'] == 1) 
					echo 'Jueves, ' ;?>
					
					<?php  if($team['Team']['friday'] == 1) 
					echo 'Viernes, '  ;?>
					
					<?php  if($team['Team']['saturday'] == 1) 
					echo 'Sabado, '  ;?>
					
					<?php  if($team['Team']['sunday'] == 1) 
					echo 'Domingo';?>
					

	
				
				
	</dl>
	
	<?php echo $this->Html->link(
        'Regresar',
        array('action' => 'rptTeams'),
        array('escape' => false, 'class' => "btn btn-primary btn-lg")
    ); ?>