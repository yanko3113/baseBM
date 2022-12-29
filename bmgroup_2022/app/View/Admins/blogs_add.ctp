<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'add' ? __('Agregar Entrada') : __('Editar Entrada'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php 
				echo $this->Nav->form('Blog',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Entrada',
								'desc' => 'Entrada',
								'items' => array(
									'avatar' => array(
										'label' => 'Img Principal',
										'cols' => 12,
										'type' => 'file',
										'img_default' => !empty($this->data['Blog']['avatar']) ? $this->Nav->url("/upload/".$this->data['Blog']['avatar']) : null
									),
									'title' => array(
										'type' => 'text'
									),
									'company_id' => array(
										'label' => 'Empresa'
									),
									'short_body' => array(
										'label' => 'Descripción de vista previa',
										'type' => 'simple_textarea',
										'cols' => 12,
									),
									'body' => array(
										'label' => 'Contenido del Artículo',
										'type' => 'textarea',
										'cols' => 12,
									),
								)
							),
						)
					)
				); 
			?>
		</div>
	</div>
</div>