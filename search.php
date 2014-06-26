<?php 
/**
 * Search Page Template
 */
get_header();?>
<div class="row">
	<div class="col-md-12">
		<h1>Search Results</h1><?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post clearfix"> 
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</article><?php 
		endwhile; ?>
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div><?php 
		else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
		endif;
		?>
	</div>
</div>
<?php
get_footer();
?>