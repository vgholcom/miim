<?php
/*
 * MIIM Functions
 */

//include 'api/facebook.php';
//include 'api/instagram.php';
//include 'api/twitter.php';

function miim_scripts_styles() {
	
	/* SCRIPTS */
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js', array('jquery'));
	
	/* STYLES */
	wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('global', get_stylesheet_directory_uri(), array('bootstrap-css'));

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
				    <label for="address"><h4>Address:</h4></label>
				    <input id="address" name="Address" style="width:50%; " value="<?php echo $option['miim_address']; ?>" /><br>
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
					miim_slideshow_gallery :$('#miim_slideshow_gallery option:selected').val(),
					miim_title:$('#title').val(),
			    	miim_address:$('#address').val(),
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

