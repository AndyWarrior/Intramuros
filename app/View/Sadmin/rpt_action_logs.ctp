

<h1> Reporte de actividad de los usuarios </h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre del administrador</th>
                <th>Accion Realizada</th>
				<th>Fecha de la accion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td>
                        <?php 
						foreach ($users as $user):
							if ($user['User']['id'] == $log['Actionlog']['user_id'])
								echo $user['User']['full_name']; 
						endforeach;
						unset($user);
						?>
                    </td>
					
					<td>
						<?php echo $log['Actionlog']['action']; ?>

                    </td>
					
					<td>
						<?php echo $log['Actionlog']['timestamp']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php unset($log); ?>
            </tbody>
        </table>
    </div>