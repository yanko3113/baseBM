<!-- ICONO DE WHATSAPP -->
<section class="contenedor-whatsapp">
  <a class="btn-whatsapp" target="_blank" data-number="595981337093" data-message="Hola! Estoy escribiendo desde el sitio web de QUALITY GROUP" title="Escribinos al WhatsApp">
    <?php echo $this->Html->image('office/images/varios/whatsapp.png', array('class' => 'icono-whatsapp', 'title' => 'Escribinos al WhatsApp')); ?>
  </a>
</section>
<!-- FIN DE ICONO DE WHATSAPP -->
<footer>
  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-2">
          <?= $this->Html->image('logo-quality-footer.png', array('class' => 'img-fluid')) ?>
        </div>
        <div class="col-md-4">
          <ul class="columna-2">
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'office_index')) ?>">Nosotros</a></li>
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'office_brands')) ?>">Nuestras Marcas</a></li>
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'office_products')) ?>">Productos</a></li>
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'office_projects')) ?>">Proyectos</a></li>
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'blogs', 'blogs')) ?>">Blog</a></li>
            <li><a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'office_contact')) ?>">Contacto</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <p class="pfooter"><strong>Quality Group</strong><br>
            España 2065 esquina José Ribera<br>
            <strong>Tel:</strong> +595 21 200 222 - +595 981 337093
          </p>
        </div>
        <div class="col-md-2" style="padding-right:0;">
          <a href="https://www.facebook.com/qualityofficepy" target="_blank"><?= $this->Html->image('fb.png', array('class' => 'img-fluid', 'style' => 'margin-left:5px; margin-right:5px;')) ?></a>
          <a href="https://www.instagram.com/qualityoffice/" target="_blank"><?= $this->Html->image('ig.png', array('class' => 'img-fluid', 'style' => 'margin-left:5px; margin-right:5px;')) ?></a>
        </div>
      </div>
    </div>
  </div>
</footer>