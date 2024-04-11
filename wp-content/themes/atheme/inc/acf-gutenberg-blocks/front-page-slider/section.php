<?php
$dataSection = get_field('frontpage-slider');
$itemsCount = -1;
if(boolval($dataSection['show-status']) === false){
	$itemsCount = (!empty($dataSection['count'])) ? intval($dataSection['count']) : -1;
}
$works = getWorks(['count' => $itemsCount]);
if ( ! empty($works ) ):
	?>
	<section class="frontpage-slider">
		<div class="site-size">
			<div class="site-size__frontpage-slider-container default-container-padding">
				<?php if(!empty($dataSection['title'])):?>
				<h2 class="frontpage-slider-container__title-h2">
					<span class="title-h2__text">
						<?php echo $dataSection['title']; ?>
					</span>
				</h2>
				<?php endif;?>
				<?php if(!empty($dataSection['subtitle'])):?>
				<p class="frontpage-slider-container__subtitle">
					<?php echo $dataSection['subtitle'];?>
				</p>
				<?php endif;?>
				<div class="frontpage-slider-container__slider" data-count="<?php echo $itemsCount;?>">
					<?php foreach($works as $work):?>
						<a href="<?php echo $work['link']; ?>" class="slider__item">
							<div class="item__image-container">
								<?php if($work['src']):?>
									<img src="<?php echo $work['src']; ?>" alt="<?php echo $work['title'];?>">
								<?php endif; ?>
							</div>
							<div class="item__text-block">
								<span class="text-block__title">
									<?php echo $work['title']; ?>
								</span>
								<p class="text-block__excerpt">
									<?php echo $work['excerpt']; ?>
								</p>
								<div class="text-block__property">
									<div class="property__estimate">
										<span><?php _e('Термін: ', 'dwt');?></span>
										<span><?php echo $work['estimate'];?></span>
									</div>
									<div class="property__price">
										<span><?php _e('Ціна: ', 'dwt');?></span>
										<span><?php echo $work['price'];?></span>
									</div>
								</div>
								<div class="text-block__date">
									<span class="date__day">
										<?php echo $work['date']['day'];?>
									</span>
									<span class="date__month">
										<?php echo $work['date']['month'];?>
									</span>
									<span class="date__year">
										<?php echo $work['date']['year'];?>
									</span>
								</div>
							</div>
						</a>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</section>
<?php
else:
	get_template_part(
		'App'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'sections'.DIRECTORY_SEPARATOR.'empty',
		'', ['content' => "Роботи поки відсутні"]
	);
endif;
?>