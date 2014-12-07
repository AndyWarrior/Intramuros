<div class="container">
    <h1>Mandar Email a <?php echo $email?></h1>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'sendOne'));
    echo $this->Form->input('subject', array('type' => 'text','label' => 'Asunto:'));
    echo $this->Form->input('text', array('type' => 'textarea','label' => 'Texto:'));
    echo $this->Form->input('sportId', array('type' => 'hidden','value' => $sportId));
    echo $this->Form->input('email', array('type' => 'hidden','value' => $email));
    echo $this->Form->end('Enviar');
    ?>
</div>