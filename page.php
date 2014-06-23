<?php 
/**
 * Page Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
	the_title();
	the_content();
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;

get_footer();
?>
