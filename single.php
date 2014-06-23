<?php 
/**
 * Single Page Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
	echo get_the_post_thumbnail($id, 'full'); ?>
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<?php the_content();
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;

get_footer();
?>
