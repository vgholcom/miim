<?php 
/**
 * Front Page Template
 */
get_header();
$option = get_option('miim_theme_options');
	
	//carousel
	$gallery = $option['miim_slidehow_gallery'];
	$items = new WP_query(array(
		'post_type' => 'any',
		'post_status' => 'any',
		'tax_query' => array(
			array(
				'taxonomy' => 'gallery',
				'terms' => $gallery, 
				'field' => 'id'
				)
			)
	));
	$num = count($items); $first = true; ?>
	<section id="carousel-media" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators"><?php
			for ($i=0; $i<$num; $i++) {?>
				<li data-target="#carousel-media" data-slide-to="<?php echo $i; ?>" class="<?php echo $i==0 ? 'active' : '';?>"></li><?php
			} ?>
		</ol>
		<div class="carousel-inner"><?php
			while($items->have_posts()):$items->the_post(); ?>
				<div class="item <?php if($first){ echo 'active'; $first=false; } ?>">
					<img src="" alt="<?php the_title(); ?>">
					<div class="carousel-caption"><?php
						the_title(); ?>
					</div>
				</div><?php
			endwhile;
			wp_reset_postdata(); ?>
		</div>
		<a class="left carousel-control" href="#carousel-media" data-slide="prev"></a>
		<a class="right carousel-control" href="#carousel-media" data-slide="next"></a>
	</section><?php


get_footer();
?>
