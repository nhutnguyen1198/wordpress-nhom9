<?php
if ( ! function_exists( 'gadget_store_setup' ) ) :
function gadget_store_setup() {

// Root path/URI.
define( 'GADGET_STORE_PARENT_DIR', get_template_directory() );
define( 'GADGET_STORE_PARENT_URI', get_template_directory_uri() );

// Root path/URI.
define( 'GADGET_STORE_PARENT_INC_DIR', GADGET_STORE_PARENT_DIR . '/inc');
define( 'GADGET_STORE_PARENT_INC_URI', GADGET_STORE_PARENT_URI . '/inc');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	add_theme_support( 'responsive-embeds' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'gadget-store', get_stylesheet_directory() . '/languages' );
		
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'  => esc_html__( 'Primary Menu', 'gadget-store' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
		
	add_theme_support('custom-logo');

	/*
	 * WooCommerce Plugin Support
	 */
	add_theme_support( 'woocommerce' );
	
	// Gutenberg wide images.
	add_theme_support( 'align-wide' );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', gadget_store_google_font() ) );
	
	//Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gadget_store_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-header', apply_filters( 'gadget_store_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/custom-header.png',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000, 
		'height'                 => 200,
		'flex-width'    		 => true,
		'flex-height'    		 => true,
        'uploads'            => true,
	)));


    /*
    * Enable support for Post Formats.
    *
    * See: https://codex.wordpress.org/Post_Formats
    */
    add_theme_support( 'post-formats', array('image','video','gallery','audio',) );


    //  --------------------------------------------- ENQUEUE ----------------------------------------------------- //

    /**
     * Implement the Custom Header feature.
     */
    require_once get_template_directory() . '/inc/custom-header.php';

    /**
     * Load Theme About Page
     */
    require get_parent_theme_file_path( '/inc/aboutthemes/about-theme.php' );

    /**
     * Demo Import
     */
    require get_parent_theme_file_path( '/demo-import/demo-import-settings.php' );
}
endif;
add_action( 'after_setup_theme', 'gadget_store_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gadget_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gadget_store_content_width', 1170 );
}
add_action( 'after_setup_theme', 'gadget_store_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function gadget_store_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'gadget-store' ),
		'id' => 'gadget-store-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'gadget-store' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4><div class="title"><span class="shap"></span></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'gadget-store' ),
		'id' => 'gadget-store-footer-widget-area',
		'description' => __( 'The Footer Widget Area', 'gadget-store' ),
		'before_widget' => '<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h5 class="widget-title w-title">',
		'after_title' => '</h5><span class="shap"></span>',
	) );
}
add_action( 'widgets_init', 'gadget_store_widgets_init' );

/**
 * All Styles & Scripts.
 */

require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Nav Walker fo Bootstrap Dropdown Menu.
 */

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

require_once get_template_directory() . '/inc/fonts.php';

require_once get_template_directory() . '/wptt-webfont-loader.php';

/* Excerpt Limit Begin */
function gadget_store_string_limit_words($gadget_store_string, $gadget_store_word_limit) {
    $gadget_store_words = explode(' ', $gadget_store_string, ($gadget_store_word_limit + 1));
    if(count($gadget_store_words) > $gadget_store_word_limit)
    array_pop($gadget_store_words);
    return implode(' ', $gadget_store_words);
}

function gadget_store_sanitize_select( $gadget_store_input, $gadget_store_setting ) {
	$gadget_store_input = sanitize_key( $gadget_store_input );
	$gadget_store_choices = $gadget_store_setting->manager->get_control( $gadget_store_setting->id )->choices;
	return ( array_key_exists( $gadget_store_input, $gadget_store_choices ) ? $gadget_store_input : $gadget_store_setting->default );
}

// Sanitize the input
function gadget_store_sanitize_sidebar_position( $gadget_store_input ) {
    $gadget_store_valid = array( 'right', 'left' );

    if ( in_array( $gadget_store_input, $gadget_store_valid ) ) {
        return $gadget_store_input;
    } else {
        return 'right';
    }
}

function gadget_store_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/customizer/customizer-custom-controls.php' );
}
add_action( 'customize_register', 'gadget_store_custom_controls' );

