<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-12">
        <form method="get" action="">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Nombre de Producto</label>
                    <input name="name" class="form-control" type="text" value="<?=!empty($_GET['name'])?$_GET['name']:null?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_add')); ?>" class="btn btn-large btn-success">Agregar producto</a>
            <table class="table table-responsive-sm mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($products as $product): ?>
                <tr>
                  <td><?=$product['Product']['id']?></td>
                  <td><?=$product['Product']['name']?></td>
                  <td>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_edit', $product['Product']['id'])); ?>" class="btn btn-primary">Editar</a>
                    <a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_delete', $product['Product']['id'])); ?>" class="btn btn-danger">Eliminar</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php echo $this->Nav->paginator(); ?>
          </div>
        </div>
    </div>
  </div>
</div>