<?php
/*
 *  WP bMaker theme: Bootstrap 4 Sass Custom functions, support, custom post types and more.
 *  Author: Softspring
 *  URL: https://softspring.es
 *
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('wpbmaker', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Register Custom Navigation Walker
require_once('inc/class-wp-bootstrap-navwalker.php');

// WP bMaker navigation
function wpbmaker_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'collapse navbar-collapse',
		'container_id'    => 'bs-example-navbar-collapse-1',
		'menu_class'      => 'navbar-nav',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 2,
		'walker'          => new WP_Bootstrap_Navwalker()
		)
	);
}
function wpbmakerfooter_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'footer-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'bs-example-navbar-collapse-1',
            'menu_class'      => 'navbar-nav',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'depth'           => 2,
            'walker'          => new WP_Bootstrap_Navwalker()
        )
    );
}

// Load WP bMaker scripts (header.php)
function wpbmaker_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // Custom scripts
        wp_register_script('wpbmakerscripts', get_template_directory_uri() . '/dist/main.bundle.js', array('jquery'), '1.0.0');

        // Enqueue it!
        wp_enqueue_script( array('wpbmakerscripts') );

    }
}

// Add attributes to the script tag
// async or defer
// *** for CDN integrity and crossorigin attributes ***
function add_script_tag_attributes($tag, $handle)
{
    switch ($handle) {

    	// adding async to main js bundle
    	// for defer, replace async="async" with defer="defer"
    	case ('wpbmakerscripts'):
    		return str_replace( ' src', ' async="async" src', $tag );
    	break;

    	// example adding CDN integrity and crossorigin attributes
    	// Note: popper.js is loaded into the main.bundle.js from npm
    	// This is just an example
        case ('popper-js'):
            return str_replace( ' min.js', 'min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"', $tag );
        break;

    	// example adding CDN integrity and crossorigin attributes
    	// Note: bootstrap.js is loaded into the main.bundle.js from npm
    	// This is just an example
        case ('bootstrap-js'):
            return str_replace( ' min.js', 'min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"', $tag );
        break;

        default:
            return $tag;

    } // /switch
}

// Load WP bMaker conditional scripts
function wpbmaker_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load WP bMaker styles
function wpbmaker_styles()
{
    // Normalize is loaded in Bootstrap and both are imported into the style.css via Sass
    wp_register_style('wpbmaker', get_template_directory_uri() . '/dist/style.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('wpbmaker'); // Enqueue it!
}

// Register WP bMaker Navigation
function register_wpbmaker_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'wpbmaker'), // Main Navigation
        'footer-menu' => __('Footer Menu', 'wpbmaker'), // Footer Navigation
        'sidebar-menu' => __('Sidebar Menu', 'wpbmaker'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'wpbmaker') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'wpbmaker'),
        'description' => __('Description for this widget-area...', 'wpbmaker'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s card mb-2"><div class="card-body">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="card-title">',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'wpbmaker'),
        'description' => __('Description for this widget-area...', 'wpbmaker'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s card mb-2"><div class="card-body">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="card-title">',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function wpbmaker_pagination()
{
    global $wp_query;
    $big = 999999999;
    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<span class="btn btn-gray-400 text-gray-600"><span class="rotate-180 d-block">&#9658;</span></span>',
        'next_text' => '<span class="btn btn-gray-400 text-gray-600">&#9658;</span>',
        'before_page_number' => '<span class="btn btn-gray-400 font-weight-bold">',
        'after_page_number' => '</span>',
    ));

    if ( $links ) :

        echo $links;

    endif;

}

// Custom Excerpts
function wpbmaker_index($length) // Create 20 Word Callback for Index page Excerpts, call using wpbmaker_excerpt('wpbmaker_index');
{
    return 26;
}

// Create 40 Word Callback for Custom Post Excerpts, call using wpbmaker_excerpt('wpbmaker_custom_post');
function wpbmaker_custom_post($length)
{
    return 20;
}

// Create the Custom Excerpts callback
function wpbmaker_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo($output);
}

// Custom View Article link to Post
function wpbmaker_view_article($more)
{
    global $post;
    //<p><a class="view-article btn btn-secondary" href="' . get_permalink($post->ID) . '" role="button">' . __('Read more', 'wpbmaker') . ' </a></p>';
    return '...';

}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function wpbmaker_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function wpbmakerbmakeravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/bmakeravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function wpbmakercomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

// add Bootstrap 4 .img-fluid class to images inside post content
function add_class_to_image_in_content($content)
{

	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	$document = new DOMDocument();
	libxml_use_internal_errors(true);
	if(utf8_decode($content)!='')
	    $document->loadHTML(utf8_decode($content));

	$imgs = $document->getElementsByTagName('img');
	foreach ($imgs as $img) {
		$img->setAttribute('class','img-fluid');
	}

	$html = $document->saveHTML();
	return $html;

}


function posts_for_current_author($query) {
    global $pagenow;
    if( 'edit.php' != $pagenow || !$query->is_admin ){
        return $query;
    }
    if( !current_user_can( 'manage_options' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}

function move_media () {
    global $menu;
    $menu[15] = $menu[10]; //move media from media 5 to 6
    unset($menu[10]); //free the position 5 so you can use it!
}

function remove_set_admin_color() {
    if ( !current_user_can('manage_options') )
        remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}

/**
 * Redirect To Custom Login Page
 *
 * @since  1.0
 * @refer  http://www.hongkiat.com/blog/wordpress-custom-loginpage/
 */
