<?php 
/**
 * Footer Template
 */
$option = get_option('miim_theme_options'); ?>
	</div><!-- container -->
	</section><!-- main-content -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h1>Contact Us</h1>
					<span><?php echo $option['miim_title']; ?></span>
					<span><?php echo $option['miim_street1']; ?></span>
					<span><?php echo $option['miim_street2']; ?></span>
					<span><?php echo $option['miim_city'].', '.$option['miim_state'].' '.$option['miim_zip']; ?></span>
					<span><a href="tel:<?php echo preg_replace('/\(|\)/','',$option['miim_phone']); ?>"><?php echo $option['miim_phone']; ?></a></span>
					<span><a href="mailto:<?php echo $option['miim_email']; ?>"><?php echo $option['miim_email']; ?></a></span>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h1>Connect With Us</h1>
					<span><?php if (isset($option['tw_username'])) { ?><a href="http://www.twitter.com/<?php echo $option['tw_username']; ?>"><i class="fa fa-twitter-square"></i><?php /*echo $option['tw_username'];*/ }?></a></span>
					<span><?php if (isset($option['fb_username'])) { ?><a href="http://www.facebook.com/<?php echo $option['fb_username']; ?>"><i class="fa fa-facebook-square"></i><?php /*echo $option['fb_username'];*/ }?></a></span>
					<span><?php if (isset($option['ig_username'])) { ?><a href="http://www.instagram.com/<?php echo $option['ig_username']; ?>"><i class="fa fa-instagram"></i><?php /*echo $option['ig_username'];*/ }?></a></span>
					<span><?php if (isset($option['yt_username'])) { ?><a href="http://www.youtube.com/channel/<?php echo $option['yt_username']; ?>"><i class="fa fa-youtube-square"></i><?php /*echo $option['yt_username'];*/ }?></a></span>
					<span><?php if (isset($option['fk_username'])) { ?><a href="http://www.flickr.com/photos/<?php echo $option['fk_username']; ?>"><i class="fa fa-flickr"></i><?php /*echo $option['fk_username'];*/ }?></a></span>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<section id="events-footer">
						<h1>Upcoming Events</h1><?php
						$args = array(
							'post_type' => 'events',
							'meta_key' => '_start_eventtimestamp',
							'orderby'=> 'meta_value',
							'order' => 'ASC',
							'posts_per_page' => 3
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
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="row">
						<div class="col-md-12">
							<h1>Donate Now</h1>
							<p>Click <a href="http://www.masjidisa.com/?page_id=245" alt="donate">here</a> to donate to our organization.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<footer id="secondary-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div id="copy">
						Development by <a href="mailto:vholcomb@live.com">Victoria Holcomb.</a>
						<?php echo ' '. $option['miim_copyright']; ?>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
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