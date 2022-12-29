<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'projects_add' ? __('Agregar Proyecto') : __('Editar Proyecto'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php 
				echo $this->Nav->form('Project',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Proyecto',
								'desc' => 'Proyecto',
								'items' => array(
									'name' => array(
										'type' => 'text'
									),
									'avatar' => array(
										'label' => 'Logotipo',
										'cols' => 12,
										'type' => 'file',
										'img_default' => !empty($this->data['Project']['avatar']) ? $this->Nav->url("/upload/".$this->data['Project']['avatar']) : null
									),
									'description' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'images' => array(
										'label' => 'Imágenes',
										'type' => 'multi_upload',
										'cols' => 12,
										'model' => 'ProjectImage',
									)
								)
							),
						)
					)
				); 
			?>
		</div>
	</div>
</div>