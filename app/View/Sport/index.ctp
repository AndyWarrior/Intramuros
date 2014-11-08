<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li ><?php echo $this->Html->link( "Usuarios",   array('controller' => 'Users', 'action'=>'index') ); ?></li>
                <li class="active"><?php echo $this->Html->link( "Deportes",   array('Controller' => 'Sport', 'action'=>'index') ); ?></li>
                <li ><a href="superAdmin-reglamento.html">Reglamento</a></li>
            </ul>
        </div>

    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="users form">
    <h1 class="page-header">Users</h1>
    <div class="table-responsive">
        <?php echo $this->Html->link( "New Sport",   array('action'=>'add'), array('escape' => false, 'class' => "btn btn-primary btn-lg")); ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('sport_name', 'Sport Name');?>  </th>
            <th><?php echo $this->Paginator->sort('user_id', 'user Id');?></th>
            <th><?php echo $this->Paginator->sort('gender', 'Gender');?></th>
            <th><?php echo $this->Paginator->sort('total_category','Total Category');?></th>
            <th><?php echo $this->Paginator->sort('monday','monday');?></th>
            <th><?php echo $this->Paginator->sort('tuesday','tuesday');?></th>
            <th><?php echo $this->Paginator->sort('wednesday','wednesday');?></th>
            <th><?php echo $this->Paginator->sort('thursday','thursday');?></th>
            <th><?php echo $this->Paginator->sort('friday','friday');?></th>
            <th><?php echo $this->Paginator->sort('saturday','saturday');?></th>
            <th><?php echo $this->Paginator->sort('sunday','sunday');?></th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($sports as $sport): ?>
            <tr>
            <td><?php echo $sport['Sport']['sport_name']?></td>
            <td><?php echo $sport['Sport']['user_id']; ?></td>
            <td><?php echo $sport['Sport']['gender']; ?></td>
            <td><?php echo $sport['Sport']['total_category']; ?></td>
            <td><?php echo $sport['Sport']['monday']; ?></td>
            <td><?php echo $sport['Sport']['tuesday']; ?></td>
            <td><?php echo $sport['Sport']['wednesday']; ?></td>
            <td><?php echo $sport['Sport']['thursday']; ?></td>
            <td><?php echo $sport['Sport']['friday']; ?></td>
            <td><?php echo $sport['Sport']['saturday']; ?></td>
            <td><?php echo $sport['Sport']['sunday']; ?></td>
            <td >
                <?php echo $this->Html->link("Edit",   array('action'=>'edit', $sport['Sport']['sport_id']) ); ?> |
                <?php echo $this->Html->link("Delete", array('action'=>'delete', $sport['Sport']['sport_id'])); ?>
            </td>
            </tr>
        <?php endforeach; ?>
        <?php unset($sport); ?>
        </tbody>
    </table>
</div>
</div>