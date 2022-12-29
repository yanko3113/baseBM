  <div class="newsletter">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="spannewsletter text-center">NEWSLETTER</p>
      </div>
      <div class="col-md-12">
        <form method="post">
          <div class="row">
            <div class="col-md-4 col-sm-12 form-group">
              <input type="text" name="nombre" placeholder="Nombre" class="text-center">
            </div>
            <div class="col-md-4 col-sm-12 form-group">
              <input type="email" name="email" placeholder="Email" class="text-center">
            </div>
            <div class="col-md-4 col-sm-12 form-group">
              <input type="submit" value="Suscribirme" class="btn btnsuscribir">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ICONO DE WHATSAPP -->
<section class="contenedor-whatsapp">
  <a class="btn-whatsapp" target="_blank" data-number="595981337093" data-message="Hola! Estoy escribiendo desde el sitio web de QUALITY CENTER" title="Escribinos al WhatsApp">
    <?php echo $this->Html->image('center/varios/whatsapp.png',array('class'=>'icono-whatsapp')); ?>
  </a>
</section>
<!-- FIN DE ICONO DE WHATSAPP -->
<footer>
  <div class="container mb-30">
    <div class="col-lg-12 col-md-12 mx-auto">
      <div class="row">
        <div class="col-md-2">
          <?php echo $this->Html->image('center/varios/logo-footer-quality-group.svg',array('class'=>'img-fluid logo-footer')); ?>
        </div>
        <div class="col-md-4">
          <ul class="columna-2">
            <li><a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'center_index'))?>">Nosotros</a></li>
            <li><a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'center_products'))?>">Secciones</a></li>
            <li><a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'center_services'))?>">Servicios</a></li>
            <li><a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'center_blog'))?>">Blog</a></li>
            <li><a href="<?=$this->Html->url(array('controller'=>'pages','action'=>'center_contact'))?>">Contacto</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <p>Quality Group</p>
          <a href="https://goo.gl/maps/YHWiWZJUErfEoRdF7" target="_blank">España 2065 esquina José Ribera</a>
          <p>Tel: 
            <a href="tel:+59521200222" title="Llamanos" class="d-inline-block mr-3">+595 21 200 222 </a>
            <a href="tel:+595981337093" title="Llamanos">+595 981 337093</a>
          </p>
        </div>
        <div class="col-md-2">
           <a href="https://www.facebook.com/qualitycenterpy" target="_blank">
            <?php echo $this->Html->image('fb.png',array('class'=>'img-fluid redes-sociales mt-3')); ?>
          </a>
          <a href="https://www.instagram.com/qualitycenterpy/" target="_blank">
            <?php echo $this->Html->image('ig.png',array('class'=>'img-fluid redes-sociales mt-3')); ?>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center desarrollado-por">
      <a href="https://linco.com.py/" target="_blank">desarrollado por  <?php echo $this->Html->image('center/varios/LINCO_logo.png'); ?></a>
    </div>
</footer>