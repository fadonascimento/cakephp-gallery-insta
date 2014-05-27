<?php $params = $this->Paginator->params(); ?>
<?php if (($params['pageCount'] > 1)): ?>
	<div class="pagination">
	 	<ul class="pager">
	 		<?php
	 		echo $this->Paginator->prev('« Anterior', array('tag'=>'li'), null, array('class' => 'disabled','tag'=>'li'));
	 		echo $this->Paginator->numbers(array('separator' => '','tag'=>'li'));
	 		echo $this->Paginator->next('Próximo »', array('tag'=>'li'), null, array('class' => 'disabled','tag'=>'li'));
	 		?>
	 	</ul>
		<p>
			<small><?= $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}, exibindo {:current} registros no total de {:count} registros.')));?></small>
		</p>
	</div><!-- pagination -->
<?php endif ?>


