<?php 
/**
 * Page Template
 */
get_header();
$id = $post->ID;
$attachedGal = get_post_meta($id, 'miim_gallery', true);
$post_category = get_post_meta($id, 'miim_post_category', true);

if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<div class="row">
		<div class="col-md-12">
			<h1><?php the_title(); ?></h1>
			<?php the_content();?>
		</div>
	</div><?php
endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php 
endif;

//check for post category
if ( (isset($post_category) && $post_category!=null && $post_category!=-1) ) :
	$wp_query = new WP_Query( 'cat='.$post_category );
	//print each post in that category ?>
	<div class="row"><?php
	while ( have_posts() ) : the_post(); ?>
		<article class="col-md-3"><?php 
			$id = get_the_ID();
			echo get_the_post_thumbnail($id, 'full', array('class'=>'img-responsive'));?>
			<h2><?php the_title(); ?></h2><?php
			the_excerpt(); ?>
			<a class="more" href="<?php echo the_permalink(); ?>">READ MORE</a>
		</article><?php
	endwhile; ?>
	</div><?php
	wp_reset_postdata();
endif;
if (isset($attachedGal)&&$attachedGal!=''&&$attachedGal!=-1) :
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
			<article class="galery col-md-3">
				<a href="<?php echo wp_get_attachment_url($id); ?>" rel="prettyphoto[<?php echo 'gal-'. $attachedGal; ?>]" title="<?php the_title()?> "><img src="<?php echo wp_get_attachment_url($id);?>"/></a>
			</article><?php
		endwhile; wp_reset_postdata(); ?>
	</div><?php
endif;
get_footer();
?>
