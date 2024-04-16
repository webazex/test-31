<?php
$src = (!empty($args['src']))? $args['src'] : $args['placeholder'];
?>
<div class="site-size">
	<section class="work-article bg-properties-section">
		<div class="work-article__container-properties">

			<div class="container-properties__image-block">
				<?php if(!empty($src)):?>
					<img src="<?php echo $src;?>" alt="placeholder" class="image-block__work-image">
				<?php endif;?>
			</div>

			<div class="container-properties__properties-block">
				<?php if(!empty($args['estimate']) OR !empty($args['price'])): ?>
				<div class="properties-block__row-property"><?php echo $args['estimate'];?></div>
				<div class="properties-block__row-property"><?php echo $args['price'];?></div>
				<?php endif;?>
			</div>
		</div>
	</section>
</div>

