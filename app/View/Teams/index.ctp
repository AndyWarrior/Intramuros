<div class="container">
    <h1 class="page-header">Equipos</h1>
    <?php echo $this->Html->link( "Enviar correo a todos",   array('action'=>'sendAll',$sportId,$periodId,$teamNameFil,$studentNameFil,$teamStatusFil), array('escape' => false, 'class' => "btn btn-default btn-xs")); ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Capitan</th>
                <th>Status</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>

                    <td>
                        <?php
                        echo $team['Team']['name'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $team['std']['name'];
                        ?>
                    </td>
                    <td>
                        <?php
                        switch ($team['Team']['status']){
                            case 0:
                                echo 'Sin Asignar';
                            break;
                            case 1:
                                echo 'Campeones';
                            break;
                            case 2:
                                echo 'Segunda Etapa';
                            break;
                            case 3:
                                echo 'No clasifico';
                            break;
                            case 4:
                                echo 'Baja por default';
                            break;
                            case 5:
                                echo 'Baja por reglamento';
                            break;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $team['std']['email'];
                        ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link("Editar", array('action'=>'edit', $team['Team']['id'], $sportId) ); ?> |
                        <?php echo $this->Form->postLink(
                            'Borrar',
                            array('action' => 'delete', $team['Team']['id']),
                            array('confirm' => 'Estas seguro?')
                        ); ?>|
                        <?php echo $this->Html->link("Enviar Email", array('action'=>'sendOne',$sportId ,$team['std']['email']) ); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php unset($team); ?>
            </tbody>
        </table>
    </div>
</div>