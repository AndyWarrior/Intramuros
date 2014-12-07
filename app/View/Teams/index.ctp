<div class="container">
    <h1 class="page-header">Equipos</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Capitan</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($teams as $team): ?>
                <tr>

                    <td><i class="fa fa-trophy"></i>
                        <?php
                        echo $team['Team']['Team.name'];
                        ?>
                    </td>
                    <td><i class="fa fa-trophy"></i>
                        <?php
                        echo $team['Team']['std.name'];
                        ?>
                    </td>
                    <td><i class="fa fa-trophy"></i>
                        <?php
                        echo $team['Team']['Team.status'];
                        ?>
                    </td>
                    <td><i class="fa fa-trophy"></i>
                        <?php
                        echo $team['Team']['std.email'];
                        ?>
                    </td>


                </tr>
            <?php endforeach; ?>
            <?php unset($team); ?>
            </tbody>
        </table>
    </div>
</div>