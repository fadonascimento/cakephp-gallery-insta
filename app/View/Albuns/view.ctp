<div class="albuns view">
<h2><?php echo __('Album'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($album['Album']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($album['Album']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default Name'); ?></dt>
		<dd>
			<?php echo h($album['Album']['default_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($album['Album']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($album['Album']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($album['Event']['name'], array('controller' => 'events', 'action' => 'view', $album['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($album['Album']['tags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($album['Album']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($album['Album']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($album['Album']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<section class="panel">
	<header class="panel-heading">
		Imagens referentes ao Album
	</header>
	<?php if (!empty($album['Picture'])): ?>
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr>
					<th><?php echo __('Id'); ?></th>
					<th><?php echo __('Name'); ?></th>
					<th><?php echo __('Path'); ?></th>
					<th><?php echo __('Size'); ?></th>
					<th><?php echo __('Album Id'); ?></th>
					<th><?php echo __('Media Id'); ?></th>
					<th><?php echo __('Style'); ?></th>
					<th><?php echo __('Order'); ?></th>
					<th><?php echo __('Result'); ?></th>
					<th><?php echo __('Created'); ?></th>
					<th><?php echo __('Modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($album['Picture'] as $picture): ?>
					<tr>
						<td><?php echo $picture['id']; ?></td>
						<td><?php echo $picture['name']; ?></td>
						<td><?php echo $picture['path']; ?></td>
						<td><?php echo $picture['size']; ?></td>
						<td><?php echo $picture['album_id']; ?></td>
						<td><?php echo $picture['media_id']; ?></td>
						<td><?php echo $picture['style']; ?></td>
						<td><?php echo $picture['order']; ?></td>
						<td><?php echo $picture['result']; ?></td>
						<td><?php echo $picture['created']; ?></td>
						<td><?php echo $picture['modified']; ?></td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('controller' => 'pictures', 'action' => 'view', $picture['id'])); ?>
							<?php echo $this->Html->link(__('Edit'), array('controller' => 'pictures', 'action' => 'edit', $picture['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</section>

