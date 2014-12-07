
    <h1 class="page-header">Deportes</h1>

    <?php echo $this->Html->link(
        'Agregar Deporte',
        array('controller' => 'sports', 'action' => 'add'),
        array('escape' => false, 'class' => "btn btn-primary btn-lg")
    ); ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
				<th>Encargado</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sports as $sport): ?>
                <tr>
                    <td>
                        <?php echo $sport['Sport']['name']; ?>
                    </td>
					
					<td>
                        <?php echo $sport['Sport']['category']; ?>
                    </td>
					
					<td>
                        <?php 
						foreach ($users as $user):
							if ($user['User']['id'] == $sport['Sport']['user_id'])
								echo $user['User']['full_name']; 
						endforeach;
						?>
                    </td>

                    <td>
                        <?php
                        echo $this->Form->postLink(
                            'Borrar',
                            array('action' => 'delete', $sport['Sport']['id']),
                            array('confirm' => 'Estas seguro?')
                        );
                        ?>
                        <?php
                        echo $this->Html->link(
                            'Editar', array('action' => 'edit', $sport['Sport']['id'])
                        );
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>
            <?php unset($sport); ?>
            </tbody>
        </table>
    </div>
