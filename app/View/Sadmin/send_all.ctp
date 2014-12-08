
    <h2>Mandar Email a los equipos selecionados</h2>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'sendAll'));
    echo $this->Form->input('subject', array('type' => 'text','label' => 'Asunto:','class'=>'form-control','placeholder'=>'Ingrese el asunto'));
    echo $this->Form->input('text', array('type' => 'textarea','label' => 'Texto:','class'=>'form-control','placeholder'=>'Ingrese el mensaje'));?>
    <br>
    <?php echo $this->Form->end('Enviar');
    ?>
