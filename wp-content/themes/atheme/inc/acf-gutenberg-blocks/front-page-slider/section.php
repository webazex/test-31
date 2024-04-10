<?php
if ( ! empty( [] ) ):
	?>
	<section class="frontpage-slider">
		<div class="site-size">
			<div class="site-size__frontpage-slider-container default-container-padding">
				<div class="frontpage-slider-container__slider">
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
					<div class="slider__item">
						<span>Some text</span>
					</div>
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