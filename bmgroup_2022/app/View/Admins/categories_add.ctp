<div class="card-box">
	<h4 class="m-t-0 header-title"><?php echo $this->action == 'add' ? __('Agregar Categoria') : __('Editar Categoria'); ?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php 
				echo $this->Nav->form('Category',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Categoria',
								'desc' => 'Categoria',
								'items' => array(
									'name' => array(
										'type' => 'text'
									),
									'slug' => array(
										'label' => 'URL (Nombre de Categoría sin espacios, separados por guión)',
										'type' => 'text',
										'pattern'=>	"^[a-zA-Z0-9-_]+"
									),
									'company_id' => array(
										'label' => 'Empresa'
									),
									'parent_id' => array(
										'options' => $categories,
										'label' => 'Categoría Padre'
									),
									'template' => array(
										'label' => 'Estructura de Contenido',
										'type' => 'select',
										'options' => array(
											'_center_products_grid_1' => 'Grilla 1',
											'_center_products_content' => 'Contenido',
										)
									),
									'pdf_file' => array(
										'label' => 'Ficha Técnica',
										'cols' => 12,
										'type' => 'file',
									),
									'avatar' => array(
										'label' => 'Img Destacada',
										'cols' => 12,
										'type' => 'file',
										'img_default' => !empty($this->data['Category']['avatar']) ? $this->Nav->url("/upload/".$this->data['Category']['avatar']) : null
									),
									'featured' => array(
										'type' => 'checkbox',
									),
								)
							),
							array(
								'title' => 'Contenido',
								'desc' => 'Contenido',
								'items' => array(
									'body' => array(
										'type' => 'textarea',
										'cols' => 12
									),
									'images' => array(
										'label' => 'Slider (Tamaño recomendado 508x678)',
										'type' => 'multi_upload',
										'cols' => 12,
										'model' => 'CategoryImage',
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
<script type="text/javascript">
	window.addEventListener('load', function() {
		$("#CategoryTemplate").change(function() {
			console.log( $(this).val() );
			var id = $(this).val();
			$("#v-pills-1-tab").hide();
			if( id == '_center_products_content' ) {
				$("#v-pills-1-tab").show();
			}
		});

		$("#CategoryTemplate").trigger('change');
	});
</script>