<?php
use Webazex\App\App as App;
?>
<article class="wbzx-article work-article">
	<div class="site-size">
		<div class="site-size__work-article-container">
			<?php if(!empty($post->post_title)):?>
			<h1 class="work-article-container__title-h1">
				<span class="title-h1__text">
					<?php echo $post->post_title; ?>
				</span>
			</h1>
			<?php endif; ?>
		</div>
	</div>
	<?php if(!empty($args['estimate']) OR !empty($args['price'])):?>
		<?php get_template_part('App/views/static/sections/single-work-properties', '', [
			'estimate' => $args['estimate'],
			'price' => $args['price'],
			'src' => get_the_post_thumbnail_url($post->ID, 'full'),
			'placeholder' => App::getPlaceholderImgUrl()
		]);
		?>
	<?php endif;?>
	<div class="site-size">
		<div class="site-size__work-article-container">
			<div class="work-article-container__content">
				<?php echo $post->post_content; ?>
			</div>
		</div>
	</div>
	<?php if(!empty($args['reviews'])): ?>
		<?php get_template_part('App/views/static/sections/single-work-reviews', '', App::fetchAcfReviews($args['reviews']));?>
	<?php endif;?>
</article>
