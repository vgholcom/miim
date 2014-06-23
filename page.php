<?php 
/**
 * Page Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<h1><?php the_title(); ?></h1>
	<?php the_content();
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;

$post_category = get_post_meta($post->ID, 'miim_post_category', true);
//check for post category
if ( (isset($post_category) && $post_category!=null && $post_category!=-1) ) :
	$wp_query = new WP_Query( 'cat='.$post_category );
	//print each post in that category
	while ( have_posts() ) : the_post(); ?>
		<article id="page-post">
			<?php echo get_the_post_thumbnail($id, 'thumbnail'); ?>
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?>
		</article><?php
	endwhile;
	wp_reset_postdata();
endif;

get_footer();
?>
