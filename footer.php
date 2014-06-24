<?php 
/**
 * Footer Template
 */
$option = get_option('miim_theme_options'); ?>
	</section><!-- main-content -->
	</div><!-- container -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h1>Contact Us</h1>
					<span><?php echo $option['miim_title']; ?></span>
					<span><?php echo $option['miim_street1']; ?></span>
					<span><?php echo $option['miim_street2']; ?></span>
					<span><?php echo $option['miim_city'].', '.$option['miim_state'].' '.$option['miim_zip']; ?></span>
					<span><?php echo $option['miim_phone']; ?></span>
					<span><?php echo $option['miim_email']; ?></span>
				</div>
				<div class="col-md-3">
					<h1>Connect With Us</h1>
					<span><?php echo $option['tw_username']; ?></span>
					<span><?php echo $option['fb_username']; ?></span>
					<span><?php echo $option['ig_username']; ?></span>
					<span><?php echo $option['yt_username']; ?></span>
					<span><?php echo $option['fk_username']; ?></span>
				</div>
				<div class="col-md-3">
					<section id="events-footer">
						<h1>Upcoming Events</h1><?php
						$args = array(
							'post_type' => 'events',
							'meta_key' => '_start_eventtimestamp',
							'orderby'=> 'meta_value_num',
							'order' => 'ASC',
							'posts_per_page' => 4
						);
						$events = new WP_Query( $args );
						while ( $events->have_posts() ) : $events->the_post();?>
					    	<article class="event-entry">
					    		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					    		<span><?php 
					    			$month = get_post_meta($post->ID, '_start_month', true);
								    $eventdate = eventposttype_get_the_month_abbr($month);
								    $eventdate .= ' ' . get_post_meta($post->ID, '_start_day', true); 
								    echo $eventdate; ?>
								</span>
							</article><?php
					  	endwhile; ?>
					</section>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="col-md-12">
							<h1>Donate Now</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h1>Subscribe</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<footer id="secondary-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div id="copy">
						<?php echo $option['miim_copyright']; ?>
					</div>
				</div>
				<div class="col-md-6">
					<nav id="footer-nav" class="pull-right"><?php 
						wp_nav_menu(array(
							'theme_location'=>'footer-menu', 
							'container'=>'',
							'menu_class'=>'nav navbar-nav',
							'menu_id'=>'sub-head-menu',
							'fallback_cb'=>false,
							'depth'=>1
						)); ?>
					</nav>
				</div>
			</div>
		</div>
	</footer><?php
	wp_footer(); ?>
	</body>
</html>