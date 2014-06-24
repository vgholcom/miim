<?php 
/**
 * Front Page Template
 */
get_header();
$option = get_option('miim_theme_options'); ?>
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<section id="branding">
							<img src="<?php echo $option['branding']['src']; ?>"/>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php if ( dynamic_sidebar('subscribe') ) : else : endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<?php if ( dynamic_sidebar('prayer_calendar') ) : else : endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<section id="banner">
							<?php echo $option['miim_banner']; ?>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-md-12">
				<section id="events">
					<h1>Upcoming Events</h1><?php
					$args = array(
						'post_type' => 'events',
						'meta_key' => '_start_eventtimestamp',
						'orderby'=> 'meta_value_num',
						'order' => 'ASC',
						'posts_per_page' => 1
					);
					$events = new WP_Query( $args );
					while ( $events->have_posts() ) : $events->the_post();
				    	$id = get_the_ID();?>
				    	<h2><?php the_title(); ?></h2><?php
				    	the_content();
				  	endwhile;
				  	$posttype = get_post_type($id); ?>
				  	<a href="<?php echo get_post_type_archive_link( $posttype ); ?>">Upcoming Events</a>
				</section>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<section id="carousel" class="carousel slide" data-ride="carousel"><?php
			$gallery = $option['miim_slideshow_gallery'];
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
			// Our parameters, do a resize
			$params = array( 'width' => 1116, 'height' => 376 );
			 
 			$num = $items->post_count; $first = true; ?>
			<ol class="carousel-indicators"><?php
				for ($i=0; $i<$num; $i++) {?>
					<li data-target="#carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i==0 ? 'active' : '';?>"></li><?php
				} ?>
			</ol>
			<div class="carousel-inner"><?php
				while($items->have_posts()):$items->the_post();
					$image_id = get_post_thumbnail_id(get_the_ID());?>
					<div class="item <?php if($first){ echo 'active'; $first=false; } ?>"><?php
						$thumb = wp_get_attachment_image_src( $image_id, 'full' );
						$image = str_replace(site_url().'/', ABSPATH, $thumb['0']); ?>
						<img src="<?php echo get_template_directory_uri() ?>/admin/timthumb.php?src=<?php echo $image; ?>&amp;w=1116&amp;h=376&amp;q=100&amp;a=c&amp;zc=1" alt="<?php echo get_the_title(get_the_ID()); ?>">
						<div class="carousel-caption"><?php
							the_title(); ?>
						</div>
					</div><?php
				endwhile;
				wp_reset_postdata(); ?>
			</div>
			<a class="left carousel-control" href="#carousel" data-slide="prev"></a>
			<a class="right carousel-control" href="#carousel" data-slide="next"></a>
		</section>
	</div>
</div>
<div class="row">
    <div class="col-md-8">
    	<section id="recent">
			<h1>Recent Posts</h1>
			<div class="row"><?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3
				);
				$recent = new WP_Query( $args );
				while ( $recent->have_posts() ) : $recent->the_post(); ?>
					<article class="col-md-4"><?php
				    	$id = get_the_ID();
				    	echo get_the_post_thumbnail($id, 'full', array('class'=>'img-responsive'));?>
				    	<h2><?php the_title(); ?></h2><?php
				    	the_content(); ?>
				   	</article><?php
				endwhile; ?>
			</div>
		</section>
    </div>
    <div class="col-md-4">
    	<section id="twitter"><?php
			echo miim_twitter_stream($option['tw_username']); ?>
		</section>
	</div>
</div>
<?php
get_footer();
?>
