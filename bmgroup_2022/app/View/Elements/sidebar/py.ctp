<?php
	$prefix = $this->Session->read('Company.tag');
?>
<ul class="c-sidebar-nav">
  <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'index')); ?>">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
      </svg> Inicio</a></li>
  <li class="c-sidebar-nav-title">Secciones</li>
  <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'sliders', $prefix)); ?>">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
      </svg> Sliders</a></li>
  <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'servicios', $prefix)); ?>">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
      </svg> Servicios</a></li>

  <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'home', $prefix)); ?>">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
      </svg> Página de Inicio</a></li>


<li class="c-sidebar-nav-title">Reportes</li>
<li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'form_entries')); ?>">
      <svg class="c-sidebar-nav-icon">
        <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-bar-chart"></use>
      </svg> Formularios</a></li>
</ul>
