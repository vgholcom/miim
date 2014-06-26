<?php 
/**
 * Single Video Template
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1><?php
	$values = get_post_custom( $post->ID );
	$selected = isset( $values['film_video'] ) ? $values['film_video'][0] : '';
	echo $selected;
	the_content();
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;
get_footer();