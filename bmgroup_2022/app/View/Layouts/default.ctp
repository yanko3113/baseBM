<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin - <?php echo $title_for_layout; ?></title>
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <?php echo $this->Html->css('style'); ?>
    <?php echo $this->Html->css('../vendors/@coreui/chartjs/css/coreui-chartjs'); ?>
    <?php echo $this->Html->css('dropzone.css'); ?>
    <?php echo $this->Html->css('jquery.growl.css'); ?>
    <?php echo $this->Html->css('bootstrap-tokenfield'); ?>
    <?php echo $this->Html->script('dropzone.js'); ?>
    <script src="https://kit.fontawesome.com/b54defd64c.js" crossorigin="anonymous"></script>
  </head>
  <?php echo $this->Session->flash(); ?>
  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-sidebar-brand d-lg-down-none">
		<?php echo $this->Session->read('Company.name'); ?>
      </div>
      <?php echo $this->element('sidebar/py'); ?>
      <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button><a class="c-header-brand d-lg-none" href="#">
          <?php echo $this->Session->read('Company.name'); ?></a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
        <ul class="c-header-nav d-md-down-none">
          <?php if($this->Session->read('Company.tag') == 'py'): ?>
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link btn btn-primary text-white" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'switch_company','bo')); ?>"><b>Ir a Bolivia</b></a></li>
          <?php else: ?>
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link btn btn-primary text-white" href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'switch_company','py')); ?>"><b>Ir a Paraguay</b></a></li>
        <?php endif; ?>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
          <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="c-avatar">
              	Cuenta
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
              <div class="dropdown-header bg-light py-2"><strong>Cuenta</strong></div>
				<a class="dropdown-item" href="<?php echo $this->Html->url(array('controller'=>'users','action'=>'logout')); ?>">
                <svg class="c-icon mr-2">
                  <use xlink:href="<?php echo Router::url('/'); ?>vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> Salir</a>
            </div>
          </li>
        </ul>
        <div class="c-subheader px-3">
          <!-- Breadcrumb-->
          <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="<?php echo $this->Html->url(array('controller'=>'admins','action'=>'index')); ?>">Inicio</a></li>
            <?php if(!empty($navbar)): ?>
            <?php foreach($navbar as $label => $nav): ?>
                <li class="breadcrumb-item"><?php echo $this->Html->link(__($label,true),$nav); ?></li>
            <?php endforeach; ?>
            <?php endif; ?>
            <li class="breadcrumb-item active"><?php echo $controller_action; ?></li>
            <!-- Breadcrumb Menu-->
          </ol>
        </div>
      </header>
      <div class="c-body">
        <main class="c-main">
          <div class="container-fluid">
            <div class="fade-in">
            	<?php echo $content_for_layout; ?>
            </div>
          </div>
        </main>
        <footer class="c-footer">
          <div><a href="https://linco.com.py">Linco</a> © <?=date("Y")?></div>
        </footer>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php echo $this->Html->script('../vendors/@coreui/coreui/js/coreui.bundle.min'); ?>
    <!--[if IE]><!-->
    <?php echo $this->Html->script('../vendors/@coreui/icons/js/svgxuse.min.js'); ?>
    <!--<![endif]-->
    <?php echo $this->Html->script('../vendors/@coreui/utils/js/coreui-utils.js'); ?>
    <?php echo $this->Html->script('bootstrap-tokenfield.min'); ?>
    <?php echo $this->element('froala'); ?>
    <?php echo $this->Html->script('jquery.growl.js'); ?>
    <?php echo $this->Html->script('app.js'); ?>
    <?php // echo $this->Html->script('main'); ?>
  </body>
</html>
