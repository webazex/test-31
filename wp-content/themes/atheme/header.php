<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lunasima:wght@400;700&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body>
<header class="header">
	<div class="site-size">
		<div class="site-size__header-container">
			<div class="header-container__header-menu">
				<div class="header-menu__mobile-btn">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<?php
					wp_nav_menu( [
						'theme_location'  => 'header',
						'echo'            => true,
						'container' => false,
						'fallback_cb' => '__return_empty_string'
					] );
				?>
			</div>
		</div>
	</div>
</header>
