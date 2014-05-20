<!DOCTYPE HTML>
<html>
	<head>
		<title>sua.camera - sua festa por todos os ângulos!</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		
		
		
			<?= $this->Html->css(array(
					//'site/skel-noscript',
					'site/style',
					'site/style-wide',
					//'site/demo',
					//'site/fallback',
			));?>
		<noscript>
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>

<section id="menu">

	<header>
            <div align="right">
            <a href="painel.html"  class="fa fa-sign-in"></a>

            </div>
		</header>
		
</section>
		<!-- Header -->


			<section id="header" class="dark">

				<header>
                      <?= $this->Html->image('suacamera.png');?>        
					<p>#simples #rápido #automático</p>
				</header>

				<footer>
					<a href="#first" class="button scrolly">Como funciona?</a>
				</footer>

			</section>
			
		<!-- First -->
			<section id="first" class="main">
				<header>
					<div class="container">
						<h2>transforme todos os seus convidados em fotográfos!</h2>
                                                <p>nosso app faz com que cada convidado da sua festa seja um fotográfo oficial do seu evento <br />
                                                    basta postar sua foto no Instagram com a #hashtag do evento que nós exibiremos no telão em tempo real e imprimimos na hora</p>
					</div>
				</header>
				<div class="content dark style1 featured">
					<div class="container">
						<div class="row">
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-cloud-download"></span></span>
									<header>
										<h3>Baixe o <a href="http://instagram.com/">Instagram</a></h3>
									</header>
                                                                        <p>É muito fácil! <br />baixe e instale o instagram <br /> em seu smartphone</p>
								</section>
							</div>
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-camera"></span></span>
									<header>
										<h3>Publique suas fotos</h3>
									</header>
									<p>Adicione a #hashtag do evento<br/> nos títulos ou nos comentários <br/> Ex: #paulaefabricio</p>
								</section>
							</div>
							<div class="4u">
								<section>
									<span class="feature-icon"><span class="fa fa-print"></span></span>
									<header>
										<h3>Pronto!</h3>
									</header>
									<p>Automaticamente suas fotos serão exibidas no telão do evento e impressas na hora!</p>
								</section>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<footer>
									<a href="#second" class="button scrolly">Exemplo</a>
								</footer>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!-- Second -->

			<section id="second" class="main">

					<header>
					<div class="container">
						<h2>Nosso exemplo de exibição no telão do seu evento</h2>
					</div>
				</header>   
				<div class="content dark style2">      
					<div id="ri-grid" class="ri-grid ri-grid-size-2">
						<?= $this->Html->image('loading.gif');?>
					
					<ul>
						<?php for ($i=1; $i < 54; $i++):?>
								<li>
									<?= $this->Html->image('medium/'.$i.'.jpg');?>
								</li>
						<?php endfor; ?>
						<li><?= $this->Html->image('medium/1.jpg');?></li>
						<li><?= $this->Html->image('medium/2.jpg');?></li>
					</ul>

				    </div>

    					<div class="row">
							<div class="8u">
								<footer>
									<a href="#fourth" class="button scrolly">Eu quero</a>
								</footer>
							</div>
						</div>
				   </div>
			</section>
			
	
		
		<!-- Fourth -->
			<section id="fourth" class="main">
				<header>
					<div class="container">
						<h2>sua festa por todos os ângulos</h2>
						<p>solicite-nos uma proposta e deixe sua festa muito mais divertida!</p>
					</div>
				</header>
				<div class="content style4 featured">
					<div class="container small">
						<form method="post" action="#">
							<div class="row half">
								<div class="6u"><input type="text" class="text" placeholder="Nome" /></div>
								<div class="6u"><input type="text" class="text" placeholder="Email" /></div>
							</div>
							<div class="row half">
								<div class="12u"><textarea name="message" placeholder="Menssagem"></textarea></div>
							</div>
							<div class="row">
								<div class="12u">
									<ul class="actions">
										<li><input type="submit" class="button" value="Enviar" /></li>
										<li><input type="reset" class="button alt" value="Limpar" /></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			
		<!-- Footer -->
			<section id="footer">
				<ul class="icons">
                                        <li><a href="#" class="fa fa-instagram solo"><span>Instagram</span></a></li>
					<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
					<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
					<li><a href="#" class="fa fa-google-plus solo"><span>Google+</span></a></li>
					
				</ul>
				<div class="copyright">
					<ul class="menu">
						<li>&copy; sua.camera. Todos os direitos reservados.</li>
					</ul>
				</div>
			</section>
		
		<?= $this->Html->script(array(
							'site/modernizr.custom.26633.js',
							'site/jquery.min',
							'site/jquery.gridrotator',
							'site/skel.min.js',
							'site/init.js',
		));?>
		<script type="text/javascript">	
			$(function() {
			
				$( '#ri-grid' ).gridrotator( {
					rows		: 5,
					columns		: 11,
					animType	: 'fadeInOut',
					animSpeed	: 1000,
					interval	: 600,
					step		: 1,
					w320		: {
						rows	: 3,
						columns	: 4
					},
					w240		: {
						rows	: 3,
						columns	: 4
					}
				} );
			
			});
		</script>
	</body>
</html>