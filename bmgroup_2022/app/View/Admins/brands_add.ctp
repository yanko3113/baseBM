<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'brands_add' ? __('Agregar Marca') : __('Editar Marca'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php 
				echo $this->Nav->form('Brand',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Marca',
								'desc' => 'Marca',
								'items' => array(
									'name' => array(
										'type' => 'text'
									),
									'category_id',
									'avatar' => array(
										'label' => 'Logotipo',
										'cols' => 12,
										'type' => 'file',
										'img_default' => !empty($this->data['Brand']['avatar']) ? $this->Nav->url("/upload/".$this->data['Brand']['avatar']) : null
									),
									'description' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'images' => array(
										'label' => 'Imágenes',
										'type' => 'multi_upload',
										'cols' => 12,
										'model' => 'BrandImage',
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