<?php
use Webazex\App\App as App;
if(!empty($args)): ?>
<div class="site-size">
	<section class="work-article bg-reviews-section work-review-section">
		<h2 class="work-review-section__title-h2">
			<span><?php _e('Відгуки до цєї роботи', 'dwt'); ?></span>
		</h2>
		<div class="work-article__container-reviews">
			<?php foreach ($args as $argsItem): $src = ($argsItem['src'] !== false) ? $argsItem['src'] : App::getPlaceholderImgUrl(); ?>
				<div class="container-reviews__review-item">
					<div class="review-item__image-block">
						<img src="<?php echo $src; ?>" alt="<?php echo $argsItem['title']; ?>" class="image-block__review-image">
					</div>
					<h3 class="review-item__title-h3">
						<span class="title-h3__text">
							<?php echo $argsItem['title']; ?>
						</span>
					</h3>
					<div class="review-item__excerpt">
						<?php echo $argsItem['excerpt']; ?>
					</div>
					<div class="review-item__date">
						<span>
							<?php echo $argsItem['date']['day']; ?>
						</span>
						<span>
							<?php echo $argsItem['date']['month']; ?>
						</span>
						<span>
							<?php echo $argsItem['date']['year']; ?>
						</span>
					</div>
					<a href="<?php echo $argsItem['link']; ?>" class="review-item__link">
						<span>
							<?php _e('Подивитись відгук', 'dwt');?>
						</span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
</div>
<?php else:
		get_template_part(
			'App'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'sections'.DIRECTORY_SEPARATOR.'empty',
			'', ['content' => "Відгуки поки відсутні"]
		);
endif;
?>