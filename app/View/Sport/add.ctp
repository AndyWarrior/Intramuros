
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li ><a href="/users">Usuarios</a></li>
                <li class="active"><a href="/sport">Deportes</a></li>
                <li ><a href="#">Reglamento</a></li>
            </ul>
        </div>

    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="users form">

    <h1><?php echo $this->Html->link( "<",   array('action'=>'index') ); ?> Add Sport</h1>
    <?php echo $this->Form->create('Sport');?>
    <fieldset>
        <?php echo $this->Form->input('sport_name', array(
            'class' => 'form-control'));
        echo $this->Form->input('user_id', array(
            'class' => 'form-control'));
        echo $this->Form->input('gender', array(
            'class' => 'form-control'));
        echo $this->Form->input('total_category', array(
            'class' => 'form-control'));
        echo $this->Form->input('monday', array(
            'class' => 'form-control'));
        echo $this->Form->input('tuesday', array(
            'class' => 'form-control'));
        echo $this->Form->input('wednesday', array(
            'class' => 'form-control'));
        echo $this->Form->input('thursday', array(
            'class' => 'form-control'));
        echo $this->Form->input('friday', array(
            'class' => 'form-control'));
        echo $this->Form->input('saturday', array(
            'class' => 'form-control'));
        echo $this->Form->input('sunday', array(
            'class' => 'form-control'));
        echo "<br>";

        echo $this->Form->submit('Add Sport', array('class' => 'btn btn-primary btn-lg',  'title' => 'Click here to add the sport') );
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>


