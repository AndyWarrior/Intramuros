
    <h1 class="page-header">Reglamento</h1>

    

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Reglamento Actual:</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rules as $rule): ?>
                <tr>
                    <td>
                        <?php echo $rule['Rule']['rule']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php unset($rule); ?>
            </tbody>
        </table>
    </div>
	
	<br>
	
	<?php echo $this->Html->link(
        'Editar Reglamento',
        array('controller' => 'rules', 'action' => 'edit',1),
        array('escape' => false, 'class' => "btn btn-primary btn-lg")
    ); ?>