function redirect_login_page() {

    $register_page  = home_url( '/inscripcion' );
    $login_page    = home_url( '/inscripcion?action=login' );
    $page_viewed   = basename($_SERVER['REQUEST_URI']);

    if( $page_viewed == "registro-login" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }

    if( ($page_viewed == "inscripcion?action=register"||$page_viewed == "?action=register") && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($register_page);
        exit;
    }
}

//function render_password_lost_form( $attributes, $content = null ) {
//    // Parse shortcode attributes
//    $default_attributes = array( 'show_title' => false );
//    $attributes = shortcode_atts( $default_attributes, $attributes );
//
//    if ( is_user_logged_in() ) {
//        return __( 'You are already signed in.', 'personalize-login' );
//    } else {
//        return $this->get_template_html( 'password-lost-form', $attributes );
//    }
//}

// Redirect For Login Failed
function login_failed() {
    wp_redirect( home_url( '/inscripcion?action=login&login=failed' ) );
    exit;
}

// Redirect For Empty Username Or Password
function verify_username_password( $user, $username, $password ) {
    if ( $username == "" || $password == "" ) {

        wp_redirect( home_url( '/inscripcion?action=login&login=empty' ) );
        exit;
    }
}
function custom_post_type_cat_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ($query->is_category()) {
            $query->set( 'post_type', array( 'post', 'etapa01', 'etapa02', 'etapa03', 'etapa04', 'etapa05', 'etapaextra' ) );
        }
    }
}

//add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
//
//function my_custom_dashboard_widgets() {
//    global $wp_meta_boxes;
//
//    wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
//}
//
//function custom_dashboard_help() {
//    echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
//}
//
//// Remove dashboard widgets
//function remove_dashboard_meta() {
//    if ( ! current_user_can( 'manage_options' ) ) {
//        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
//        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
//        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
//        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
//    }
//}
//add_action( 'admin_init', 'remove_dashboard_meta' );
//// Create the function to use in the action hook
//function dashboard_widget_function( $post, $callback_args ) {
//    $html = "<a href='./post-new.php?post_type=etapa01'>Añadir la primera etapa</a>Hello World, this is my first Dashboard Widget!";
//	echo $html;
//}
//
//// Function used in the action hook
//function add_dashboard_widgets() {
//	wp_add_dashboard_widget('dashboard_widget', 'Etapas del concurso', 'dashboard_widget_function');
//}
//
//// Register the new dashboard widget with the 'wp_dashboard_setup' action
//add_action('wp_dashboard_setup', 'add_dashboard_widgets' );

//add_action( 'admin_menu', 'limit_teachet_post', 999 );
//function limit_teachet_post() {
//    //Get user id
//    $current_user = wp_get_current_user();
//    $user_id = $current_user->ID;
//
//    //Get number of posts authored by user
//    $args = array('post_type' =>'etapa01','author'=>$user_id,'fields'>'ids');
//    $count = count(get_posts($args));
//
//    //Conditionally remove link:
//    if($count>1)
//        $page = remove_submenu_page( 'edit.php?post_type=etapa01', 'post-new.php?post_type=etapa01' );
//}

