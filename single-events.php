<?php 
/**
 * Single Event Template
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1><?php 
	$id = get_the_ID();
	echo get_the_post_thumbnail($id, 'medium', array('class'=>'img-responsive'));?>
	<i><?php 
		$event_location = get_post_meta( $post->ID, '_event_location', true ); ?>
		<div class="content"><?php
				if (isset($event_location) && $event_location !='') { echo 'At '.$event_location.' on ';}
				eventposttype_get_the_event_date('_start'); ?></i>
			<?php the_content(); ?>
		</div><php
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;
get_footer();