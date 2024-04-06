<?php
use Webazex\App\App as App;
function themeScripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri().'/src/js/jQuery3-7-1.min.js', [], '', [
		'in_footer' => true,
	]);
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('main', get_template_directory_uri().'/src/js/main.js', ['jquery'], false, [
		'in_footer' => true
	]);
}
add_action( 'wp_enqueue_scripts', 'themeScripts', 11 );
