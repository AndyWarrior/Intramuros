<script>

    function check(){
        document.getElementById("TeamMonday").disabled = false;
        document.getElementById("TeamTuesday").disabled = false;
        document.getElementById("TeamWednesday").disabled = false;
        document.getElementById("TeamThursday").disabled = false;
        document.getElementById("TeamFriday").disabled = false;
        document.getElementById("TeamSaturday").disabled = false;
        document.getElementById("TeamSunday").disabled = false;
        var sport = document.getElementById("TeamSportId");
        var sportId = sport.options[sport.selectedIndex].value;
        $.ajax({
            type: "POST",
            async: false,
            url: '<?php echo Router::url(array('controller' => 'students', 'action' => 'check')); ?>',
            data: {
                sportId: sportId
            },
            success: function(data){
                if(data.charAt(0) == '0')
                    document.getElementById("TeamMonday").disabled = true;
                if(data.charAt(1) == '0')
                    document.getElementById("TeamTuesday").disabled = true;
                if(data.charAt(2) == '0')
                    document.getElementById("TeamWednesday").disabled = true;
                if(data.charAt(3) == '0')
                    document.getElementById("TeamThursday").disabled = true;
                if(data.charAt(4) == '0')
                    document.getElementById("TeamFriday").disabled = true;
                if(data.charAt(5) == '0')
                    document.getElementById("TeamSaturday").disabled = true;
                if(data.charAt(6) == '0')
                    document.getElementById("TeamSunday").disabled = true;
            }
        });
    }

</script>

<div class="container">
    <h1><?php echo $this->Html->link(
            '< ',
            array('controller' => 'students', 'action' => 'index',$sid)
        ); ?> Crear Nuevo Equipo</h1>
    <?php
    echo $this->Form->create('Team');

    echo $this->Form->input('name', array(
        'label' => 'Nombre del equipo','class' => 'form-control', 'required'));

    $deporte = array();
    foreach ($sports as $sport):
        $deporte[$sport['Sport']['id']] = $sport['Sport']['name']."-".$sport['Sport']['category'];
    endforeach;

    echo $this->Form->input('sport_id', array('empty'=>true,'onchange' => 'check()' ,'label' => 'Deporte del equipo', 'class' => 'form-control','options' => $deporte, 'required' ));


    echo $this->Form->input('monday', array(
        'label' => 'Lunes','type'=>'checkbox'));

    echo $this->Form->input('tuesday', array(
        'label' => 'Martes','type'=>'checkbox'));

    echo $this->Form->input('wednesday', array(
        'label' => 'Miercoles','type'=>'checkbox'));

    echo $this->Form->input('thursday', array(
        'label' => 'Jueves','type'=>'checkbox'));

    echo $this->Form->input('friday', array(
        'label' => 'Viernes','type'=>'checkbox'));

    echo $this->Form->input('saturday', array(
        'label' => 'Sabado','type'=>'checkbox'));

    echo $this->Form->input('sunday', array(
        'label' => 'Domingo','type'=>'checkbox'));

    echo $this->Form->input('status', array('type' => 'hidden', 'default' => 1));
    echo $this->Form->input('student_id', array('type' => 'hidden', 'default' => $sid));

    echo $this->Form->input('period_id', array('type' => 'hidden', 'default' => $period['Period']['id']));
    echo "<br>";
    echo "Acepto el ".$this->Html->link("reglamento", array('action'=>'rule', $sid), array('target' => '_blank') )." de Intramuros <input type='checkbox' required/>";
    echo "<br>";
    echo "<br>";
    echo $this->Form->submit('Crear equipo', array('class' => 'btn btn-primary btn-lg',  'title' => 'Crear equipo') );
    echo $this->Form->end();
    ?>
</div>