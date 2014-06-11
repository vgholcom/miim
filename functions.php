<?php
/*
 * MIIM Functions
 */

include 'api/facebook.php';
include 'api/instagram.php';
include 'api/twitter.php';

function miim_scripts_styles() {
	
	/* SCRIPTS */
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js');
	
	/* STYLES */
	wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('global', get_stylesheet_directory_uri(), array('bootstrap-css'));

}

add_action('wp_enqueue_scripts','miim_scripts_styles');

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
		'menu_icon'           => '',
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
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( 'category', 'post_tag', 'gallery' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
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

}

add_action( 'init', 'miim_init' );

function miim_admin_menu() {
	add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'miim-theme-options','miim_theme_options');
}

add_action('admin_menu', 'miim_admin_menu');

function miim_theme_options() { ?>
	<div class="wrap">
		<h2>Theme Options</h2>
		<div id="theme-options-frame" class="metabox-holder">
			<!-- HEADER -->
			<section class="postbox">
				<div title="Click to Toggle" class="handlediv"></div>
				<h3 class="hndle"><span>Header Options</span></h3>
				<div class="inside">
					<p class="howto">Upload a logo here</p><?php
					$header_options = get_option('miim_header'); ?>
					<img id="miim-logo-src" src="<?php echo isset($header_options['logo']) ? $header_options['logo']['src'] : ''; ?>">
					<input type="hidden" id="miim-logo-id" value="<?php echo isset($header_options['logo']) ? $header_options['logo']['id'] : ''; ?>">
					<input type="button" id="miim-logo-change" value="Set Image">
					<input type="button" id="miim-logo-remove" value="Remove Image">
				</div>
			</section>
			<!-- SLIDESHOW -->
			<section class="postbox">
				<div title="Click to Toggle" class="handlediv"></div>
				<h3 class="hndle"><span>Slide Show</span></h3>
				<div class="inside">
				</div>
			</section> 
			<!-- SOCIAL MEDIA -->
			<section class="postbox">
				<div title="Click to Toggle" class="handlediv"></div>
				<h3 class="hndle"><span>Social Media</span></h3>
				<div class="inside">
				</div>
			</section>
			<!-- FOOTER OPTIONS -->
			<section class="postbox">
				<div title="Click to Toggle" class="handlediv"></div>
				<h3 class="hndle"><span>Footer Options</span></h3>
				<div class="inside">
					<p class="howto">Enter footer information into the following fields.</p><?php 
					$footer_options = get_option('miim_footer'); ?>
					<form class="input-prepend">
						<label for="copyright">Copyright:</label>
						<input id="copyright" name="copyright" type="text" value="<?php echo esc_attr(stripcslashes($footer_options['copyright'])); ?>"/>
					</form>
				</div>
			</section>
		</div>
	</div>
	<div class="submit-wrap">
		<p class="submit">
			<input id="save-changes-btn" name="Submit" type="submit" class="button-primary" values="<?php esc_attr_e('Save Changes'); ?>">
		</p>
	</div>
	<script>
		jQuery(function($) {
			var uploadID = '';
			$(document).on('click', '#miim-logo-change', function() {
				uploadID = 'logo';
				formfield = 'add image';
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				return false;
			});
			window.send_to_editor = function(html) {
				var imgurl = $('img',html).attr('src');
				var imgid = $('img',html).attr('class');
				imgid = imgid.replace('/(.*?)wp-image/','');
				tb_remove();
				$('#miim-'+uploadID+'-src').attr('src', imgurl);
				$('#miim-'+uploadID+'-id').val(imgid);
			}
			$(document).mouseup(function(e){
				if($('#TP_iframeContent').has(e.target).length === 0) {
					tb_remove();
				}
			});
			$(document).on('click', 'miim-logo-remove', function() {
				$('#miim-logo-src').attr('src','');
				$('#miim-logo-id').val('');
			});
			$('#save-changes-btn').click(function(){
				$(this).val('Saving...');
				var values = {
					'miim_header'	: {
						'logo'	: {
							'src'	: $('#miim-logo-src').attr(src),
							'id'	: $('#miim-logo-id').val()
						}
					},
					'miim_footer'	: {
						'copyright'	: $('#copyright').val()
					}
				};
				var data = {
					action: 'miim_theme_options_ajax_action',
					options: values
				};
				$.post(ajaxurl, data, function(msg) {
					if ( msg == 'reload' ) {
						location.reload();
					} else {
						$('save-changes-btn').val(msg);
					}
				});
			});
		});
	</script><?php
}

function miim_theme_options_ajax_action() {
	foreach ($_POST['options'] as $key => $value) {
		$changed = update_option($key, $value);
		if ($changed) {
			$return = 'reload'
		}
	}
	echo $return;
	die();
}

add_action('wp_ajax_miim_theme_options_ajax_action', 'miim_theme_options_ajax_action');

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


