<section class="panel">
	<header class="panel-heading">
		Editar Evento
	</header>
	<div class="panel-body">
		<?= $this->Form->create('Event');?>
			<?= $this->Form->input('id');?>
			<?= $this->Form->input('name',array('label'=>__('Nome')));?>
			<?= $this->Form->input('tags',array('id'=>'tags','div'=>false, 'class'=>'tagsinput'));?>
			<?= $this->Form->input('event_date',array('label'=> __('Data do evento')));?>
			<?= $this->Form->input('customer_id',array('label'=> __('Cliente')));?>
		<?= $this->Form->end(__('Salvar'));?>
	</div>
</section>
