<section class="panel">
	<header class="panel-heading">
		Adicionar Usuário
	</header>
	<div class="panel-body">
		<?= $this->Form->create('Group');?>
			<?= $this->Form->input('name');?>
		<?= $this->Form->end();?>
	</div>
</section>