//add_action( 'admin_menu', 'myprefix_adjust_the_wp_menu', 999 );
//function myprefix_adjust_the_wp_menu() {
//    //Get user id
//    $current_user = wp_get_current_user();
//    $user_id = $current_user->ID;
//
//    //Get number of posts authored by user
//    $args = array('post_type' =>'etapa01','author'=>$user_id,'fields'>'ids');
//    $count = count(get_posts($args));
//echo('-------------');
//echo($count);
//    //Conditionally remove link:
//    if($count==1)
//        $page = remove_submenu_page( 'edit.php?post_type=etapa01', 'post-new.php?post_type=etapa01' );
//}
/* Quitar actualizaciones de los plugins de la lista "unset"*/
function disable_plugin_updates( $value ) {
    unset( $value->response['user-registration/user-registration.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

function admin_css() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/custom-admin.css' );
}
add_action('admin_print_styles', 'admin_css' );

function login_css() {
    wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/custom-login.css' );
}

if ( ! has_action( 'login_enqueue_scripts', 'wp_print_styles' ) )
    add_action( 'login_enqueue_scripts', 'wp_print_styles', 11 );
add_action( 'login_enqueue_scripts', 'login_css');


function disable_new_posts() {
    //Get user id
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    $user_info = get_userdata( $user_id );
    if(in_array( 'teacher', $user_info->roles) ) {
        //Get number of posts authored by user
        $args = array('post_type' =>'etapa01','author'=>$user_id,'fields'>'ids');
        $count = count(get_posts($args));

        //Conditionally remove link:
        if($count===1) {
            echo '<style type="text/css">
        #wp-admin-bar-new-etapa01, .post-type-etapa01 .page-title-action, #adminmenu .menu-icon-etapa01 .wp-submenu li:last-child { display:none; }
        </style>';

        }

        //Get number of posts authored by user
        $args = array('post_type' =>'etapa03','author'=>$user_id,'fields'>'ids');
        $count = count(get_posts($args));

        //Conditionally remove link:
        if($count===1) {
            echo '<style type="text/css">
        #wp-admin-bar-new-etapa03, .post-type-etapa03 .page-title-action, #adminmenu .menu-icon-etapa03 .wp-submenu li:last-child { display:none; }
        </style>';

        }
        //Get number of posts authored by user
        $args = array('post_type' =>'etapa05','author'=>$user_id,'fields'>'ids');
        $count = count(get_posts($args));

        //Conditionally remove link:
        if($count===1) {
            echo '<style type="text/css">
        #wp-admin-bar-new-etapa05, .post-type-etapa05 .page-title-action, #adminmenu .menu-icon-etapa05 .wp-submenu li:last-child { display:none; }
        </style>';
        }
    }

}
add_action('admin_head', 'disable_new_posts');

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'wpbmaker_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'wpbmaker_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'wpbmaker_styles'); // Add Theme Stylesheet
add_action('init', 'register_wpbmaker_menu'); // Add WP bMaker Menu
add_action('init', 'create_post_type_custom_post_type_demo'); // Add our WP bMaker Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
//add_action('init', 'wpbmaker_pagination'); // Add our wpbmaker Pagination
add_action('admin_menu', 'move_media'); // Move media in menu
add_action('admin_head', 'remove_set_admin_color');

add_action('init','redirect_login_page');
add_action( 'wp_login_failed', 'login_failed' );

add_action('pre_get_posts','custom_post_type_cat_filter');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('script_loader_tag', 'add_script_tag_attributes', 10, 2); // Add attributes to CDN script tag
add_filter('avatar_defaults', 'wpbmakerbmakeravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'wpbmaker_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'wpbmaker_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
// add .img-fluid class to images in the content
add_filter('the_content', 'add_class_to_image_in_content');

add_filter('pre_get_posts', 'posts_for_current_author');

add_filter( 'authenticate', 'verify_username_password', 1, 3);

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('wpbmaker_shortcode_demo', 'wpbmaker_shortcode_demo'); // You can place [wpbmaker_shortcode_demo] in Pages, Posts now.
add_shortcode('wpbmaker_shortcode_demo_2', 'wpbmaker_shortcode_demo_2'); // Place [wpbmaker_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [wpbmaker_shortcode_demo] [wpbmaker_shortcode_demo_2] Here's the page title! [/wpbmaker_shortcode_demo_2] [/wpbmaker_shortcode_demo]

//function be_post_block_template() {
//    $post_type_object = get_post_type_object( 'etapa01' );
//    $post_type_object->template = array(
//        array( 'acf/ad' )
//    );
//
//
//}
//add_action( 'init', 'be_post_block_template' );


function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type === 'etapaextra') return false;
    return $current_status;
}

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called custom-post-type
function create_post_type_custom_post_type_demo()
{
    register_taxonomy_for_object_type('category', 'custom-post-type'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'custom-post-type');
    register_post_type(// Register Custom Post Type
        'etapa01',
        array(
            'labels'=>array(
                'name'=>'Hito 1',
                'singular_name'=>'Hito 1',
                'add_new'=>'Añadir Hito 1',
                'add_new_item'=>'Añadir nueva entrada de hito 1',
                'edit_item'=>'Editar entrada de hito 1',
                'new_item'=>'Nueva entrada de hito 1',
                'view_item'=>'Ver entrada de hito 1',
                'search_items'=>'Buscar entradas de hito 1',
                'not_found'=>'No se encontraron entradas de hito 1',
                'not_found_in_trash'=>'No se encontraron entradas de hito 1 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-1'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa01',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );
    register_post_type(// Register Custom Post Type
        'etapa02',
        array(
            'labels'=>array(
                'name'=>'Hito 2',
                'singular_name'=>'Hito 2',
                'add_new'=>'Añadir Hito 2',
                'add_new_item'=>'Añadir nueva entrada de hito 2',
                'edit_item'=>'Editar entrada de hito 2',
                'new_item'=>'Nueva entrada de hito 2',
                'view_item'=>'Ver entrada de hito 2',
                'search_items'=>'Buscar entradas de hito 2',
                'not_found'=>'No se encontraron entradas de hito 2',
                'not_found_in_trash'=>'No se encontraron entradas de hito 1 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-2'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa02',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );
    register_post_type(// Register Custom Post Type
        'etapa03',
        array(
            'labels'=>array(
                'name'=>'Hito 3',
                'singular_name'=>'Hito 3',
                'add_new'=>'Añadir Hito 3',
                'add_new_item'=>'Añadir nueva entrada de hito 3',
                'edit_item'=>'Editar entrada de hito 3',
                'new_item'=>'Nueva entrada de hito 3',
                'view_item'=>'Ver entrada de hito 3',
                'search_items'=>'Buscar entradas de hito 3',
                'not_found'=>'No se encontraron entradas de hito 3',
                'not_found_in_trash'=>'No se encontraron entradas de hito 3 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-3'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa03',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );

    register_post_type(// Register Custom Post Type
        'etapa04',
        array(
            'labels'=>array(
                'name'=>'Hito 4',
                'singular_name'=>'Hito 4',
                'add_new'=>'Añadir Hito 4',
                'add_new_item'=>'Añadir nueva entrada de hito 4',
                'edit_item'=>'Editar entrada de hito 4',
                'new_item'=>'Nueva entrada de hito 4',
                'view_item'=>'Ver entrada de hito 4',
                'search_items'=>'Buscar entradas de hito 4',
                'not_found'=>'No se encontraron entradas de hito 4',
                'not_found_in_trash'=>'No se encontraron entradas de hito 4 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-4'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa04',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );

    register_post_type(// Register Custom Post Type
        'etapa05',
        array(
            'labels'=>array(
                'name'=>'Hito 5',
                'singular_name'=>'Hito 5',
                'add_new'=>'Añadir Hito 5',
                'add_new_item'=>'Añadir nueva entrada de hito 5',
                'edit_item'=>'Editar entrada de hito 5',
                'new_item'=>'Nueva entrada de hito 5',
                'view_item'=>'Ver entrada de hito 5',
                'search_items'=>'Buscar entradas de hito 5',
                'not_found'=>'No se encontraron entradas de hito 5',
                'not_found_in_trash'=>'No se encontraron entradas de hito 5 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-5'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa05',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );

    register_post_type(// Register Custom Post Type
        'etapa06',
        array(
            'labels'=>array(
                'name'=>'Hito 6',
                'singular_name'=>'Hito 6',
                'add_new'=>'Añadir Hito 6',
                'add_new_item'=>'Añadir nueva entrada de hito 6',
                'edit_item'=>'Editar entrada de hito 6',
                'new_item'=>'Nueva entrada de hito 6',
                'view_item'=>'Ver entrada de hito 6',
                'search_items'=>'Buscar entradas de hito 6',
                'not_found'=>'No se encontraron entradas de hito 6',
                'not_found_in_trash'=>'No se encontraron entradas de hito 6 en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-6'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>4,
            'menu_icon'=>'dashicons-chart-bar',
            'hierarchical'=>false,
            'capability_type' => 'etapa06',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
                'title',
                'editor',
                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );
    register_post_type(// Register Custom Post Type
        'etapaextra',
        array(
            'labels'=>array(
                'name'=>'Video/s resultado final',
                'singular_name'=>'Video/s resultado final',
                'add_new'=>'Añadir Video/s resultado final',
                'add_new_item'=>'Añadir nueva entrada de Video/s resultado final',
                'edit_item'=>'Editar entrada de Video/s resultado final',
                'new_item'=>'Nueva entrada de Video/s resultado final',
                'view_item'=>'Ver entrada de Video/s resultado final',
                'search_items'=>'Buscar entradas de Video/s resultado final',
                'not_found'=>'No se encontraron entradas de Video/s resultado final',
                'not_found_in_trash'=>'No se encontraron entradas de Equipos en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'hito-extra'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>5,
            'menu_icon'=>'dashicons-video-alt3',
            'hierarchical'=>false,
            'capability_type' => 'etapa-extra',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
//                'title',
//                'editor',
//                'thumbnail',
                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
                'post_tag',
                'category'
            ),
        )
    );

    register_post_type(// Register Custom Post Type
        'winners',
        array(
            'labels'=>array(
                'name'=>'Ganadores',
                'singular_name'=>'Ganador',
                'add_new'=>'Añadir Ganadores',
                'add_new_item'=>'Añadir nueva entrada de Ganadores',
                'edit_item'=>'Editar entrada de Ganadores',
                'new_item'=>'Nueva entrada de Ganadores',
                'view_item'=>'Ver entrada de Ganadores',
                'search_items'=>'Buscar entradas de Ganadores',
                'not_found'=>'No se encontraron entradas de Ganadores',
                'not_found_in_trash'=>'No se encontraron entradas de Ganadores en la papelera'
            ),
            'rewrite' => array(
                'slug' => 'ganadores'
            ),
            'public'=>true,
            'has_archive'=>true,
            'menu_position'=>6,
            'menu_icon'=>'dashicons-awards',
            'hierarchical'=>false,
            'capability_type' => 'winners',
            'map_meta_cap' => true,
            'show_in_rest'  => true,
            'supports'=>array(
//                'title',
//                'editor',
//                'thumbnail',
//                'author',
                'slug'
                //'custom-fields',
            ),
            'taxonomies'=> array(
//                'post_tag',
//                'category'
            ),
        )
    );

//    register_post_type(// Register Custom Post Type
//        'video',
//        array(
//            'labels'=>array(
//                'name'=>'Vídeo final',
//                'singular_name'=>'Vídeo final',
//                'add_new'=>'Vídeo final',
//                'add_new_item'=>'Añadir nueva entrada de vídeo final',
//                'edit_item'=>'Editar entrada de vídeo final',
//                'new_item'=>'Nueva entrada de vídeo final',
//                'view_item'=>'Ver entrada de vídeo final',
//                'search_items'=>'Buscar entradas de vídeo final',
//                'not_found'=>'No se encontraron entradas de vídeo final',
//                'not_found_in_trash'=>'No se encontraron entradas de vídeo final en la papelera'
//            ),
//            'rewrite' => array(
//                'slug' => 'video'
//            ),
//            'public'=>true,
//            'has_archive'=>true,
//            'menu_position'=>6,
//            'menu_icon'=>'dashicons-video-alt3',
//            'hierarchical'=>false,
//            'capability_type' => 'video',
//            'map_meta_cap' => true,
//            'show_in_rest'  => true,
//            'supports'=>array(
////                'title',
////                'editor',
////                'thumbnail',
//                'author',
//                'slug'
//                //'custom-fields',
//            ),
//            'taxonomies'=> array(
//                'post_tag',
//                'category'
//            ),
//        )
//    );
//    register_post_type('custom-post-type', // Register Custom Post Type
//        array(
//        'labels' => array(
//            'name' => __('WP bMaker Custom Post', 'wpbmaker'), // Rename these to suit
//            'singular_name' => __('WP bMaker Custom Post', 'wpbmaker'),
//            'add_new' => __('Add New', 'wpbmaker'),
//            'add_new_item' => __('Add New WP bMaker Custom Post', 'wpbmaker'),
//            'edit' => __('Edit', 'wpbmaker'),
//            'edit_item' => __('Edit WP bMaker Custom Post', 'wpbmaker'),
//            'new_item' => __('New WP bMaker Custom Post', 'wpbmaker'),
//            'view' => __('View WP bMaker Custom Post', 'wpbmaker'),
//            'view_item' => __('View WP bMaker Custom Post', 'wpbmaker'),
//            'search_items' => __('Search WP bMaker Custom Post', 'wpbmaker'),
//            'not_found' => __('No WP bMaker Custom Posts found', 'wpbmaker'),
//            'not_found_in_trash' => __('No WP bMaker Custom Posts found in Trash', 'wpbmaker')
//        ),
//        'public' => true,
//        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
//        'has_archive' => true,
//        'supports' => array(
//            'title',
//            'editor',
//            'excerpt',
//            'thumbnail'
//        ), // Go to Dashboard Custom WP bMaker post for supports
//        'can_export' => true, // Allows export in Tools > Export
//        'taxonomies' => array(
//            'post_tag',
//            'category'
//        ) // Add Category and Post Tags support
//    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function wpbmaker_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function wpbmaker_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}


?>


