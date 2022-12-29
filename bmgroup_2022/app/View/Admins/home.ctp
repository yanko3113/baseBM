<div class="card-box">
	<h4 class="m-t-0 header-title">Página Principal <?=$this->request->data['Company']['name']?></h4>
	<div class="row m-t-10">
		<div class="col-md-12">
			<?php
				echo $this->Nav->form('Company',
					array(
						'title' => '',
						'groups' => array(
							array(
								'title' => 'Configuración',
								'desc' => 'Configuración',
								'items' => array(
									'id' => [
										'type' => 'hidden'
									],
									'us' => array(
										'label' => 'Quienes Somos',
										'type' => 'textarea',
										'cols' => 12
									),
									'count_countries' => [
										'label' => 'Presencia en Paises',
										'cols' => 4
									],
									'count_customers' => [
										'label' => 'Cantidad de Clientes',
										'cols' => 4
									],
									'count_jobs' => [
										'label' => 'Puestos Generados al Año',
										'cols' => 4
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
