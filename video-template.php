<?php
/**
 * Template Name: Video Page 
 *
 */
get_header(); ?>
<h1><?php the_title(); ?></h1><?php
$videos = new WP_query( array( 
   'post_type' => 'video',
   'post_status' => 'publish',
   'orderby' => 'menu_order',
   'order' => 'ASC',
) ); 
$i = 0; ?>
<div class="row"><?php
	while( $videos->have_posts() ) : $videos->the_post(); ?>
		<article class="video col-md-3 col-sm-6"><?php
				$id = get_the_ID();
				echo get_the_post_thumbnail($id, 'full', array('class'=>'img-responsive')); ?>
				<h2><?php the_title(); ?></h2><?php
			the_excerpt(); ?>
			<a class="more" href="<?php echo the_permalink(); ?>">VIEW <i class="fa fa-angle-double-right"></i></a>
		</article><?php
	endwhile; wp_reset_postdata(); ?>
</div><?php

get_footer();

