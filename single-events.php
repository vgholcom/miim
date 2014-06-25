<?php 
/**
 * Single Event Template
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<i><?php 
		$event_location = get_post_meta( $post->ID, '_event_location', true );
		if (isset($event_location) && $event_location !='') { echo 'At '.$event_location.' on ';}
		eventposttype_get_the_event_date('_start'); ?></i>
	<?php the_content();
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;
get_footer();