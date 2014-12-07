


<div class="container">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User', array(
        'class' => 'form-signin')); ?>
        <h2 class="form-signin-heading">Intramuros</h2>
        <?php echo $this->Form->input('username', array('label' => 'Nomina',
            'class' => 'form-control'));
        echo $this->Form->input('password', array('label' => 'Contraseña',
            'class' => 'form-control'));
        ?>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
        <?php echo $this->Form->end(); ?>

</div> <!-- /container -->


