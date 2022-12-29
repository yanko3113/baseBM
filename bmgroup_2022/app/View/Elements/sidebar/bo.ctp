<ul class="c-sidebar-nav">
	<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
			</svg> Inicio</a></li>
	<li class="c-sidebar-nav-title">Secciones</li>
	<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'office_nosotros')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
			</svg> Nosotros</a></li>
	<li class="c-sidebar-nav-title">Productos</li>
	<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'products_index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-tag"></use>
			</svg> Productos</a></li>
	<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'categories_index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-tag"></use>
			</svg> Categorías</a></li>
<li class="c-sidebar-nav-title">Marcas</li>
<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'brands_index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-tag"></use>
			</svg> Marcas</a></li>
	<li class="c-sidebar-nav-title">Proyectos</li>
	<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'projects_index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-tag"></use>
			</svg> Proyectos</a></li>
<li class="c-sidebar-nav-title">Blog</li>
<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'blogs_index')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
			</svg> Artículos</a></li>

<li class="c-sidebar-nav-title">Reportes</li>
<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'form_entries')); ?>">
			<svg class="c-sidebar-nav-icon">
				<use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-bar-chart"></use>
			</svg> Formularios</a></li>
</ul>