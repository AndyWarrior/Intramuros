
    <h1 class="page-header">Reporte de Equipos</h1>

    <?php
    echo $this->Form->create(false, array( 'controller'=>'sadmin', 'action'=>'rptTeams'));?>




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
                <th><?php  echo $this->Form->end('Buscar'); ?></th>
            </tr>
            <th></th>
            <th></th>
            <th><h2>Resultados</h2></th>
            <th></th>
            <th></th>

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
    <?php echo $this->Html->link( "PDF",   array('action'=>'viewPdf'), array('escape' => false, 'class' => "btn btn-primary btn-lg")); ?>
