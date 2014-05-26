<section class="panel">
	<header class="panel-heading">
		Clientes
	</header>
	<table class="table table-striped table-advance table-hover">
		<thead>
			<tr>
				<th><i class="icon-bullhorn"></i> Company</th>
				<th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
				<th><i class="icon-bookmark"></i> Profit</th>
				<th><i class=" icon-edit"></i> Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($customers as $customer): ?>
				<?php $customer = $customer['User'];?>
				<tr>
					<td><?= $customer['name'] ?></td>
					<td><?= $customer['email'] ?></td>
					<td><?= $customer['phone'] ?></td>
					<td><span class="label label-info label-mini">Due</span></td>
					<td>
						<button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
						<button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
						<button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</section>