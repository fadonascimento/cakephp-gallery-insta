<section class="panel">
	<header class="panel-heading">
		Listagem Eventos
	</header>
	<table class="table table-striped table-advance table-hover">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('tags'); ?></th>
				<th><?php echo $this->Paginator->sort('event_date'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($events as $event): ?>
				<tr>
					<td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
					<td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
					<td><?php echo h($event['Event']['tags']); ?>&nbsp;</td>
					<td><?php echo h($event['Event']['event_date']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($event['Customer']['name'], array('controller' => 'users', 'action' => 'view', $event['Customer']['id'])); ?>
					</td>
					<td><?php echo h($event['Event']['created']); ?>&nbsp;</td>
					<td><?php echo h($event['Event']['modified']); ?>&nbsp;</td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), array(), __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?= $this->element('admin/paginator');?>
</section>