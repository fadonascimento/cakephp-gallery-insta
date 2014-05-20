<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
   
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Sua Camera</title>

    <!-- Bootstrap core CSS -->
    <?= $this->Html->css(array(
                            'bootstrap.min', 
                            'bootstrap-reset',
                            'style',
                            'style-responsive'));?>
   
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
        <?= $this->Session->flash(); ?>
        <?= $this->Session->flash('auth'); ?>
        <?= $this->fetch('content');?>
    </div>

    <?= $this->Html->script(array(
                              'jquery',
                              'bootstrap.min'
                              ));?>
  </body>
</html>
