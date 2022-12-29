<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'projects_add')); ?>" class="btn btn-large btn-success">Crear Proyecto</a>
            <table class="table table-responsive-sm mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($projects as $project): ?>
                <tr>
                  <td><?=$project['Project']['id']?></td>
                  <td><?=$project['Project']['name']?></td>
                  <td>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'projects_edit', $project['Project']['id'])); ?>" class="btn btn-primary">Editar</a>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'projects_delete', $project['Project']['id'])); ?>" class="btn btn-danger">Eliminar</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>