add_filter( 'nav_menu_link_attributes', 'gadget_store_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function gadget_store_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

function gadget_store_activation_notice() {
    // Check if the notice has already been dismissed
    if (get_option('gadget_store_notice_dismissed')) {
        return;
    }

    // Avoid showing the notice on the demo import wizard page
    if (isset($_GET['page']) && $_GET['page'] === 'gadgetstore-wizard') {
        return;
    }
    ?>
    <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
        <div class="gadget-store-getting-started-notice clearfix">
            <div class="gadget-store-theme-notice-content">
                <h2 class="gadget-store-notice-h2">
                    <?php
                    printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                        esc_html__('Welcome! Thank you for choosing %1$s!', 'gadget-store'), '<strong>' . wp_get_theme()->get('Name') . '</strong>'
                    );
                    ?>
                </h2>
                <a class="gadget-store-btn-get-started button button-primary button-hero gadget-store-button-padding" 
                    href="<?php echo esc_url(admin_url('themes.php?page=gadgetstore-wizard')); ?>" 
                    id="gadget-store-import-button">
                    <?php esc_html_e('One Click Demo Import', 'gadget-store') ?>
                </a>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_notices', 'gadget_store_activation_notice');

// Add Ajax action to handle dismiss
add_action('wp_ajax_gadget_store_dismiss_notice', 'gadget_store_dismiss_notice');

// Reset the dismissed status when the theme is activated
function gadget_store_notice_status() {
    delete_option('gadget_store_notice_dismissed');
}
add_action('after_switch_theme', 'gadget_store_notice_status');

function gadget_store_dismiss_notice() {
    // Update the option to mark the notice as dismissed
    update_option('gadget_store_notice_dismissed', true);

    // Return a JSON response to indicate the success of the action
    wp_send_json_success();
}

function gadget_store_remove_theme_customizer_setting($wp_customize) {
    // Remove the setting
    $wp_customize->remove_setting('display_header_text');
    // Remove the control
    $wp_customize->remove_control('display_header_text');
}
add_action('customize_register', 'gadget_store_remove_theme_customizer_setting', 20); 
// Use a priority greater than the one used for adding the setting


// Set the number of products per row to 3 on the shop page
add_filter('loop_shop_columns', 'gadget_store_custom_shop_loop_columns');

if (!function_exists('gadget_store_custom_shop_loop_columns')) {
    function gadget_store_custom_shop_loop_columns() {
        // Retrieve the number of columns from theme customizer setting (default: 3)
        $gadget_store_columns = get_theme_mod('gadget_store_custom_shop_per_columns', 3);
        return $gadget_store_columns;
    }
}

// Set the number of products per page on the shop page
add_filter('loop_shop_per_page', 'gadget_store_custom_shop_per_page', 20);

if (!function_exists('gadget_store_custom_shop_per_page')) {
    function gadget_store_custom_shop_per_page($products_per_page) {
        // Retrieve the number of products per page from theme customizer setting (default: 9)
        $products_per_page = get_theme_mod('gadget_store_custom_shop_product_per_page', 9);
        return $products_per_page;
    }
}

function gadget_store_fonts_scripts() {
	$gadget_store_headings_font = esc_html(get_theme_mod('gadget_store_headings_text'));
	$gadget_store_body_font = esc_html(get_theme_mod('gadget_store_body_text'));

	if( $gadget_store_headings_font ) {
		wp_enqueue_style( 'gadget-store-headings-fonts', '//fonts.googleapis.com/css?family='. $gadget_store_headings_font );
	} else {
		wp_enqueue_style( 'gadget-store-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $gadget_store_body_font ) {
		wp_enqueue_style( 'gadget-store-body-fonts', '//fonts.googleapis.com/css?family='. $gadget_store_body_font );
	} else {
		wp_enqueue_style( 'gadget-store-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'gadget_store_fonts_scripts' );

function gadget_store_customize_css() {
    $gadget_store_dynamic_color = get_theme_mod( 'gadget_store_dynamic_color_one', '#27c0fe' );
    $gadget_store_custom_css = ":root { --color-primary1: {$gadget_store_dynamic_color}; }";
    wp_add_inline_style( 'gadget-store-style', $gadget_store_custom_css );
}
add_action( 'wp_enqueue_scripts', 'gadget_store_customize_css' );

/**
 * Enqueue theme copyright alignment style.
 */
function gadget_store_copyright_alignment_option() {
    // Get the alignment setting from the theme customizer.
    $gadget_store_copyright_alignment = get_theme_mod('gadget_store_copyright_alignment', 'center');

    // Start building the CSS string for the alignment.
    $gadget_store_copyright_alignment_css = '
        .copyright-text, .footer-copyright, .footer-copyright a, p.copyright-text {
            text-align: ' . esc_attr($gadget_store_copyright_alignment) . ';
        }
    ';

    // Add the inline style to the theme's main stylesheet.
    wp_add_inline_style('gadget-store-style', $gadget_store_copyright_alignment_css);
}

add_action('wp_enqueue_scripts', 'gadget_store_copyright_alignment_option');

// Helper function to get page ID by slug
function get_page_id_by_slug($gadget_store_slug) {
    $gadget_store_page = get_page_by_path($gadget_store_slug); // Get the page by slug
    return $gadget_store_page ? $gadget_store_page->ID : 0;   // Return the page ID or 0 if not found
}

add_action('init', function () {
    load_plugin_textdomain('currency-switcher-woocommerce', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );