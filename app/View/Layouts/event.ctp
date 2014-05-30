<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?= $title_for_layout; ?></title>
   <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <?= $this->Html->css('global');?>
   
  </head>

  <body>
      <div class="wrapper">
          <header class="header">
            <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <h1 class="logo">Sua Camera</h1>
                </div>
                 <div class="col-lg-8">
                  <h2 class="title-event"><?= $title_for_layout; ?></h2>
                </div>
              </div>
            </div>
          </header>
      		<section class="container" >
        			<div class="row">
      			     <?= $this->fetch('content');?>
              </div>
      	  </section>
          <div class="push"></div>
      </div><!-- wrapper -->
      <footer class="footer"  >
        <div class="container">
          <div class="row">
            <p>Todos os direitos reservados</p>
          </div>
        </div>
      </footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<?= $this->Html->script('global');?>
	<?= $this->fetch('script'); ?>
	<?php $this->element('sql_dump'); ?>
  </body>
</html>