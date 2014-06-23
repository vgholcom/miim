<?php 
/**
 * Footer Template
 */
$option = get_option('miim_theme_options'); ?>
		</div><!-- container -->
	</section><!-- main-content -->
	<footer id="footer">
		<div class="container"><?php
			echo $option['miim_title'];
			echo $option['miim_street1'];
			echo $option['miim_street2'];
			echo $option['miim_city'];
			echo $option['miim_state'];
			echo $option['miim_zip'];
			echo $option['miim_phone'];
			echo $option['miim_email'];
			echo $option['miim_copyright']; ?>
		</div>
	</footer><?php
	wp_footer(); ?>
	</body>
</html>