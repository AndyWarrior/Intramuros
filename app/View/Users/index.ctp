<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><?php echo $this->Html->link( "Usuarios",   array('controller' => 'Users', 'action'=>'index') ); ?></li>
                <li ><?php echo $this->Html->link( "Deportes",   array('Controller' => 'Sport', 'action'=>'index') ); ?></li>
                <li ><a href="superAdmin-reglamento.html">Reglamento</a></li>
            </ul>
        </div>

    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="users form">
    <h1 class="page-header">Users</h1>
    <div class="table-responsive">
        <?php echo $this->Html->link( "New User",   array('action'=>'add'), array('escape' => false, 'class' => "btn btn-primary btn-lg")); ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('username', 'Username');?>  </th>
            <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
            <th><?php echo $this->Paginator->sort('user_type', 'Type');?></th>
            <th><?php echo $this->Paginator->sort('full_name','Name');?></th>
            <th><?php echo $this->Paginator->sort('active','Status');?></th>
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
                <?php echo $this->Html->link("Edit",   array('action'=>'edit', $user['User']['user_id']) ); ?> |
                <?php
                if( $user['User']['active'] != 0){
                    echo $this->Html->link(    "Deactivate", array('action'=>'deactivate', $user['User']['user_id']));}else{
                    echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['User']['user_id']));
                }
                ?>
            </td>
            </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
        </tbody>
    </table>
</div>
</div>