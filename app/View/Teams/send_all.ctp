<div class="container">
    <h1>Mandar Email a los equipos selecionados</h1>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'sendAll'));
    echo $this->Form->input('subject', array('type' => 'text','label' => 'Asunto:'));
    echo $this->Form->input('text', array('type' => 'textarea','label' => 'Texto:'));
    echo $this->Form->input('emails', array('type' => 'hidden','value' => $emails));
    echo $this->Form->end('Enviar');
    ?>
</div>