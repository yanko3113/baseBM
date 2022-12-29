<div class="container-fluid">
	<div class="fade-in">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<!--a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_add')); ?>" class="btn btn-large btn-success">Agregar producto</a!-->
						<table class="table table-responsive-sm mt-3">
							<thead>
								<tr>
									<th>Servicio</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($services as $service): ?>
								<tr>
									<td><?=$service['Service']['name']?></td>
									<td>
										<a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'servicios_edit', $service['Service']['id'])); ?>" class="btn btn-primary">Editar</a>
										<!--a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_delete', $service['Service']['id'])); ?>" class="btn btn-danger">Eliminar</a!-->
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
