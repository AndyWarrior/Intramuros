
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
	</dl>
	
	<?php echo $this->Html->link(
        'Regresar',
        array('action' => 'rptTeams'),
        array('escape' => false, 'class' => "btn btn-primary btn-lg")
    ); ?>