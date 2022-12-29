<section class="container servicio-item-interna">
	<div class="row my-5 <?=$service['Service']['css_interna']?>">
		<div class="col-12 col-xl-6">
			<div class="imagen-circular <?=$service['Service']['fondo_imagen']?>" data-aos="fade-in" data-aos-duration="2000">
				<?php if(!empty($service['Service']['image'])): ?>
				<?=$this->Html->image('/upload/'.$service['Service']['image'],['class'=>'img-fluid rounded-circle'])?>
				<?php else: ?>
				<img src="<?=Router::url('/')?>img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['tag']?>/imagen-principal.png" alt="<?=$service['Service']['tag']?>" class="img-fluid pulso">
				<?php endif; ?>
			</div>
		</div>
		<div class="col-12 col-xl-6">
			<div class="mt-100px">
				<img class="img-fluid <?=str_replace("_animated.svg", null, $service['Service']['linea'])?>" src="<?=Router::url('/')?>img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['linea']?>"></div>
				<h1 data-aos="fade-right" data-aos-duration="1500"><?=$service['Service']['title']?></h1>
				<img src="<?=Router::url('/')?>img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['tag']?>/<?=$service['Service']['fondo']?>" alt="BMPEOPLE" class="img-fluid my-2 <?=str_replace(".png",null,$service['Service']['fondo'])?>" data-aos="fade-right" data-aos-duration="2000">
				<p data-aos="fade-right" data-aos-duration="2500"><?=$service['Service']['subtitle']?></p>
			</div>
		</div>
	</div>
	<div class="row my-5 <?=$service['Service']['css_interna']?>">
		<div class="col-12 col-xl-5">
			<div class="mb-3 mb-xl-5" data-aos="fade-in" data-aos-duration="2000">
				<h2 class="titulo-servicio <?=$service['Service']['fondo_servicio']?>">Servicios</h2>
				<img class="img-fluid d-inline icono-telefono" src="<?=Router::url('/')?>/img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['tag']?>/icono-servicio.png">
			</div>
			<?=$service['Service']['services']?>
		</div>
		<div class="col-12 col-xl-2 d-none d-xl-block">
			<img src="<?=Router::url('/')?>img/bo/servicios/linea-verde_animated.svg" alt="linea" class="img-fluid d-block mx-auto aos-init aos-animate" style="max-height:550px;" data-aos="fade-in" data-aos-duration="1500">
		</div>
		<div class="col-12 col-xl-5 mt-3 mt-xl-0">
			<div class="mb-3 mb-xl-5" data-aos="fade-in" data-aos-duration="2000">
				<h2 class="titulo-servicio <?=$service['Service']['fondo_ventaja']?>">Ventajas</h2>
				<img class="img-fluid d-inline icono-telefono" src="<?=Router::url('/')?>/img/<?=$service['Company']['tag']?>/servicios/<?=$service['Service']['tag']?>/icono-ventajas.png">
			</div>
			<?=$service['Service']['advantages']?>
		</div>
	</div>
</section>
<!-- FIN DE BMPEOPLE -->
