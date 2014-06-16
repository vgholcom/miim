<?php
/*
 * MIIM Functions
 */

//include 'api/facebook.php';
//include 'api/instagram.php';
include 'api/twitter.php';

function miim_scripts_styles() {
	
	/* SCRIPTS */
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js', array('jquery'));
	
	/* STYLES */
	wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('global', get_stylesheet_directory_uri().'/style.css', array('bootstrap-css'));

}

add_action('wp_enqueue_scripts','miim_scripts_styles');

function miim_admin_init() {

	    wp_enqueue_style('thickbox');
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts','miim_admin_init');

function miim_init() {

	// Register Event Custom Post Type
	$labels = array(
		'name'                => _x( 'Events', 'Post Type General Name' ),
		'singular_name'       => _x( 'Event', 'Post Type Singular Name' ),
		'menu_name'           => __( 'Events' ),
		'all_items'           => __( 'All Events' ),
		'view_item'           => __( 'View Event' ),
		'add_new_item'        => __( 'Add New Event' ),
		'add_new'             => __( 'Add New' ),
		'edit_item'           => __( 'Edit Event' ),
		'update_item'         => __( 'Update Event' ),
		'search_items'        => __( 'Search Events' ),
		'not_found'           => __( 'Event Not found' ),
		'not_found_in_trash'  => __( 'Event Not found in Trash' ),
	);
	$args = array(
		'label'               => __( 'event' ),
		'description'         => __( 'Events' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'post-formats' ),
		'taxonomies'          => array( 'category', 'post_tag', 'gallery' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calendar',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'event', $args );

	// Register Embed Custom Post Type
	$labels = array(
		'name'                => _x( 'Embeds' ),
		'singular_name'       => _x( 'Embed' ),
		'menu_name'           => __( 'Embeds' ),
		'all_items'           => __( 'All Embeds' ),
		'view_item'           => __( 'View Embed' ),
		'add_new_item'        => __( 'Add New Embed' ),
		'add_new'             => __( 'Add New' ),
		'edit_item'           => __( 'Edit Embed' ),
		'update_item'         => __( 'Update Embed' ),
		'search_items'        => __( 'Search Embeds' ),
		'not_found'           => __( 'Embed Not found' ),
		'not_found_in_trash'  => __( 'Embed Not found in Trash' ),
	);
	$args = array(
		'label'               => __( 'embed' ),
		'description'         => __( 'Embeds' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'editor' ),
		'taxonomies'          => array( 'category', 'post_tag', 'gallery' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-video-alt2',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'embed', $args );

	// Register Custom Taxonomy
	$labels = array(
		'name'                       => 'Galleries',
		'singular_name'              => 'Gallery',
		'menu_name'                  => 'Gallery',
		'all_items'                  => 'All Galleries',
		'parent_item'                => 'Parent Gallery',
		'parent_item_colon'          => 'Parent Gallery:',
		'new_item_name'              => 'New Gallery',
		'add_new_item'               => 'Add New Gallery',
		'edit_item'                  => 'Edit Gallery',
		'update_item'                => 'Update Gallery',
		'search_items'               => 'Search Galleries',
		'add_or_remove_items'        => 'Add or remove Galleries',
		'not_found'                  => 'Gallery Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'gallery', array( 'post', ' embed', ' attachment', ' page' ), $args );
	register_taxonomy_for_object_type('gallery', 'attachment');
	register_taxonomy_for_object_type('gallery', 'post');
	register_taxonomy_for_object_type('gallery', 'page');
}

add_action( 'init', 'miim_init' );

// ADD MENU SUPPORT
add_theme_support('menus');
register_nav_menus( array(
	'primary-menu'=>'Primary Menu',
	'secondary-menu'=>'Secondary Menu',
	'footer-menu'=>'Footer Menu'
));

// ADD FEATURED IMAGE SUPPORT
add_theme_support('post-thumbnails');

function miim_admin_menu() {
	add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'miim-theme-options','miim_theme_options');
}

add_action('admin_menu', 'miim_admin_menu');

function miim_theme_options() { 
	$option = get_option( 'miim_theme_options' );?>
	<div id="miim-theme-options-wrap" class="wrap">
		<h2>Theme Options</h2>
		<p><i>From here you can modify different settings for this theme.</i></p>
		<div id="theme-options-frame" class="metabox-holder">
			<section id="branding" class="postbox">
				<h3>Branding</h3>
				<div class="inside">
					<img id="miim-logo-src" src="<?php echo isset($option['branding'] ) ? $option['branding']['src'] : ''; ?>"><br>
					<input type="hidden" id="miim-logo-id" value="<?php echo isset($option['branding'] ) ? $option['branding']['id'] : ''; ?>">
					<input type="button" id="miim-logo-change" value="Set Image">
					<input type="button" id="miim-logo-remove" value="Remove Image">
				</div>
			</section>
			<section id="social-media" class="postbox">
				<h3>Social Media</h3>
				<div class="inside">
				    <h4>Twitter:</h4><?php
				    echo miim_check_twitter( $option['tw_username'], $option['tw_ck'], $option['tw_cs'], $option['tw_at'], $option['tw_as']); ?>
				    <label for="tw_username"><h4>Username:</h4></label>
					<input id="tw_username" name="tw_username" style="width:50%;" value="<?php echo $option['tw_username']; ?>" /><br>
				    <label for="tw_ck"><h4>Consumer Key:</h4></label>
					<input id="tw_ck" name="tw_ck" style="width:50%;" value="<?php echo $option['tw_ck']; ?>" /><br>
				    <label for="tw_cs"><h4>Consumer Secret:</h4></label>
					<input id="tw_cs" name="tw_cs" style="width:50%;" value="<?php echo $option['tw_cs']; ?>" /><br>
					<label for="tw_at"><h4>Access Token:</h4></label>
					<input id="tw_at" name="tw_at" style="width:50%;" value="<?php echo $option['tw_at']; ?>" /><br>
					<label for="tw_as"><h4>Access Secret:</h4></label>
					<input id="tw_as" name="tw_as" style="width:50%;" value="<?php echo $option['tw_as']; ?>" /><br>
					<h4>Facebook:</h4>
					<label for="fb_username"><h4>Username:</h4></label>
					<input id="fb_username" name="fb_username" style="width:50%;" value="<?php echo $option['fb_username']; ?>" /><br>
					<h4>Instagram:</h4></br>
				    <label for="ig_userid"><h4>User ID:</h4></label>
					<input id="ig_userid" name="ig_userid" style="width:50%;" value="<?php echo $option['ig_userid']; ?>" /><br>
					<label for="ig_usertoken"><h4>User Token:</h4></label>
					<input id="ig_usertoken" name="ig_usertoken" style="width:50%;" value="<?php echo $option['ig_usertoken']; ?>" /><br>
				</div>
			</section>
			<section id="slideshow" class="postbox">
				<h3>Slideshow Gallery</h3>
				<div class="inside">
					<p><strong>Use this option to set a featured gallery.</strong></p><?php 
					wp_dropdown_categories( array(
						'taxonomy'=>'gallery',
						'selected'=> $option['miim_slideshow_gallery'],
						'name' => 'miim_slideshow_gallery',
						'show_option_none' => 'None',
						'class' => 'postform miim-dropdown',
						'hide_empty' => false
					) ); ?>
					<script type="text/javascript">
						jQuery(document).ready(function($){
							$(".miim-dropdown").change(function(){
								if( $(this).val()!=-1 ) {
									$(this).siblings().each(function(){
										$(this).val(-1);
									});
								}
							});
						});
					</script>
				</div>
			</section>
			<section id="footer-options" class="postbox">
				<h3>Footer Options</h3>
				<div class="inside">
				    <label for="title"><h4>Title:</h4></label>
					<input id="title" name="Title" style="width:50%;" value="<?php echo $option['miim_title']; ?>" /><br>
				    <h4>Address:</h4></br>
				    <label for="street1"><h4>Street line 1:</h4></label>
				    <input id="street1" name="Street1" style="width:50%; " value="<?php echo $option['miim_street1']; ?>" /><br>
				    <label for="street2"><h4>Street line 2:</h4></label>
				    <input id="street2" name="Street2" style="width:50%; " value="<?php echo $option['miim_street2']; ?>" /><br>
				    <label for="city"><h4>City:</h4></label>
				    <input id="city" name="City" style="width:50%; " value="<?php echo $option['miim_city']; ?>" /><br>
				    <label for="state"><h4>State:</h4></label>
				    <input id="state" name="State" style="width:50%; " value="<?php echo $option['miim_state']; ?>" /><br>
				    <label for="zip"><h4>Zip Code:</h4></label>
				    <input id="zip" name="Zip" style="width:50%; " value="<?php echo $option['miim_zip']; ?>" /><br>
				    <label for="phone_number"><h4>Phone Number:</h4></label>
				    <input id="phone_number" name="phone_Number" style="width:50%;" value="<?php echo $option['miim_phone']; ?>" /><br>
					<label for="email"><h4>Email:</h4></label>
					<input id="email" name="email" style="width:50%; " value="<?php echo $option['miim_email']; ?>" /><br>
				    <label for="copyright"><h4>Copyright Notice:</h4></label>
					<input id="copyright" name="copyright" style="width:50%; " value="<?php echo $option['miim_copyright']; ?>" />
				</div>
			</section>
		</div>
		<div>
			<p class="submit"><input id="save-changes-btn" name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>"></p>
			<h2 id="ajax-response-field" style="text-align: left"></h2>
		</div>
	</div>
	<script type="text/javascript">
	jQuery(function($) {
		//handle image edit
		var uploadID = '';
		$(document).on("click", "#miim-logo-change", function() { // button
			uploadID = "logo";
			formfield = 'add image';
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});

		window.send_to_editor = function(html) {
			var imgurl = $('img',html).attr('src');
			var imgid = $('img', html).attr('class');
			imgid = imgid.replace(/(.*?)wp-image-/, '');
			tb_remove();
			$("#miim-"+uploadID+"-src").attr( 'src', imgurl ); // image preview
			$("#miim-"+uploadID+"-id").val(imgid); // hidden id	
		}
		$(document).mouseup(function(e) {
		    if ( $("#TP_iframeContent").has(e.target).length === 0 ) {
				tb_remove();
		    }
		});
		$(document).on("click", "#miim-logo-remove", function() { // button
			$("#miim-logo-src").attr('src', '');
			$("#miim-logo-id").val('');
		});
		
		//handle save
		$("#save-changes-btn").click(function() {
			$("#save-changes-btn").val( 'Saving...' );
			//send ajax request to update
			var data = { 
				action: 'miim_theme_options_ajax_action',
				miim_theme_options: { 
					branding: { src: $("#miim-logo-src").attr('src'), id: $("#miim-logo-id").val() },
					tw_username : $('#tw_username').val(),
					tw_ck : $('#tw_ck').val(),
					tw_cs : $('#tw_cs').val(),
					tw_at : $('#tw_at').val(),
					tw_as : $('#tw_as').val(),
					fb_username : $('#fb_username').val(),
					ig_userid : $('#ig_userid').val(),
					ig_usertoken : $('#ig_usertoken').val(),
					miim_slideshow_gallery :$('#miim_slideshow_gallery option:selected').val(),
					miim_title:$('#title').val(),
			    	miim_address:$('#street1').val(),
			    	miim_address:$('#street2').val(),
			    	miim_address:$('#city').val(),
			    	miim_address:$('#state').val(),
			    	miim_address:$('#zip').val(),
			    	miim_phone:	$('#phone_number').val(),
					miim_email:$('#email').val(),
			    	miim_copyright:$('#copyright').val(),
				}
			    
			};
			//console.log(data);
		    $.post(ajaxurl, data, function( msg ) 
		    {
				$("#save-changes-btn").val( msg );
		    });//enf of .post()
		});
	});
	</script>
<?php }

function miim_theme_options_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	update_option( 'miim_theme_options', $_POST['miim_theme_options'] );
	
	echo 'Changes Saved'; // save confirmation
	exit(); // this is required to return a proper result
}
add_action( 'wp_ajax_miim_theme_options_ajax_action', 'miim_theme_options_ajax_callback' );


function miim_metabox() {                              
	add_meta_box( 'miim-gallery-metabox', 'Attached Gallery', 'miim_gallery_metabox', 'page', 'normal', 'high' );
	add_meta_box( 'miim-gallery-metabox', 'Attached Gallery', 'miim_gallery_metabox', 'post', 'normal', 'high' );
	add_meta_box( 'miim-events-metabox', 'Events', 'miim_events_metabox', 'events');
}
add_action( 'add_meta_boxes', 'miim_metabox' );


/* Gallery Meta Box */
function miim_gallery_metabox ( $post ) { ?>
	<div style="border:1px solid #CCCCCC;padding:10px;margin-bottom:10px;">
		<p><strong>Use this option to set a featured gallery.</strong></p>
		<?php wp_dropdown_categories( array(
				'taxonomy'=>'gallery',
				'selected'=> get_post_meta($post->ID, 'miim_gallery', true),
				'name' => 'miim_gallery',
				'show_option_none' => 'None',
				'class' => 'postform miim-dropdown',
				'hide_empty' => false) ); ?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".miim-dropdown").change(function(){
				if( $(this).val()!=-1 ) {
					$(this).siblings().each(function(){
						$(this).val(-1);
					});
				}
			});
		});
	</script>
<?php }


/* EVENTS */
add_filter('manage_edit-miim_events_columns','miim_events_edit_columns');
add_action('manage_posts_custom_column','miim_events_custom_columns');

function miim_events_edit_columns($columns) {
	$columns = array(
		'cb'=>'<input type=\"checkbox\"/>',
		'miim_col_ev_date'=>'Dates',
		'miim_col_ev_times'=>'Times',
		'title'=>'Event'
	);
	return $columns;
}

function miim_events_custom_columns() {
	global $post;
	$custom = get_post_custom();
	switch ($column) {
		case 'miim_col_ev_date' :
			$startd = $custom['miim_events_startdate'][0];
			$endd = $custom['miim_events_enddate'][0];
			$startdate = date('F j, Y', $startd);
			$enddate = date('F j, Y'),$endd);
			echo $startdate .'<br/><em>'.$enddate.'</em>';
		break;
		case 'miim_col_ev_times' :
			$startt = $custom['miim_events_startdate'][0];
			$endt = $custom['miim_events_enddate'][0];
			$time_format = get_option('time_format');
			$starttime = date($time_format, $startt);
			$endtime = date($time_format, $endt);
			echo $starttime.'-'.$endtime;
		break;
	}
}

