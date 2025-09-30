<?php

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', 'gadget_shop_my_theme_enqueue_styles');
function gadget_shop_my_theme_enqueue_styles() {
    $gadget_shop_parent_style = 'gadget-store-main'; // Style handle of parent theme
    wp_enqueue_style($gadget_shop_parent_style, get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('gadget-shop-style', get_stylesheet_uri(), array($gadget_shop_parent_style));
}

add_action('wp_enqueue_scripts', 'gadget_shop_script');
function gadget_shop_script() {
    $gadget_shop_parent_script_handle = 'gadget-store-theme-js'; // Script handle of parent theme
    wp_enqueue_script($gadget_shop_parent_script_handle, get_theme_file_uri('/assets/js/theme.js'), array(), null, true);
}

// Theme setup
if (!function_exists('gadget_shop_setup')) :
    function gadget_shop_setup() {
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('custom-header');
        add_theme_support('responsive-embeds');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');
        load_theme_textdomain( 'gadget-shop', get_template_directory() . '/languages' );
        add_editor_style(array('assets/css/editor-style.css'));
        add_theme_support('custom-background', apply_filters('gadget_shop_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        if ( ! defined( 'GADGET_SHOP_DEMO_IMPORT_URL' ) ) {
            define( 'GADGET_SHOP_DEMO_IMPORT_URL', esc_url( admin_url( 'themes.php?page=gadgetshop-wizard' ) ) );
        }
        if ( ! defined( 'GADGET_SHOP_WELCOME_MESSAGE' ) ) {
            define( 'GADGET_SHOP_WELCOME_MESSAGE', __( 'Welcome! Thank you for choosing Gadget Shop', 'gadget-shop' ) );
        }

    }
endif;
add_action('after_setup_theme', 'gadget_shop_setup');

// Set content width
function gadget_shop_content_width() {
    $GLOBALS['content_width'] = apply_filters('gadget_shop_content_width', 1170);
}
add_action('after_setup_theme', 'gadget_shop_content_width', 0);

// Register widget areas
function gadget_shop_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'gadget-shop'),
        'id' => 'gadget-store-sidebar-primary',
        'description' => __('The Primary Widget Area', 'gadget-shop'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4><div class="title"><span class="shap"></span></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'gadget-shop'),
        'id' => 'gadget-store-footer-widget-area',
        'description' => __('The Footer Widget Area', 'gadget-shop'),
        'before_widget' => '<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h5 class="widget-title w-title">',
        'after_title' => '</h5><span class="shap"></span>',
    ));
}
add_action('widgets_init', 'gadget_shop_widgets_init');

function gadget_shop_customize_css() {
    $gadget_store_dynamic_color_one = get_theme_mod( 'gadget_store_dynamic_color_one', '#27C0FE' );

    $gadget_store_custom_css = "
        :root {
            --color-primary1: {$gadget_store_dynamic_color_one} !important;
        }
    ";

    // Add the custom CSS inline to the site
    wp_add_inline_style( 'gadget-store-style', $gadget_store_custom_css );
}
add_action( 'wp_enqueue_scripts', 'gadget_shop_customize_css' );

// NOTICE
function gadget_shop_activation_notice() {
    // Check if the notice has already been dismissed
    if (get_option('gadget_store_notice_dismissed')) {
        return;
    }

    // Avoid showing the notice on the demo import wizard page
    if (isset($_GET['page']) && $_GET['page'] === 'gadgetshop-wizard') {
        return;
    }
    ?>
    <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
        <div class="gadget-store-getting-started-notice clearfix">
            <div class="gadget-store-theme-notice-content">
                <h2 class="gadget-store-notice-h2">
					<?php echo esc_html( GADGET_SHOP_WELCOME_MESSAGE ); ?>
                </h2>
                <a class="gadget-store-btn-get-started button button-primary button-hero gadget-store-button-padding" 
                    href="<?php echo esc_url( GADGET_SHOP_DEMO_IMPORT_URL ); ?>" 
                    id="gadget-store-import-button">
                    <?php esc_html_e('One Click Demo Import', 'gadget-store') ?>
                </a>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_notices', 'gadget_shop_activation_notice');

// Add Ajax action to handle dismiss
add_action('wp_ajax_gadget_shop_dismiss_notice', 'gadget_shop_dismiss_notice');

// Reset the dismissed status when the theme is activated
function gadget_shop_notice_status() {
    delete_option('gadget_shop_notice_dismissed');
}
add_action('after_switch_theme', 'gadget_shop_notice_status');

function gadget_shop_dismiss_notice() {
    // Update the option to mark the notice as dismissed
    update_option('gadget_shop_notice_dismissed', true);

    // Return a JSON response to indicate the success of the action
    wp_send_json_success();
}

function gadget_store_remove_parent_activation_notice() {
    remove_action('wp_ajax_gadget_store_dismiss_notice', 'gadget_store_dismiss_notice');
    remove_action('admin_notices', 'gadget_store_activation_notice');
}
add_action('init', 'gadget_store_remove_parent_activation_notice');