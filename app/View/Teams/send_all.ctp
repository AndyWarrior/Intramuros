
    <h2>Mandar Email a los equipos selecionados</h2>
    <?php
    echo $this->Form->create(false, array( 'controller'=>'teams', 'action'=>'sendAll'));
    echo $this->Form->input('subject', array('type' => 'text','label' => 'Asunto:','class'=>'form-control','placeholder'=>'Ingrese el asunto'));
    echo $this->Form->input('text', array('type' => 'textarea','label' => 'Texto:','class'=>'form-control','placeholder'=>'Ingrese el mensaje'));
    echo $this->Form->input('sportId', array('type' => 'hidden','value' => $sportId));
    echo $this->Form->input('periodId', array('type' => 'hidden','value' => $periodId));
    echo $this->Form->input('teamNameFil', array('type' => 'hidden','value' => $teamNameFil));
    echo $this->Form->input('studentNameFil', array('type' => 'hidden','value' => $studentNameFil));
    echo $this->Form->input('teamStatusFil', array('type' => 'hidden','value' => $teamStatusFil));?>
    <br>
    <?php echo $this->Form->end('Enviar');
    ?>
