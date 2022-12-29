<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'add' ? __('Agregar Servicio') : __('Editar Servicio'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php
				echo $this->Nav->form('Service',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Servicio',
								'desc' => 'Servicio',
								'items' => array(
									'name' => array(
										'type' => 'text'
									),
									'title' => [
										'type' => 'text'
									],
									'subtitle' => [
										'type' => 'text'
									],
									'mainsubtitle' => [
										'type' => 'text'
									],
									'services' => [
										'type' => 'textarea',
										'cols' => 12
									],
									'advantages' => [
										'type' => 'textarea',
										'cols' => 12
									],
									'image' => [
										'cols' => 12,
										'type' => 'file',
										'img_delete_url' => Router::url(array('controller'=>'admins','action'=>'delete_avatar', $this->data['Service']['id'])),
										'img_default' => !empty($this->data['Service']['image']) ? $this->Nav->url("/upload/".$this->data['Service']['image']) : null
									]

								)
							),
						)
					)
				);
			?>
		</div>
	</div>
</div>
