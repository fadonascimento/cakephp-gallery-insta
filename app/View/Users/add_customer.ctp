<section class="panel">
	<header class="panel-heading">
		Cadastro de Clientes
	</header>
	<div class="panel-body">
		<?= $this->Form->create('User');?>
			<?= $this->Form->input('name',array('label'=>__('Nome')));?>
			<?= $this->Form->input('email');?>
			<?= $this->Form->input('phone',array('label'=> __('Telefone')));?>
			<?= $this->Form->hidden('group_id',array('value'=> CLIENTE));?>
		<?= $this->Form->end();?>
	</div>
</section>

