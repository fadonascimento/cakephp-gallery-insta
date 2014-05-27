<div class="events view">
<h2><?php echo __('Event'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($event['Event']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($event['Event']['tags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Date'); ?></dt>
		<dd>
			<?php echo h($event['Event']['event_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['Customer']['name'], array('controller' => 'users', 'action' => 'view', $event['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($event['Event']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($event['Event']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<section class="panel">
	<header class="panel-heading">
		Albuns referente ao evento
	</header>
	<?php if (!empty($event['Album'])): ?>
	<table class="table table-striped table-advance table-hover">
		<thead>
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Default Name'); ?></th>
				<th><?php echo __('Path'); ?></th>
				<th><?php echo __('Model'); ?></th>
				<th><?php echo __('Event Id'); ?></th>
				<th><?php echo __('Tags'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($event['Album'] as $album): ?>
				<tr>
					<td><?php echo $album['id']; ?></td>
					<td><?php echo $album['title']; ?></td>
					<td><?php echo $album['default_name']; ?></td>
					<td><?php echo $album['path']; ?></td>
					<td><?php echo $album['model']; ?></td>
					<td><?php echo $album['event_id']; ?></td>
					<td><?php echo $album['tags']; ?></td>
					<td><?php echo $album['status']; ?></td>
					<td><?php echo $album['created']; ?></td>
					<td><?php echo $album['modified']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('Moderar'), array('controller' => 'albuns', 'action' => 'listModeration', $album['id'])); ?>
						<?php echo $this->Html->link(__('View'), array('controller' => 'albuns', 'action' => 'view', $album['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'albuns', 'action' => 'edit', $album['id'])); ?>
						
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</section>

