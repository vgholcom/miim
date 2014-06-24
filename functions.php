<?php
/*
 * MIIM Functions
 */

//include 'api/facebook.php';
//include 'api/instagram.php';
include 'api/twitter.php';
include 'admin/events.php';


function miim_scripts_styles() {
	
	/* SCRIPTS */
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js', array('jquery'));
	
	/* STYLES */
	wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style('global', get_stylesheet_directory_uri().'/style.css');

}

add_action('wp_enqueue_scripts','miim_scripts_styles');

function miim_admin_init() {

	    wp_enqueue_style('thickbox');
	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts','miim_admin_init');

function miim_init() {

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
	register_taxonomy_for_object_type('gallery', 'embed');

}

add_action( 'init', 'miim_init' );

// ADD MENU SUPPORT
add_theme_support('menus');
register_nav_menus( array(
	'primary-menu'=>'Primary Menu',
	'secondary-menu'=>'Secondary Menu',
	'footer-menu'=>'Footer Menu'
));

function miim_widgets_init() {
	register_sidebar( array(
		'name' => 'Prayer Calendar',
		'id' => 'prayer_calendar',
		'before_widget' => '<div id="prayer">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => 'Subscribe',
		'id' => 'subscribe',
		'before_widget' => '<div id="subscribe">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'miim_widgets_init' );

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
					<h4>Instagram:</h4>
				    <label for="ig_username"><h4>Username:</h4></label>
					<input id="ig_username" name="ig_username" style="width:50%;" value="<?php echo $option['ig_username']; ?>" /><br>
					<h4>Youtube:</h4>
				    <label for="yt_username"><h4>Username:</h4></label>
					<input id="yt_username" name="yt_username" style="width:50%;" value="<?php echo $option['yt_username']; ?>" /><br>
					<h4>Flickr:</h4>
				    <label for="fk_username"><h4>Username:</h4></label>
					<input id="fk_username" name="fk_username" style="width:50%;" value="<?php echo $option['fk_username']; ?>" /><br>
				</div>
			</section>
			<section id="banner" class="postbox">
				<h3>Banner</h3>
				<div class="inside">
					<em>Enter front page banner text here</em>
					<label for="miim_banner"><h4>Banner:</h4></label>
					<input id="miim_banner" name="miim_banner" style="width:100%;" value="<?php echo $option['miim_banner']; ?>" /><br>
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
					ig_userid : $('#ig_username').val(),
					yt_userid : $('#yt_username').val(),
					fk_userid : $('#fk_username').val(),
					miim_banner : $('#miim_banner').val(),
					miim_slideshow_gallery :$('#miim_slideshow_gallery option:selected').val(),
					miim_title:$('#title').val(),
			    	miim_street1:$('#street1').val(),
			    	miim_street2:$('#street2').val(),
			    	miim_city:$('#city').val(),
			    	miim_state:$('#state').val(),
			    	miim_zip:$('#zip').val(),
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
	add_meta_box( 'miim-events-metabox', 'Events', 'miim_events_metabox', 'event');
	add_meta_box( 'miim-embed-metabox', 'Embed Code', 'miim_embed_metabox', 'embed');
	add_meta_box('miim-page-post-category-meta', 'Post Category', 'miim_page_post_category_meta', 'page', 'normal', 'high');
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

/* Embed Code Meta Box */
function miim_embed_metabox($post) {?>
	<div style="border:1px solid #CCCCCC;padding:10px;margin-bottom:10px;"><?php
		$values = get_post_custom( $post->ID );
		$selected = isset( $values['film_embed'] ) ? $values['film_embed'][0] : '';
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );?>
		<p>
		  <label for="film_embed"><p>Paste embed code for the film in the textbox below.</p></label>
		  <textarea name="film_embed" id="film_embed" cols="62" rows="5" ><?php echo $selected; ?></textarea>
		</p>
	</div><?php   
} 

/*
* Category Post Meta Box - adds a category option to select which posts a page displays
*/
function miim_page_post_category_meta ( $post ) { ?>
	<div style="border:1px solid #CCCCCC;padding:10px;margin-bottom:10px;">
		<label for="miim_post_category">Select which posts by category to feed on to this page: </label>
		<?php wp_dropdown_categories( array(
			'selected'=> get_post_meta($post->ID, 'miim_post_category', true),
			'name' => 'miim_post_category',
			'show_option_none' => 'None',
			'class' => 'postform miim-dropdown',
			'hide_empty' => false
		) ); ?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$(".cobalt-dropdown").change(function(){
				if( $(this).val()!=-1 ) {
					$(this).siblings().each(function(){
						$(this).val(-1);
					});
				}
			});
		});
	</script>
<?php }

/**
 * Save Meta Boxes
 */
function metabox_save( $post_id ) {
	//if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	//if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	//if( !current_user_can( 'edit_post' ) ) return;

	$allowed = array( 
		'a' => array( 
			'href' => array() 
		)
	);
	if( isset( $_POST['film_embed'] ) ) {
		update_post_meta( $post_id, 'film_embed', $_POST['film_embed'] );
	}
	if( isset($_POST['miim_gallery']) ) {
		update_post_meta( $post_id, 'miim_gallery', $_POST['miim_gallery'] );
	}
	if( isset($_POST['miim_post_category']) ) {
		update_post_meta( $post_id, 'miim_post_category', $_POST['miim_post_category'] );
	}
}
add_action( 'save_post', 'metabox_save' );

