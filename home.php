<?php 
/**
 * Home Template
 */
get_header();?>
<div class="row">
	<div class="col-md-8">
		<h1>Archives</h1><?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="post clearfix"><?php 
				$categories_list = get_the_category_list( __( ', ', 'miim' ) ); ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="muted"><small>Posted in <?php echo $categories_list; ?> on <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time('F jS, Y'); ?></a> by <?php the_author_posts_link(); ?>.</small></p>
				<div class="content-blogpost"><?php
					echo get_the_post_thumbnail($id, 'full', array('class'=>'img-responsive'));
					$excerpt = get_the_excerpt();
					echo '<p>'.$excerpt.'... <a class="more" href="'.get_permalink( get_the_ID() ).'" title="'.get_the_title( get_the_ID() ).'">Read more <i class="fa fa-angle-double-right"></i></a></p>'; ?>
				</div>
				<p class="muted">
					<small><?php
						echo get_the_tag_list( 'Tags: ', ', ' ); ?>
					</small>
				</p>
			</article><?php 
		endwhile; ?>
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div><?php 
		else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
		endif;
		?>
	</div>
	<div class="col-md-4">
		<div class="sidebar">
			<?php if ( dynamic_sidebar('archive') ) : else : endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>
