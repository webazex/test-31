<?php
get_header();
switch ($post->post_type){
	case "works":
		get_template_part('App/views/static/layouts/works', '', get_field('data', $post->ID));
		break;
	case "post":
		break;
	case "reviews":
		break;
	default:
		break;
}

get_footer();
?>