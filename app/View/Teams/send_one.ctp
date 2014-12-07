
    <h2>Mandar Email a <?php echo $email?></h2>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'sendOne'));
    echo $this->Form->input('subject', array('type' => 'text','label' => 'Asunto:','class'=>'form-control','placeholder'=>'Ingrese el asunto'));
    echo $this->Form->input('text', array('type' => 'textarea','label' => 'Texto:','class'=>'form-control','placeholder'=>"Ingrese su mensaje"));
    echo $this->Form->input('sportId', array('type' => 'hidden','value' => $sportId));
    echo $this->Form->input('email', array('type' => 'hidden','value' => $email));?>
    <br>
    <?php echo $this->Form->end('Enviar');
    ?>
