<div class="container">
    <h1>Mandar Email a los equipos selecionados</h1>
    <?php
    echo $this->Form->create(false, array('formnovalidate' => true, 'controller'=>'teams', 'action'=>'sendAll',));
    echo $this->Form->input('to');   //text
    echo $this->Form->input('subv');   //password
    echo $this->Form->input('approved');   //day, month, year, hour, minute, meridian
    echo $this->Form->input('quote');
    ?>
</div>