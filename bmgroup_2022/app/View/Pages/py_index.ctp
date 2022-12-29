<!-- CAROUSEL -->
<div id="carouselHome" class="carousel slide carousel-home" data-bs-ride="carousel">
	<div class="carousel-inner">
		<?php foreach($carousel as $i => $image): ?>
		<div class="carousel-item <?=$i==0?'active':null?>">
			<?=$this->Html->image("../upload/{$image['Slider']['file']}",['alt'=>'banner'])?>
			<div class="info1">
				<h1 class="mb-5">El trabajo te hace crecer.</h1>
				<a href="#servicios">Nuestros servicios</a>
				<a href="#buscador">Busqueda de trabajo</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselHome" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselHome" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>
<!-- FIN DE CAROUSEL -->

<!-- FIN DE VIDEO DE FONDO -->
<!-- BM GROUP CREEMOS FIRMEMENTE QUE EL TRABAJO TE HACE CRECER -->
<section id="conocenos">
	<div class="bg-titulo">
		<div class="titulo-descripcion" data-aos="fade-in" data-aos-duration="2000">
			<h1>BM Group, <span>creemos firmemente que</span> el trabajo te hace crecer.</h1>
		</div>
	</div>
	<div class="bg-circulo">
		<div class="container">
			<div class="col-12 col-lg-10 mx-auto">
				<?=$company['Company']['us']?>
			</div>
		</div>
	</div>
	</div>
</section>
<!-- FIN BM GROUP CREEMOS FIRMEMENTE QUE EL TRABAJO TE HACE CRECER -->
<!-- SERVICIOS -->
<section class="container servicios" id="servicios">
	<div class="row">
		<div class="col-12">
			<h4 class="my-3 mb-sm-5" data-aos="fade-in" data-aos-duration="2000">SERVICIOS</h4>
		</div>
	</div>
	<div class="row">
		<?php foreach($services as $service): ?>
		<div style="margin:0 auto" class="col-12 col-lg-4" data-aos="fade-in" data-aos-duration="2000" data-aos-delay="100">
			<div class="servicio-item">
				<a href="<?=$this->Html->url(['action'=>$service['Company']['tag'].'_servicio', $service['Service']['tag']])?>">
					<div class="bg-servicio <?=$service['Service']['color']?>">
						<?php if(empty($service['Service']['image'])): ?>
						<img src="<?=Router::url('/')?>img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['tag']?>/imagen-principal.png" alt="<?=$service['Service']['name']?>" class="img-fluid" id="servicioBmPeople">
						<?php else: ?>
							<?=$this->Html->image('/upload/'.$service['Service']['image'],['class'=>'img-fluid rounded-circle'])?>
						<?php endif; ?>
					</div>
					<img src="<?=Router::url('/')?>img/py/servicios/logo-<?=$service['Service']['tag']?>.png" alt="LOGO SERVICIOS" class="logo" data-aos="fade-in" data-aos-duration="1000">
					<h5 class="titulo-gris" data-aos="fade-in" data-aos-duration="1000"><?=$service['Service']['mainsubtitle']?></h5>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>
<!-- FIN DE SERVICIOS -->
<!-- BM GROUP QUEREMOS CRECER CONTIGO -->
<section class="bg-celeste" id="crece">
	<div class="container">
		<div class="row">
			<div class="col-12" data-aos="fade-in" data-aos-duration="2000">
				<h1>BM Group, queremos crecer contigo.</h1>
			</div>
		</div>
		<div class="row mt-4" data-aos="fade-in" data-aos-duration="500">
			<div class="col-12 col-sm-6 col-md-4" data-aos="fade-in" data-aos-duration="600">
				<span class="counter" data-count="<?=$company['Company']['count_countries']?>">0</span>
				<p>Presencia en países</p>
			</div>
			<div class="col-12 col-sm-6 col-md-4" data-aos="fade-in" data-aos-duration="700">
				<span class="counter mas" data-count="<?=$company['Company']['count_customers']?>">0</span>
				<p>Clientes</p>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<span class="counter mas" data-count="<?=$company['Company']['count_jobs']?>">0</span>
				<p>Puestos generados al año</p>
			</div>
		</div>
	</div>
</section>
<!-- FIN DE BM GROUP QUEREMOS CRECER CONTIGO -->
<!-- BUSCADOR -->
<section class="bg-amarillo" id="buscador">
	<div class="container">
		<div class="row">
			<div class="col-12" data-aos="fade-in" data-aos-duration="2000">
				<h3>Usa nuestro buscador para encontrar esa oportunidad laboral con la que sueñas para seguir desarrollando tu carrera, o para encontrar el talento que necesita tu empresa y potenciar tu negocio.</h3>
				<a target="_blank" href="https://jobs.jobconvo.com/es/careers/bmgroup-outsourcing/6bc9a3b3-c104-42a6-8d24-910075d04592/" class="btn-buscador">Buscador</a>
			</div>
		</div>
	</div>
</section>
<!-- FIN DE BUSCADOR -->
