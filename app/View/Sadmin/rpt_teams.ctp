
<h1 class="page-header">Reporte de Equipos</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Filtrar Por Nombre</th>
            <th>Filtrar Por Delegado</th>
            <th>Filtrar Por Status</th>
            <th>Filtrar Por Deporte</th>
            <th>Filtrar Por Categoria</th>
            <th>Filtrar Por Periodo</th>
        </tr>
        <tr>
            <?php
            echo $this->Form->create(false, array( 'controller'=>'sadmin', 'action'=>'rptTeams'));?>
            <th><?php echo $this->Form->input('teamNameFil', array('type' => 'text','label' => '', 'class' => 'form control'));?></th>
            <th><?php echo $this->Form->input('studentNameFil', array('type' => 'text','label' => '', 'class' =>'form control'));?></th>
            <th><?php	echo $this->Form->input('teamStatusFil',
                    array('label' => '', 'class' => 'form control input-sm','options' =>  array('' => '', 1 => 'Sin Asignar', 2 => 'Campeones', 3 => 'Segunda Etapa',
                        4 => 'No clasifico', 5 => 'Baja por default', 6 => 'Baja por reglamento'
                    )));?>
            </th>
            <th><?php echo $this->Form->input('sportNameFil', array('type' => 'text','label' => '', 'class' =>'form control'));?></th>
            <th><?php echo $this->Form->input('sportCategoryFil', array('type' => 'text','label' => '', 'class' =>'form control'));?></th>
            <th><?php echo $this->Form->input('periodNameFil', array('type' => 'text','label' => '', 'class' =>'form control'));?></th>
            </tr>
        <tr><td><br><?php  echo $this->Form->submit('Buscar', array('class' => 'btn btn-primary btn-lg','div'=>false, 'name'=>'submit')); ?>
                <?php  echo $this->Form->submit('PDF', array('class' => 'btn btn-primary btn-lg','div'=>false, 'name'=>'submit')); ?></td>
            <?php  echo $this->Form->end(); ?>
            <td colspan="4"><h2 style="text-align: center">Resultados</h2></td></tr>
        <tr>
            <th>Nombre del Equipo</th>
            <th>Delegado</th>
            <th>Status</th>
            <th>Deporte</th>
            <th>Categoria</th>
            <th>Periodo</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teams as $team): ?>
            <tr>

                <td>

                    <?php echo $this->Html->link($team['Team']['name'], array('action'=>'view', $team['Team']['id']) ); ?>
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
                    echo $team['sprt']['name'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $team['sprt']['category'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $team['prd']['period'];
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>
        <?php unset($team); ?>
        </tbody>
    </table>
</div>
<br>
