<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quality Center - <?=$title_for_layout?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <?php echo $this->Html->css('webstyle'); ?>
  <?php echo $this->Html->css('center/style'); ?>
  <?php echo $this->Html->css('center/responsive'); ?>
  <?php echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon')); ?>

  <?php
    if(!empty($metaData)) {
      foreach($metaData as $meta) {
        echo '<meta ';
        foreach($meta as $key => $val) {
          echo "{$key}=\"{$val}\" ";
        }
        echo "/>\n";
      }      
    }
  ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-98EZ817QBQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-98EZ817QBQ');
</script>
</head>

<body>
  <?php echo $this->element('center_header'); ?>
  <?php echo $content_for_layout; ?>

  <?php echo $this->element('center_footer'); ?>

  <?php echo $this->Html->script('chat-whatsapp'); ?>
  <script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>
</body>

</html>