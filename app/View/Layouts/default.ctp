<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?= $title_for_layout; ?></title>

    <!-- Bootstrap core CSS -->
    <?= $this->Html->css(array(
    					'bootstrap.min',
    					'bootstrap-reset',
    					'font-awesome.min',
    					'style.css',
    					'style-responsive'
    					));?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  		<section id="container" >
  			<?= $this->element('admin/header');?>
  			<?= $this->element('admin/content');?>
  			<?= $this->element('admin/footer');?>
  	  	</section>
	
  
	<?= $this->Html->script(array(
							'jquery',
							'bootstrap.min',
							'jquery.scrollTo.min',
              'jquery.dcjqaccordion.2.7',
							'jquery.tagsinput',
							'common-scripts'
						));?>
	<?= $this->Html->script('global');?>
	<?= $this->fetch('script'); ?>
	<?= $this->element('sql_dump'); ?>
  </body>
</html>
