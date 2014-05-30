<div class="header-tag">
	<h2 class="title-tag">
		<span class="glyphicon glyphicon-tag"></span>
		<span class="text"><?= $event['Album']['tags'];?></span> 
	</h2>
</div>

<div class="content-list-pictures clearfix">
	
	<?php foreach ($event['Picture'] as $picture): ?>
		<?php $picture = json_decode($picture['result']);?>

		<div class="col-lg-3">
			<div class="photos-wrapper">
		        <p class="pseudo">
		        	<a target="_blank" href="http://instagram.com/<?= $picture->user->username; ?>"><?= $picture->user->full_name; ?></a>
		        </p>
			    <div class="image-wrapper">
			        <a target="_blank" href="<?= $picture->link;?>" class="link-photo">
			        	<img class="img-responsive" src="<?= $picture->images->low_resolution->url; ?>">
			        </a>
			    </div>
		    	<div class="activites">
			        <span class="ss-heart"></span>
			        <span class="score_heart"><?= $picture->likes->count; ?></span>
		        </div>
			</div>
		</div>
	<?php endforeach ?>
	
</div>
