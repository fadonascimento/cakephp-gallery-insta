<section class="panel">
	<header class="panel-heading">
		Adicionar Usuário
	</header>
	<div class="panel-body">
		<?= $this->Form->create('User');?>
			<?= $this->Form->input('id');?>
			<?= $this->Form->input('name');?>
			<?= $this->Form->input('email');?>
			<?= $this->Form->input('password');?>
		<?= $this->Form->end();?>
	</div>
</section>