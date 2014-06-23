<?php
/**
 * Template Name: Video Page 
 *
 */
get_header();
$videos = new WP_query( array( 
   'post_type' => 'embed',
   'post_status' => 'publish',
   'orderby' => 'menu_order',
   'order' => 'ASC',
) ); 
while( $videos->have_posts() ) : $videos->the_post(); ?>
	<article class="video">
		<a class="img-link" href="<?php the_permalink(); ?>"><?php
			the_post_thumbnail(); ?>
			<h2><?php the_title(); ?></h2>
		</a><?php
		the_excerpt(); ?>
	</article><?php
endwhile; wp_reset_postdata();

get_footer();