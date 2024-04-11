<?php
require_once get_template_directory().DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'autoload.php';
use Webazex\App\App as App;
add_action('acf/init', function (){
	$data = [
		'name' => 'homepage-slider',
		'title' => __('Frontpage slider', 'dwt'),
		'description' => __('Slider for homepage'),
		'category' => 'embed',
		'icon' => 'book-alt',
		'keywords' => ['Slider', 'slider', 'слайдер', 'Слайдер', 'Слайдер', 'слайдер'],
		'post_types' => ['page'],
		'mode' => 'edit',
		'align' => 'full',
		'render_template' => App::getAcfGutenBlockSectionDir('front-page-slider'),
		'enqueue_assets' => function(){
			wp_enqueue_style( 'slider-frontpage', get_template_directory_uri() .'/inc/acf-gutenberg-blocks/front-page-slider/style.css' );
			wp_enqueue_style( 'slick-frontpage', get_template_directory_uri() .'/inc/acf-gutenberg-blocks/front-page-slider/slick/slick.css' );
			wp_enqueue_style( 'slick-theme-frontpage', get_template_directory_uri() .'/inc/acf-gutenberg-blocks/front-page-slider/slick/slick-theme.css' );
			wp_enqueue_script( 'slick-frontpage', get_template_directory_uri() . '/inc/acf-gutenberg-blocks/front-page-slider/slick/slick.min.js', ['jquery', 'main'], '', true );
			wp_enqueue_script( 'slider-frontpage', get_template_directory_uri() . '/inc/acf-gutenberg-blocks/front-page-slider/scripts.js', ['jquery', 'main', 'slick-frontpage'], '', true );
		},
		'supports' => [
			'align' => false,
			'multiple' => true,
			'mode' => true
		]
	];
	acf_register_block_type($data);
});