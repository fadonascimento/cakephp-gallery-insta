<section class="panel">
	<header class="panel-heading">
		Moderar Imagens do 
	</header>
	<?= $this->Form->create('Album');?>
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
				<?php foreach ($results as $key => $result): ?>
					<tr>
						<td>
							<input type="checkbox" name="data[Picture][<?=$key;?>][instagram_id]" value="<?= $result['caption']['id'] ?>">
							<textarea style="display:none;" name="data[Picture][<?=$key;?>][result]" id="" cols="30" rows="10"><?= json_encode($result);?></textarea>
						</td>
						<td><img src="<?= $result['images']['thumbnail']['url']; ?>" alt="Imagem"></td>
						<td><?= join(',',$result['tags']) ?></td>
						<td><?= $result['likes']['count'];?></td>
						<td><?= $result['caption']['text'];?></td>
						<td><?= date("d/m/Y H:m:i", $result['caption']['created_time']);?></td>
						<td><?= $result['caption']['from']['username']?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	<?= $this->Form->end();?>
</section>