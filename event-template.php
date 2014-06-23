<?php
/**
 * Template Name: Event Page 
 *
 */
get_header();
$args = array(
	'post_type' => 'events',
	'meta_key' => '_start_eventtimestamp',
	'orderby'=> 'meta_value_num',
	'order' => 'ASC',
);
$events = new WP_Query( $args );
while ( $events->have_posts() ) : $events->the_post();
	$id = get_the_ID();?>
	<h2><?php the_title(); ?></h2><?php
	the_content();
endwhile;

get_footer();