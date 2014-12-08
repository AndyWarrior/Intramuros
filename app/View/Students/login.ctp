

<div class="container">
    <?php echo $this->Form->create('Student', array(
        'class' => 'form-signin')); ?>
        <h2 class="form-signin-heading">Inscripcion de equipos</h2>
		<div class="center">
		<div class="col-sm-4">
        <?php echo $this->Form->input('id', array('label' => 'Matricula',
            'class' => 'form-control', 'type' => 'text'));
        echo $this->Form->input('password', array('label' => 'Contraseña',
            'class' => 'form-control', 'required'));
        ?>
		<br>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
        <?php echo $this->Form->end(); ?>
		</div>
		</div>

</div> <!-- /container -->


