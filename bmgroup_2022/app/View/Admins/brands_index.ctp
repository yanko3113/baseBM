<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'brands_add')); ?>" class="btn btn-large btn-success">Crear Marca</a>
            <table class="table table-responsive-sm mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($brands as $brand): ?>
                <tr>
                  <td><?=$brand['Brand']['id']?></td>
                  <td><?=$brand['Brand']['name']?></td>
                  <td>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'brands_edit', $brand['Brand']['id'])); ?>" class="btn btn-primary">Editar</a>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'brands_delete', $brand['Brand']['id'])); ?>" class="btn btn-danger">Eliminar</a>
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