<?= $this->element('admin/aside');?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<?= $this->Session->flash(); ?>
			<?= $this->fetch('content'); ?>
		</div>
	</div>
  </section>
</section>