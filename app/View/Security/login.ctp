


<div class="container">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User', array(
        'class' => 'form-signin')); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php echo $this->Form->input('username', array(
            'class' => 'form-control'));
        echo $this->Form->input('password', array(
            'class' => 'form-control'));
        ?>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <?php echo $this->Form->end(); ?>

</div> <!-- /container -->