function miim_events_metabox() {
	global $post;
	$custom = get_post_custom($post->ID);
	$meta_sd = $custom['miim_events_startdate'][0];
	$meta_ed = $custom['miim_events_enddate'][0];
	$meta_st = $meta_sd; 
	$meta_et = $meta_et;
	$date_format = get_option('date_format');
	$time_format = get_option('time_format');
	if ($meta_sd == null){ $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0; }
	$clean_sd = date('D, M d, Y', $meta_sd);
	$clean_ed = date('D, M d, Y', $meta_ed);
	$clean_st = date($time_format, $meta_st);
	$clean_et = date($time_format, $meta_et);
	echo '<input type="hidden" name="miim-events-nonce" id="miim-events-nonce" value="'.wp_create_nonce('miim-events-nonce').'"/>' ?>
	<div style="border:1px solid #CCCCCC;padding:10px;margin-bottom:10px;">
		<ul>
			<li><label>Start Date</label><input name="miim_events_startdate" class="miimdate" value="<?php echo $clean_sd ?>"/></li>
			<li><label>Start Time</label><input name="miim_events_starttime" value="<?php echo $clean_st ?>"/></li>
			<li><label>End Date</label><input name="miim_events_enddate" class="miimdate" value="<?php echo $clean_ed ?>"/></li>
			<li><label>End Time</label><input name="miim_events_endtime" value="<?php echo $clean_et ?>"/></li>
		</ul>
	</div><?php

}

add_action('save_post','save_miim_events');

function save_miim_events(){
	global $post;
	if (!wp_verify_nonce($_POST['miim-events-nonce'],'miim-events-nonce')) {
		return $post->ID;
	}
	if (!current_user_can('edit_post',$post->ID))
		return $post->ID;
	
	if (!isset($_POST['miim_events_startdate'])):
		return $post;
	endif;
	$updatestartd = strtotime($_POST['miim_events_startdate'].$_POST['miim_events_starttime']);
	update_post_meta($post->ID, 'miim_events_startdate',$updatestartd);

	if(!isset($_POST['miim_events_enddate'])):
		return $post;
	endif;
	$updateendd = strtotime($_POST['miim_events_enddate'].$_POST['miim_events_endtime']);
	update_post_meta($post->ID, 'miim_events_enddate',$updateendd);
}
