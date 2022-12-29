<header>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav class="navbar navbar-expand-lg navbar-light">
					<a class="navbar-brand" href=""><?=$this->Html->image('office/images/quality-office.png',array('class'=>'img-fluid'))?></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
						<ul class="navbar-nav d-flex align-items-lg-center">
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'office_index')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'office_index'))?>">Nosotros</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'office_brands')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'office_brands'))?>">Nuestras Marcas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'office_products')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'office_products'))?>">Productos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'office_projects')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'office_projects'))?>">Proyectos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'blogs')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'blogs','office'))?>">Blog</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php echo (!empty($this->params['action']) && ($this->params['action'] == 'office_contact')) ? 'active' : '' ?>" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'office_contact'))?>">Contacto</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?=$this->Html->url(array('controller'=>'pages','action'=>'index'))?>">
									<?=$this->Html->image('office/images/varios/home-1.png',array('class'=>'icono-home'))?>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>