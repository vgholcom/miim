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
	wp_enqueue_script('prettyphoto-js', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'));
	wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js', array('jquery'));
	
	/* STYLES */
	wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'prettyphoto-css', get_template_directory_uri() . '/css/prettyPhoto.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/MyFontsWebfontsKit.css' );
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

	// Register video Custom Post Type
	$labels = array(
		'name'                => _x( 'Videos' ),
		'singular_name'       => _x( 'Video' ),
		'menu_name'           => __( 'Videos' ),
		'all_items'           => __( 'All videos' ),
		'view_item'           => __( 'View video' ),
		'add_new_item'        => __( 'Add New video' ),
		'add_new'             => __( 'Add New' ),
		'edit_item'           => __( 'Edit video' ),
		'update_item'         => __( 'Update video' ),
		'search_items'        => __( 'Search videos' ),
		'not_found'           => __( 'video Not found' ),
		'not_found_in_trash'  => __( 'video Not found in Trash' ),
	);
	$args = array(
		'label'               => __( 'video' ),
		'description'         => __( 'videos' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'editor','excerpt' ),
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
	register_post_type( 'video', $args );

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
	register_taxonomy( 'gallery', array( 'post', ' video', ' attachment', ' page' ), $args );
	register_taxonomy_for_object_type('gallery', 'attachment');
	register_taxonomy_for_object_type('gallery', 'post');
	register_taxonomy_for_object_type('gallery', 'page');
	register_taxonomy_for_object_type('gallery', 'video');

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
	register_sidebar( array(
		'name' => 'Archive',
		'id' => 'archive',
		'before_widget' => '<div id="archive">',
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
					ig_username : $('#ig_username').val(),
					yt_username : $('#yt_username').val(),
					fk_username : $('#fk_username').val(),
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
	add_meta_box( 'miim-video-metabox', 'Video Code', 'miim_video_metabox', 'video');
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

/* video Code Meta Box */
function miim_video_metabox($post) {?>
	<div style="border:1px solid #CCCCCC;padding:10px;margin-bottom:10px;"><?php
		$values = get_post_custom( $post->ID );
		$selected = isset( $values['film_video'] ) ? $values['film_video'][0] : '';
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );?>
		<p>
		  <label for="film_video"><p>Paste video code for the film in the textbox below.</p></label>
		  <textarea name="film_video" id="film_video" cols="62" rows="5" ><?php echo $selected; ?></textarea>
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
	if( isset( $_POST['film_video'] ) ) {
		update_post_meta( $post_id, 'film_video', $_POST['film_video'] );
	}
	if( isset($_POST['miim_gallery']) ) {
		update_post_meta( $post_id, 'miim_gallery', $_POST['miim_gallery'] );
	}
	if( isset($_POST['miim_post_category']) ) {
		update_post_meta( $post_id, 'miim_post_category', $_POST['miim_post_category'] );
	}
}
add_action( 'save_post', 'metabox_save' );

function breadcrumbs() {  
    /* === OPTIONS === */  
    $text['home']     = 'Home'; // text for the 'Home' link  
    $text['category'] = 'Archive by Category "%s"'; // text for a category page  
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page  
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page  
    $text['author']   = 'Articles Posted by %s'; // text for an author page  
    $text['404']      = 'Error 404'; // text for the 404 page  
  
    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show  
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show  
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show  
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show  
    $delimiter      = ' &raquo; '; // delimiter between crumbs  
    $before         = '<span class="current">'; // tag before the current crumb  
    $after          = '</span>'; // tag after the current crumb  
    /* === END OF OPTIONS === */  
  
    global $post;  
    $home_link    = home_url('/');  
    $link_before  = '<span typeof="v:Breadcrumb">';  
    $link_after   = '</span>';  
    $link_attr    = ' rel="v:url" property="v:title"';  
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;  
    $parent_id    = $parent_id_2 = $post->post_parent;  
    $frontpage_id = get_option('page_on_front');  
  
    if (is_home() || is_front_page()) {  
  
        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';  
  
    } else {  
  
        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';  
        if ($show_home_link == 1) {  
            echo sprintf($link, $home_link, $text['home']);  
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;  
        }  
  
        if ( is_category() ) {  
            $this_cat = get_category(get_query_var('cat'), false);  
            if ($this_cat->parent != 0) {  
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);  
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                echo $cats;  
            }  
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
  
        } elseif ( is_search() ) {  
            echo $before . sprintf($text['search'], get_search_query()) . $after;  
  
        } elseif ( is_day() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
            echo $before . get_the_time('d') . $after;  
  
        } elseif ( is_month() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo $before . get_the_time('F') . $after;  
  
        } elseif ( is_year() ) {  
            echo $before . get_the_time('Y') . $after;  
  
        } elseif ( is_single() && !is_attachment() ) {  
            if ( get_post_type() != 'post' ) {  
                $post_type = get_post_type_object(get_post_type());  
                $slug = $post_type->rewrite;  
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);  
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
            } else {  
                $cat = get_the_category(); $cat = $cat[0];  
                $cats = get_category_parents($cat, TRUE, $delimiter);  
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                echo $cats;  
                if ($show_current == 1) echo $before . get_the_title() . $after;  
            }  
  
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
            $post_type = get_post_type_object(get_post_type());  
            echo $before . $post_type->labels->singular_name . $after;  
  
        } elseif ( is_attachment() ) {  
            $parent = get_post($parent_id);  
            $cat = get_the_category($parent->ID); $cat = $cat[0];  
            $cats = get_category_parents($cat, TRUE, $delimiter);  
            $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
            $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
            if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
            echo $cats;  
            printf($link, get_permalink($parent), $parent->post_title);  
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
  
        } elseif ( is_page() && !$parent_id ) {  
            if ($show_current == 1) echo $before . get_the_title() . $after;  
  
        } elseif ( is_page() && $parent_id ) {  
            if ($parent_id != $frontpage_id) {  
                $breadcrumbs = array();  
                while ($parent_id) {  
                    $page = get_page($parent_id);  
                    if ($parent_id != $frontpage_id) {  
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
                    }  
                    $parent_id = $page->post_parent;  
                }  
                $breadcrumbs = array_reverse($breadcrumbs);  
                for ($i = 0; $i < count($breadcrumbs); $i++) {  
                    echo $breadcrumbs[$i];  
                    if ($i != count($breadcrumbs)-1) echo $delimiter;  
                }  
            }  
            if ($show_current == 1) {  
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;  
                echo $before . get_the_title() . $after;  
            }  
  
        } elseif ( is_tag() ) {  
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
  
        } elseif ( is_author() ) {  
            global $author;  
            $userdata = get_userdata($author);  
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
  
        } elseif ( is_404() ) {  
            echo $before . $text['404'] . $after;  
        }  
  
        if ( get_query_var('paged') ) {  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';  
            echo __('Page') . ' ' . get_query_var('paged');  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';  
        }  
  
        echo '</div><!-- .breadcrumbs -->';  
  
    }  
} // end breadcrumbs()  

