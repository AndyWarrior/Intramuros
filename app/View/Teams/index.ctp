    <h1 class="page-header"><?php echo $sportName ?></h1>
    <?php echo $this->Html->link( "Enviar correo a todos",   array('action'=>'sendAll',$sportId,$periodId,$teamNameFil,$studentNameFil,$teamStatusFil),
        array('escape' => false, 'class' => "btn btn-default btn-xs")); ?>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'index'));
    echo $this->Form->input('sportId', array('type' => 'hidden','value' => $sportId));




    ?>



    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Filtrar Por Nombre</th>
                <th>Filtrar Por Delegado</th>
                <th>Filtrar Por Status</th>
                <th></th>
                <th></th>
            </tr>
            <tr>

                <th><?php echo $this->Form->input('teamNameFil', array('type' => 'text','label' => '', 'class' => 'form control'));?></th>
                <th><?php echo $this->Form->input('studentNameFil', array('type' => 'text','label' => '', 'class' =>'form control'));?></th>
                <th><?php	echo $this->Form->input('teamStatusFil',
                        array('label' => '', 'class' => 'form control input-sm','options' =>  array('' => '', 1 => 'Sin Asignar', 2 => 'Campeones', 3 => 'Segunda Etapa',
                            4 => 'No clasifico', 5 => 'Baja por default', 6 => 'Baja por reglamento'
                        )));?>
                </th>
                <th></th>
                <th><?php  echo $this->Form->end('Buscar'); ?></th>
            </tr>
            <th></th>
            <th></th>
            <th><h2>Resultados</h2></th>
            <th></th>
            <th></th>

            <tr>
                <th>Nombre</th>
                <th>Delegado</th>
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
                            case 1:
                                echo 'Sin Asignar';
                            break;
                            case 2:
                                echo 'Campeones';
                            break;
                            case 3:
                                echo 'Segunda Etapa';
                            break;
                            case 4:
                                echo 'No clasifico';
                            break;
                            case 5:
                                echo 'Baja por default';
                            break;
                            case 6:
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
