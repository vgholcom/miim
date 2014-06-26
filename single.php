<?php 
/**
 * Single Page Template
 */
get_header();
$attachedGal = get_post_meta($post->ID, 'miim_gallery', true);
if (isset($attachedGal)&&$attachedGal!='') :
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content();
		$items = new WP_query(array(
			'post_type' => 'any',
			'post_status' => 'any',
			'tax_query' => array(
				array(
					'taxonomy' => 'gallery',
					'terms' => $attachedGal, 
					'field' => 'id'
					)
				)
		));?>
		<div class="row"><?php
			while( $items->have_posts() ) : $items->the_post(); 
				$id = get_the_ID(); ?>
				<article class="galery col-md-3 col-sm-6">
					<a href="<?php echo wp_get_attachment_url($id); ?>" rel="prettyphoto[<?php echo 'gal-'. $attachedGal; ?>]" title="<?php the_title()?> "><img src="<?php echo wp_get_attachment_url($id);?>"/></a>
				</article><?php
			endwhile; wp_reset_postdata(); ?>
		</div><?php
	endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
	endif;
else :
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		echo get_the_post_thumbnail($id, 'full'); ?>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php the_content();
	endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
	endif;
endif;

get_footer();
?>
