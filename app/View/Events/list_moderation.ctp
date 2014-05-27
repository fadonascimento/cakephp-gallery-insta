<section class="panel">
	<header class="panel-heading">
		Moderar Imagens do evento <?= $event['name'];?>
	</header>
	<?= $this->Form->create('Event');?>
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr>
					<th><input type="checkbox"></th>
					<th>Image</th>
					<th>Tags</th>
					<th>likes</th>
					<th>Texto</th>
					<th>Criado</th>
					<th>Usuario</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($results as $result): ?>
					<tr>
						<td>
							<!-- <input type="checkbox" name="field_id" value="<?= $result->caption->text ?>"> -->
							<input type="checkbox" name="fields[]" value="<?= print_r((array)$result);?>">
						</td>
						<td><img src="<?= $result->images->thumbnail->url; ?>" alt="Imagem"></td>
						<td><?= join(',',$result->tags) ?></td>
						<td><?= $result->likes->count;?></td>
						<td><?= $result->caption->text;?></td>
						<td><?= date("d/m/Y H:m:i", $result->caption->created_time);?></td>
						<td><?= $result->caption->from->username;?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	<?= $this->Form->end();?>
</section>