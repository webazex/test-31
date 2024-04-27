<?php
require_once get_template_directory().DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'autoload.php';
use Webazex\App\App as App;
add_action('acf/init', function (){
	$data = [
		'name' => 'contact-form',
		'title' => __('Contact form', 'dwt'),
		'description' => __('Contact form'),
		'category' => 'embed',
		'icon' => 'book-alt',
		'keywords' => ['Form', 'form', 'форма', 'Форма', 'Форма', 'форма', 'Contact form', 'contact form', 'Контактна форма', 'Контактная форма'],
		'post_types' => ['page'],
		'mode' => 'edit',
		'align' => 'full',
		'render_template' => App::getAcfGutenBlockSectionDir('contact-page-form'),
		'enqueue_assets' => function(){
			wp_enqueue_style( 'contact-form-theme', get_template_directory_uri() .'/inc/acf-gutenberg-blocks/contact-page-form/style.css' );
			wp_enqueue_script( 'contact-form-theme', get_template_directory_uri() . '/inc/acf-gutenberg-blocks/front-page-slider/scripts.js', ['jquery', 'slick-frontpage'], '', true );
		},
		'supports' => [
			'align' => false,
			'multiple' => true,
			'mode' => true
		]
	];
	acf_register_block_type($data);
});