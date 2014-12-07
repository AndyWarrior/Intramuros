<div class="container">
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'rules', 'action' => 'index')
        ); ?> Editar Reglamento</h1>
    <?php
    echo $this->Form->create('Rule');
	
    echo $this->Form->input('rule', array('label' => 'Escribe el reglamento: ', 'class' => 'form-control'));
								  
	echo $this->Form->input('id', array('type' => 'hidden'));
								  
    echo "<br>";
    echo $this->Form->submit('Guardar Reglamento', array('class' => 'btn btn-primary btn-lg',  'title' => 'Guardar Reglamento') );
    echo $this->Form->end();
    ?>
</div>