<div class="pictures index">
	<h2><?php echo __('Pictures'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('path'); ?></th>
			<th><?php echo $this->Paginator->sort('size'); ?></th>
			<th><?php echo $this->Paginator->sort('album_id'); ?></th>
			<th><?php echo $this->Paginator->sort('media_id'); ?></th>
			<th><?php echo $this->Paginator->sort('style'); ?></th>
			<th><?php echo $this->Paginator->sort('order'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($pictures as $picture): ?>
	<tr>
		<td><?php echo h($picture['Picture']['id']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['name']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['path']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['size']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($picture['Album']['title'], array('controller' => 'albuns', 'action' => 'view', $picture['Album']['id'])); ?>
		</td>
		<td><?php echo h($picture['Picture']['media_id']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['style']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['order']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['created']); ?>&nbsp;</td>
		<td><?php echo h($picture['Picture']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $picture['Picture']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $picture['Picture']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $picture['Picture']['id']), array(), __('Are you sure you want to delete # %s?', $picture['Picture']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Picture'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Albuns'), array('controller' => 'albuns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('controller' => 'albuns', 'action' => 'add')); ?> </li>
	</ul>
</div>
