<h1 class="page-header">Users</h1>
<div class="table-responsive">
    <?php echo $this->Html->link( "Nuevo usuario",   array('action'=>'add'), array('escape' => false, 'class' => "btn btn-primary btn-lg")); ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nomina</th>
            <th>email</th>
            <th>Tipo de usuario</th>
            <th>Nombre</th>
            <th>Estatus</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['User']['username']?></td>
                <td><?php echo $user['User']['email']; ?></td>
                <td><?php if($user['User']['user_type'] == 1){echo "Super Admin";}else{echo "Admin";} ?></td>
                <td><?php echo $user['User']['full_name']; ?></td>
                <td><?php if($user['User']['active'] == 1){echo "Active";}else{echo "Deactivated";}?></td>
                <td >
                    <?php echo $this->Html->link("Edit",   array('action'=>'edit', $user['User']['id']) ); ?> |
                    <?php echo $this->Html->link("Cambiar contraseña",   array('action'=>'password', $user['User']['id']) ); ?> |
                    <?php
                    if( $user['User']['active'] != 0){
                        echo $this->Form->postLink(
                            'Desactivar',
                            array('action' => 'deactivate', $user['User']['id']),
                            array('confirm' => 'Estas seguro de querer desactivar a este usuario?')
                        ); }else{
                        echo $this->Html->link(    "Activar", array('action'=>'activate', $user['User']['id']));
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
        </tbody>
    </table>
</div>
