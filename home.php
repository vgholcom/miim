<?php 
/**
 * Home Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post">
		<?php echo get_the_post_thumbnail($id, 'thumbnail'); ?>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php the_excerpt(); ?>
	</article><?php 
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;

get_footer();
?>
