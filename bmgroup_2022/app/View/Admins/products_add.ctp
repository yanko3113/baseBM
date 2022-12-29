<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'add' ? __('Agregar Producto') : __('Editar Producto'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php 
				echo $this->Nav->form('Product',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Producto',
								'desc' => 'Producto',
								'items' => array(
									'name' => array(
										'type' => 'text'
									),
									'slug' => array(
										'label' => 'URL (Nombre de Producto sin espacios, separados por guión)',
										'type' => 'text',
										'pattern'=>	"^[a-zA-Z0-9-_]+"
									),
									'category_id' => array(
										'label' => 'Categoría'
									),
									'code',
									'dimensions',
									'pdf_file' => array(
										'label' => 'Ficha Técnica',
										'cols' => 12,
										'type' => 'file',
									),
									'enabled' => array(
										'cols' => 12,
										'type' => 'checkbox'
									)
								)
							),
							array(
								'title' => 'Contenido',
								'desc' => 'Contenido',
								'items' => array(
									'description' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'specifications' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'confort_module' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'available_sizes' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'features' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'images' => array(
										'label' => 'Imágenes (Tamaño recomendado 508x678)',
										'type' => 'multi_upload',
										'cols' => 12,
										'model' => 'ProductImage',
										'max_files' => 4
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