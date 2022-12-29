<?php
	App::import('Model', 'Service');

	$this->Service = new Service;
	$hServices = $this->Service->find('all', [
		'conditions' => [
			'Company.tag' => $prefix
		]
	]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BMGROUP</title>
	<?=$this->Html->css("py/bootstrap.min")?>
	<?=$this->Html->css("py/aos")?>
	<?=$this->Html->css("py/estilos")?>
	<?=$this->Html->css("py/responsive")?>
	<?=$this->Html->meta('favicon.ico','favicon.ico',array('type' => 'icon'))?>
	<!-- PLUGIN DE WHATSAPP -->
	<?=$this->Html->css("../plugin/whatsapp-chat-support.css")?>

</head>
<body data-bs-spy="scroll" data-bs-target="#navbarBmgroup" data-bs-offset="0" class="scrollspy-example" tabindex="0">
	<!-- HEADER -->
	<header class="fixed-top">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-xl navbar-dark">
						<a class="navbar-brand" href="./">
							<img src="<?=Router::url('/')?>img/py/iconos/logo-bmgroup.svg" alt="LOGO BMGROUP" class="logo-amarillo-bmgroup">
						</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBmgroup" aria-controls="navbarBmgroup" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end" id="navbarBmgroup">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="./">INICIO</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#conocenos">CONOCENOS</a>
								</li>
								<div class="dropdown nav-item">
									<button class="btn dropdown-toggle nav-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">SERVICIOS</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
										<?php foreach($hServices as $hService): ?>
										<li class="dropdown-item" href="#">
											<a href="<?=$this->Html->url(['controller'=>'pages', 'action'=>$prefix.'_servicio', $hService['Service']['tag']])?>">
												<img src="<?=Router::url('/')?>img/<?=$prefix?>/servicios/<?=$hService['Service']['tag']?>/header-logo-<?=$hService['Service']['tag']?>.png" alt="logo" class="img-fluid">
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="https://jobs.jobconvo.com/es/careers/bmgroup-outsourcing/6bc9a3b3-c104-42a6-8d24-910075d04592/" target="_blank">CRECÉ CON NOSOTROS</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="#contacto">CONTACTO</a>
								</li>
								<li class="nav-item">
									<a target="_blank" href="https://www.facebook.com/BM-GROUP-Paraguay-101745008950243"><img src="<?=Router::url('/')?>img/py/iconos/facebook-naranja.svg" alt="FACEBOOK BMGROUP" class="redesmenu"></a>
								</li>
								<li class="nav-item">
									<a target="_blank" href="https://www.linkedin.com/company/bm-group-paraguay/"><img src="<?=Router::url('/')?>img/py/iconos/linkedin-naranja.svg" alt="LINKEDIN BMGROUP" class="redesmenu"></a>
								</li>
								<li class="nav-item">
									<a target="_blank" href="https://www.instagram.com/bmgroupparaguay/"><img src="<?=Router::url('/')?>img/py/iconos/instagram-naranja.svg" alt="INSTAGRAM BMGROUP" class="redesmenu"></a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- FIN DE HEADER -->

	<?=$content_for_layout?>

	<!-- FORMULARIO DE CONTACTO -->
	<section class="contacto mt-5" id="contacto">
		<div class="container">
			<div class="row mb-5">
				<div class="col-12 col-lg-6" data-aos="fade-in" data-aos-duration="2000">
					<h4>Contacto</h4>
					<img src="<?=Router::url('/')?>img/py/iconos/icono-telefono.png" alt="Icono telefono" class="img-fluid icono-telefono bounce">
				</div>
				<div class="col-12 col-lg-6 float-lg-end">
					<!-- BOTON DE WHATSAPP -->
					<div class="whatsapp_chat_support wcs_fixed_right" id="whatsappProducto">
						<div class="wcs_button_label">
							Escribinos
						</div>
						<div class="wcs_button wcs_button_circle">
							<span class="fa fa-whatsapp"></span>
						</div>
						<div class="wcs_popup">
							<div class="wcs_popup_close">
								<span class="fa fa-close"></span>
							</div>
							<div class="wcs_popup_header">
								<strong>Escribinos</strong>
								<br>
								<div class="wcs_popup_header_description"></div>
							</div>
							<div class="wcs_popup_person_container">
								<div class="wcs_popup_person" data-number="<?=$prefix=='py'?'595986338238':'59169831771'?>" data-availability='{ "monday":"07:00-17:00", "tuesday":"07:00-17:00", "wednesday":"07:00-17:00", "thursday":"07:00-17:00", "friday":"07:00-17:00","saturday":"08:00-12:00" }'>
									<div class="wcs_popup_person_img">
										<img src="<?=Router::url('/')?>img/py/iconos/whatsapp-azul.svg" alt="ICONO">
									</div>
									<div class="wcs_popup_person_content">
										<div class="wcs_popup_person_name"></div>
										<div class="wcs_popup_person_description"></div>
										<div class="wcs_popup_person_status">Estoy conectado</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- FIN DE BOTON DE WHATSAPP -->
				</div>
			</div>
			<div class="row" data-aos="fade-in" data-aos-duration="2000">
				<div class="col-12">
					<form action="<?=$this->Html->url(['controller'=>'pages','action'=>'ajax_send'])?>" method="POST" id="formularioContacto">
						<input type="text" name="nombre" placeholder="Nombre y Apellido:" required class="form-control mb-4">
						<input type="email" name="correo" placeholder="Email:" required class="form-control mb-4">
						<input type="number" name="telefono" placeholder="Teléfono:" required class="form-control mb-4">
						<input type="hidden" name="country" value="<?=$prefix?>">
						<?php if(!empty($service)): ?>
							<input type="hidden" name="type" value="<?=$service['Service']['name']?>">
						<?php endif; ?>
						<textarea name="mensaje" placeholder="Mensaje / Consulta:" required class="form-control mb-4"></textarea>
						<!--div class="g-recaptcha" data-sitekey="6Ld-kkIeAAAAAFtmI34169Ze1r9q2_2BGT35ClVT"></div!-->
						<input type="submit" class="form-control mt-3" id="btnEnviar" value="ENVIAR">
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- FIN DE FORMULARIO DE CONTACTO -->

	<!-- FOOTER -->
	<footer class="container mt-5">
		<div class="row">
			<div class="col-12 col-sm-6 mb-1 mb-sm-0 d-flex align-items-center">
				<img src="<?=Router::url('/')?>img/py/iconos/bmgroup-footer.png" alt="bmgroup" class="img-fluid">
			</div>
			<div class="col-12 col-sm-6" data-aos="fade-in" data-aos-duration="2000">
				<div class="redes-sociales float-sm-end">
					<?php if($prefix=='py'): ?>
					<a target="_blank" href="https://www.facebook.com/BM-GROUP-Paraguay-101745008950243">
						<img src="<?=Router::url('/')?>img/py/iconos/facebook.png" alt="Facebook">
					</a>
					<a target="_blank" href="https://www.instagram.com/bmgroupparaguay/">
						<img src="<?=Router::url('/')?>img/py/iconos/instagram.png" alt="Instagram">
					</a>
					<a target="_blank" href="https://www.linkedin.com/company/bm-group-paraguay/">
						<img src="<?=Router::url('/')?>img/py/iconos/linkedin.png" alt="Linkedin">
					</a>
					<?php else: ?>
					<a target="_blank" href="https://www.facebook.com/BMGROUPBOLIVIA/">
						<img src="<?=Router::url('/')?>img/py/iconos/facebook.png" alt="Facebook">
					</a>
					<a target="_blank" href="https://www.instagram.com/bmgroupbolivia/">
						<img src="<?=Router::url('/')?>img/py/iconos/instagram.png" alt="Instagram">
					</a>
					<a target="_blank" href="https://www.linkedin.com/company/bmgroupbolivia/">
						<img src="<?=Router::url('/')?>img/py/iconos/linkedin.png" alt="Linkedin">
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row" data-aos="fade-in" data-aos-duration="2000">
			<div class="col-12 mb-5">
				<img src="<?=Router::url('/')?>img/py/servicios/banner-footer.png" alt="Footer" class="img-fluid d-block mx-auto">
			</div>
			<!-- OFICINA LA PAZ • Edificio López Azero -->
			<div class="col-12 col-lg-6 my-3 borde-azul">
				<p class="direccion" href="#">
				<h5>OFICINA LA PAZ • Edificio López Azero
					<img src="<?=Router::url('/')?>img/py/iconos/bandera-bo-min.png" alt="BANDERA BOLIVIA BMGROUP" class="d-inline-block">
				</h5>
				</p>
				<p class="d-inline" href="#">Av. Julio Patiño N° 1366, Calacoto.</p><br>
				<p class="d-inline" href="#">Piso 3 • Oficina 305 •</p>
				<a class="d-inline" href="tel:+59122771922" title="Llamar">Tel.: (591 2) 2771922 / 2770825</a>
			</div>
			<!-- OFICINA COCHABAMBA • Edificio Seleme -->
			<div class="col-12 col-lg-6 my-3">
				<p class="direccion" href="#">
				<h5>OFICINA COCHABAMBA • Edificio Seleme
					<img src="<?=Router::url('/')?>img/py/iconos/bandera-bo-min.png" alt="BANDERA BOLIVIA BMGROUP" class="d-inline-block">
				</h5>
				</p>
				<p class="d-inline" href="#">Teniente Arévalo y Junín 909</p><br>
				<p class="d-inline" href="#">Planta Baja • </p>
				<a class="d-inline" href="tel:+59144663492" title="Llamar">Tel.: (591 4) 4663492</a>
			</div>
			<!-- OFICINA SANTA CRUZ • Edificio Torres Cainco -->
			<div class="col-12 col-lg-6 my-3 borde-azul">
				<p class="direccion" href="#">
				<h5>OFICINA SANTA CRUZ • Edificio Torres Cainco
					<img src="<?=Router::url('/')?>img/py/iconos/bandera-bo-min.png" alt="BANDERA BOLIVIA BMGROUP" class="d-inline-block">
				</h5>
				</p>
				<p class="d-inline" href="#">Cochabamba esq. Saavedra • Bloque Empresarial</p><br>
				<p class="d-inline" href="#">Piso 8 • Oficina 1 • </p>
				<a class="d-inline" href="tel:+59133122645" title="Llamar">Tel.: (591 3) 3122645</a>
			</div>
			<!-- OFICINA ASUNCIÓN • Edificio SkyPARK -->
			<div class="col-12 col-lg-6 my-3">
				<p class="direccion">
				<h5>OFICINA ASUNCIÓN • Edificio SkyPARK
					<img src="<?=Router::url('/')?>img/py/iconos/bandera-py-min.png" alt="BANDERA PARAGUAY BMGROUP" class="d-inline-block">
				</h5>
				</p>
				<a class="d-inline" href="https://goo.gl/maps/Py43XPaSuCB3s74W9" target="_blank">Aviadores del Chaco N° 2581 c/ Tte. Oddone</a> <br>
				<p class="d-inline">Torre 1 • Piso 13 • Oficina C •</p>
				<a class="d-inline" href="tel:+59521605454" title="Llamar">Tel.: (021) 605 454</a>
			</div>
		</div>
		<div class="row mt-3 mt-lg-0">
			<div class="col-12 desarrollado-por">
				<a href="https://www.linco.com.py/" target="_blank">desarrollado por <img src="<?=Router::url('/')?>img/py/iconos/LINCO_logo.png" alt="LINCO"></a>
			</div>
		</div>
	</footer>
	<!-- FIN DE FOOTER -->

	<!-- MODAL -->
	<div class="modal" tabindex="-1" id="modalContacto">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Información</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p id="modalTexto"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-bs-dismiss="modal">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- FIN DE MODAL -->

	<script src="<?=Router::url('/')?>js/jquery.min.js"></script>
	<script src="<?=Router::url('/')?>js/bootstrap.min.js"></script>
	<script src="<?=Router::url('/')?>js/aos.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- PLUGIN DE WHATSAPP -->
	<script src="<?=Router::url('/')?>plugin/components/jQuery/jquery-1.11.3.min.js"></script>
	<script src="<?=Router::url('/')?>plugin/components/moment/moment.min.js"></script>
	<script src="<?=Router::url('/')?>plugin/components/moment/moment-timezone-with-data.min.js"></script>
	<script src="<?=Router::url('/')?>plugin/whatsapp-chat-support.js"></script>
	<script>
		AOS.init();
		$('#whatsappProducto').whatsappChatSupport({
			// Options
			notAvailableMsg: 'No estoy disponible hoy',
			almostAvailableMsg: 'Estaré disponible pronto',
			dialogNotAvailableMsg: 'No estoy disponible hoy',
			dialogAlmostAvailableMsg: 'Estaré disponible pronto',
			defaultMsg: 'Hola, estoy escribiendo desde la web de BMGROUP',
		});
	</script>
	<script>
		$(document).ready(function() {
			/*========= FORMULARIO DE CONTACTO ============== */
			$("#formularioContacto").submit(function(event) {
				event.preventDefault();
				/*var txtCaptcha = grecaptcha.getResponse();
				if (txtCaptcha.length == 0) {
					$("#modalTexto").text("Debe seleccionar que no es un robot");
					$("#modalContacto").modal('show');
					return false;
				}*/
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
					beforeSend: function() {
						$("#btnEnviar").val("Enviando ...");
						$("#btnEnviar").attr("disabled", "disabled").css("cursor", "none");
					},
					success: function(respuesta) {
						$("#btnEnviar").val("ENVIAR");
						$("#btnEnviar").removeAttr("disabled").css("cursor", "pointer");
						$("#modalTexto").text(respuesta);
						$("#modalContacto").modal('show');
						grecaptcha.reset();
						if (respuesta == "Su mensaje fue enviado correctamente, en breve un representante se pondrá en contacto con usted.") {
							$("#formularioContacto")[0].reset();
						}
					}
				});
			});
		});
	</script>
	<script src="<?=Router::url('/')?>js/main2.js"></script>
</body>

</html>
