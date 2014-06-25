<?php
get_header(); ?>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h1>Events</h1>
		<table id="eventlist">
			<thead>
				<tr>
					<th scope="col" class="title">Title</th>
					<th scope="col" class="title">Date</th>
					<th scope="col" class="excerpt">Location</th>
					<th scope="col" class="replys"></th>
				</tr>
			</thead>
			<tbody><?php
				$args = array(
					'post_type' => 'events',
					'meta_key' => '_start_eventtimestamp',
					'orderby'=> 'meta_value_num',
					'order' => 'ASC',
					'posts_per_page' => -1
				);
				$events = new WP_Query( $args );
				while ( $events->have_posts() ) : $events->the_post(); ?>
					<tr>
						<td class="title"><?php 
				    		$id = get_the_ID();?>
				    		<?php the_title(); ?>
				    	</td>
				    	<td class="posted_on">
				    		<i><?php eventposttype_get_the_event_date('_start'); ?></i>
				    	</td>
				    	<td class="excerpt"><?php 
				    		$event_location = get_post_meta( $post->ID, '_event_location', true );
				    		echo $event_location; ?>
				    	</td>
				    	<td class="replys">
				    		<a href="<?php the_permalink(); ?>">More info</a></h2>
				    	</td>
				    </tr><?php
			  	endwhile;?>

			</tbody>
		</table>
	</div>
</div>
<?php
get_footer();
?>