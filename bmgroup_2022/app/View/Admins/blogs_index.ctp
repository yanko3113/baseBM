
  <div class="container-fluid">
    <div class="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'blogs_add')); ?>" class="btn btn-large btn-success">Crear Artículo</a>
              <table class="table table-responsive-sm mt-3">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Empresa</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($blogs as $blog): ?>
                  <tr>
                    <td><?=$blog['Blog']['id']?></td>
                    <td><?=$blog['Blog']['title']?></td>
                    <td><?=$blog['Company']['name']?></td>
                    <td>
                      <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'blogs_edit', $blog['Blog']['id'])); ?>" class="btn btn-primary">Editar</a>
                      <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'blogs_duplicate', $blog['Blog']['id'])); ?>" class="btn btn-info">Duplicar</a>
                      <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'blogs_delete', $blog['Blog']['id'])); ?>" class="btn btn-danger">Eliminar</a>
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
