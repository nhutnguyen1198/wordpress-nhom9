<?php
/**
 * Online Education Classes functions and definitions.
 *
 * @package Online Education Classes
 */

/**
 *  Defining Constants
 */

// Core Constants
define('ONLINE_EDUCATION_CLASSES_REQUIRED_PHP_VERSION', '5.6' );
define('ONLINE_EDUCATION_CLASSES_DIR_PATH', get_template_directory());
define('ONLINE_EDUCATION_CLASSES_DIR_URI', get_template_directory_uri());
define('ONLINE_EDUCATION_CLASSES_AUT','https://www.legacytheme.net/products/free-educational-wordpress-theme/');

if ( ! function_exists( 'online_education_classes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function online_education_classes_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // support alig-wide
    add_theme_support( 'align-wide' );

    add_theme_support( "wp-block-styles" );

    add_theme_support( "responsive-embeds" );

    load_theme_textdomain( 'online-education-classes', get_template_directory() . '/languages' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'online-education-classes' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(      
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Gallery post format
    add_theme_support( 'post-formats', array( 'gallery' ));

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
    add_action( 'after_setup_theme', 'online_education_classes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function online_education_classes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'online_education_classes_content_width', 640 );
}
add_action( 'after_setup_theme', 'online_education_classes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function online_education_classes_widgets_init() {
	//Footer widget columns
    $online_education_classes_widget_num = absint(get_theme_mod( 'online_education_classes_footer_widgets', '4' ));
    for ( $i=1; $i <= $online_education_classes_widget_num; $i++ ) :
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Column', 'online-education-classes' ) . $i,
            'id'            => 'footer-' . $i,
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="section %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title" itemprop="name">',
            'after_title'   => '</h4>',
        ) );
    endfor;

    register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'online-education-classes' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'online-education-classes' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 2', 'online-education-classes' ),
        'id'            => 'sidebar-2',
        'description'   => esc_html__( 'Add widgets here.', 'online-education-classes' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 3', 'online-education-classes' ),
        'id'            => 'sidebar-3',
        'description'   => esc_html__( 'Add widgets here.', 'online-education-classes' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'online_education_classes_widgets_init' );

/** 
* Excerpt More
*/
function online_education_classes_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
    return '&hellip;';
}
add_filter('excerpt_more', 'online_education_classes_excerpt_more');


/** 
* Custom excerpt length.
*/
function online_education_classes_excerpt_length() {
	$length= intval(get_theme_mod('online_education_classes_posts_excerpt_length',30));
    return $length;
}
add_filter('excerpt_length', 'online_education_classes_excerpt_length');

/*
script goes here
*/
function online_education_classes_scripts() {

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/css/bootstrap-icons.css', array(), '5.3.3');
    wp_enqueue_style( 'online-education-classes-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
    wp_style_add_data('online-education-classes-style', 'rtl', 'replace');
	wp_enqueue_style( 'm-customscrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array(), '3.1.5');    
    wp_enqueue_style( 'poppins-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), '1.0');

    wp_enqueue_style( 'roboto-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap', array(), '1.0');

    wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel' . '.css', array(), '2.3.4' );

    // Block stylesheet.
    wp_enqueue_style( 'online-education-classes-block-style', get_theme_file_uri( '/css/blocks-styles.css' ), array( 'online-education-classes-style' ), '1.0' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	
	wp_enqueue_script( 'resize-sensor', get_template_directory_uri() . '/js/ResizeSensor.js',array(),'1.0.0', true );
	wp_enqueue_script( 'm-customscrollbar-js', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js',array(),'3.1.5', true );	
    
	wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js',array(), '3.7.3');
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), '5.3.3', true );

    wp_enqueue_script( 'online-education-classes-main-js', get_template_directory_uri() . '/js/main.js', array('jquery', 'customize-preview'), '1.0', true );
    wp_enqueue_script( 'owl-carouselscript', get_template_directory_uri() . '/js/owl.carousel' . '.js', array( 'jquery' ), '2.3.4', true );

add_action( 'customize_preview_init', 'my_customizer_live_preview' );
    
}
add_action( 'wp_enqueue_scripts', 'online_education_classes_scripts' );

/**
* Custom search form
*/
function online_education_classes_search_form( $online_education_classes_form ) {
    $online_education_classes_form = '<form method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
    <div class="search">
      <input type="text" value="' . get_search_query() . '" class="blog-search" name="s" id="s" placeholder="'. esc_attr__( 'Search here','online-education-classes' ) .'">
      <label for="searchsubmit" class="search-icon"><i class="bi bi-search"></i></label>
      <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','online-education-classes' ) .'" />
    </div>
    </form>';
    return $online_education_classes_form;
}
add_filter( 'get_search_form', 'online_education_classes_search_form', 100 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function online_education_classes_pingback_header() {
    if ( is_singular() && pings_open() ) {
       printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
    }
}
add_action( 'wp_head', 'online_education_classes_pingback_header' );

// Add WooCommerce support to the theme
function online_education_classes_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'online_education_classes_add_woocommerce_support' );

// Change the number of product columns in WooCommerce shop page
function online_education_classes_change_woocommerce_shop_columns( $columns ) {
    $columns = 3; // Change this number to your desired column count (e.g., 2, 3, 4, etc.)
    return $columns;
}
add_filter( 'loop_shop_columns', 'online_education_classes_change_woocommerce_shop_columns', 999 );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path() . '/inc/customizer/customizer.php';

/**
 * Template functions
 */
require get_parent_theme_file_path() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom template hooks for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-hooks.php';

/**
 * Extra classes for this theme.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

// extra customization
require_once get_template_directory() . '/inc/theme-customizations.php';

 /**getstart*/
require get_template_directory() . '/inc/online-education-classes-get-theme-info.php';

if ( ! function_exists( 'online_education_classes_admin_scripts' ) ) :
    function online_education_classes_admin_scripts($hook) {
        wp_enqueue_style( 'online-education-classes-get-theme-info-css', get_template_directory_uri() . '/css/online-education-classes-get-theme-info.css', false ); 
    }
endif;
add_action( 'admin_enqueue_scripts', 'online_education_classes_admin_scripts' );
/**
 * Upgrade to Pro
 */
require_once( trailingslashit( get_template_directory() ) . 'online-education-classes-pro/class-customize.php' );

/**
 * Notices
 */
require_once get_parent_theme_file_path( '/inc/activation-notice/class-welcome-notice.php' );

/**
 * Theme DEMO IMPORT.
 */
require get_template_directory() . '/inc/quick-start-page.php';

/**
 * Theme TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

// Add this function to  theme for the deprecated error
function online_education_classes_get_page_id_by_title($title) {
    $query = new WP_Query(array(
        'post_type'      => 'page',
        'posts_per_page' => 1,
        'post_status'    => 'publish',
        's'              => $title,
    ));

    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            if (strcasecmp($post->post_title, $title) === 0) {
                return $post->ID;
            }
        }
    }

    return false; // Return false if not found
}
