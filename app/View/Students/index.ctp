

<h1> Mis Equipos Registrados </h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre del equipo</th>
                <th>Deporte</th>
				<th>Categoria</th>
				<th>Periodo</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <td>
                        <?php echo $team['Team']['name']; ?>
                    </td>
					
					<td>
                        <?php 
						foreach ($sports as $sport):
							if ($sport['Sport']['id'] == $team['Team']['sport_id'])
								echo $sport['Sport']['name']; 
						endforeach;
						unset($sport);
						?>
                    </td>
					
					<td>
                        <?php 
						foreach ($sports as $sport):
							if ($sport['Sport']['id'] == $team['Team']['sport_id'])
								echo $sport['Sport']['category']; 
						endforeach;
						unset($sport);
						?>
                    </td>
					
					<td>
                        <?php 
						foreach ($periods as $period):
							if ($period['Period']['id'] == $team['Team']['period_id'])
								echo $period['Period']['period']; 
						endforeach;
						unset($period);
						?>
                    </td>


                </tr>
            <?php endforeach; ?>
            <?php unset($team); ?>
            </tbody>
        </table>
    </div>
	
	<?php echo $this->Html->link(
        'Agregar Nuevo Equipo',
        array('controller' => 'students', 'action' => 'add',$sid),
        array('escape' => false, 'class' => "btn btn-primary btn-lg")
    ); ?>