  <header>
  	<div class="container">
  		<div class="row">
  			<div class="col-sm-12">
  				<nav class="navbar navbar-expand-lg navbar-light">
  					<a class="navbar-brand" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'center_index')); ?>">
  						<?php echo $this->Html->image('center/logo-quality-center.svg', array('class' => 'img-fluid', 'alt' => 'LOGO QUALITY OFFICE')); ?>
  					</a>
  					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  						<span class="navbar-toggler-icon"></span>
  					</button>
  					<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
  						<ul class="navbar-nav d-flex align-items-lg-center">
  							<li class="nav-item">
  								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'center_index')) ? 'active' : '' ?>" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'center_index')); ?>">Nosotros</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'center_products')) ? 'active' : '' ?>" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'center_products')); ?>">Secciones</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'center_services')) ? 'active' : '' ?>" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'center_services')); ?>">Servicios</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'blogs')) ? 'active' : '' ?> " href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'blogs', 'center')); ?>">Blog</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'center_contact')) ? 'active' : '' ?>" href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'center_contact')); ?>">Contacto</a>
  							</li>
  							<li class="nav-item">
  								<a class="nav-link" href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'index')) ?>">
  									<?= $this->Html->image('center/varios/home.png', array('class' => 'icono-home')) ?>
  								</a>
  							</li>
  						</ul>
  					</div>
  				</nav>
  			</div>
  		</div>
  	</div>
  </header>