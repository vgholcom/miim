<?php
get_header(); ?>
<div class="row">
	<div class="col-md-12">
		<h1>Events</h1>
		<section id="eventlist"><?php
			$args = array(
				'post_type' => 'events',
				'meta_key' => '_start_eventtimestamp',
				'orderby'=> 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => -1
			);
			$events = new WP_Query( $args ); ?>
			<div class="row"><?php
				while ( $events->have_posts() ) : $events->the_post(); ?>
					<article class="col-md-6 col-sm-12"><?php 
						$id = get_the_ID();
						echo get_the_post_thumbnail($id, 'medium', array('class'=>'img-responsive'));?>

						<div class="content">
							<h2><?php the_title(); ?></h2>
							 <i class="date"><?php $eventdate = '';
							    $month = get_post_meta($post->ID, '_start_month', true);
							    $eventdate = eventposttype_get_the_month_abbr($month);
							    $eventdate .= ' ' . get_post_meta($post->ID, '_start_day', true) . ',';
							    $eventdate .= ' at ' . get_post_meta($post->ID, '_start_hour', true);
							    $eventdate .= ':' . get_post_meta($post->ID, '_start_minute', true);
							    echo $eventdate; ?>
							</i>
							<i class="location"><?php 
								echo ' at ';
					    		$event_location = get_post_meta( $post->ID, '_event_location', true );
					    		echo $event_location; ?>
					    	</i><?php 
						    the_excerpt('...'); ?>
						    <a class="button" href="<?php the_permalink(); ?>">VIEW <i class="fa fa-angle-double-right"></i></a>
						</div>
					</article><?php
			  	endwhile;?>
			  </div>
		</section>
	</div>
</div>
<?php
get_footer();
?>