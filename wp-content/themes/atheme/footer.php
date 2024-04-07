<footer class="footer">
	<div class="site-size">
		<div class="site-size__footer-container">
			<?php
				wp_nav_menu( [
					'theme_location'  => 'footer',
					'echo'            => true,
					'container' => false,
					'depth' => 1,
					'fallback_cb' => '__return_empty_string'
				] );
			?>
		</div>
	</div>
</footer>
<?php wp_footer();?>
</body>
</html>
