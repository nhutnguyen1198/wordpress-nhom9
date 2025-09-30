<?php
// Enqueue theme styles and custom inline CSS
function online_education_enqueue_styles() {
    wp_enqueue_style('online-education-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'online_education_enqueue_styles');

// Custom Header Support
add_theme_support('custom-header', array(
    'width'              => 1920,
    'height'             => 400,
    'flex-height'        => true,
    'flex-width'         => true,
    'header-text'        => true,
    'default-text-color' => '000000',
    'wp-head-callback'   => 'online_education_classes_header_style',
));

// Custom Background
add_theme_support('custom-background', array(
    'default-color' => 'ffffff',
));

// Style the Header
function online_education_classes_header_style() {
    $header_image = get_header_image();
    $header_text_color = get_header_textcolor();
    $default_text_color = get_theme_support('custom-header', 'default-text-color');

    $custom_css = '';

    if ($default_text_color !== $header_text_color || !empty($header_image)) {
        if (!empty($header_image)) {
            $custom_css .= "
                #custom-header {
                    background-image: url(" . esc_url($header_image) . ");
                    background-repeat: no-repeat;
                    background-position: 50% 50%;
                    background-size: cover;
                }
            ";
        }

        if ('blank' === $header_text_color || '' !== $header_text_color) {
            $custom_css .= "
                .site-title a, .site-description {
                    color: #" . esc_attr($header_text_color) . ";
                }
            ";
        }

        wp_add_inline_style('online-education-style', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'online_education_classes_header_style');

// Remove Customizer Header Text Checkbox
function online_education_classes_remove_header_text_display_checkbox($wp_customize) {
    $wp_customize->remove_control('display_header_text');
}
add_action('customize_register', 'online_education_classes_remove_header_text_display_checkbox', 11);

// Custom Logo
function online_education_classes_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 65,
        'width'       => 350,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'online_education_classes_logo_setup');

// Logo Dynamic CSS
function online_education_classes_logo_dynamic_css() {
    $logo_width = get_theme_mod('online_education_classes_logo_width', 150);

    $custom_css = "
        .logo .custom-logo {
            max-width: {$logo_width}px;
            height: auto;
        }
    ";

    wp_add_inline_style('online-education-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'online_education_classes_logo_dynamic_css');

// Button Styling
function online_education_classes_custom_button_styles() {
    $radius = get_theme_mod('online_education_classes_button_border_radius', '0px');
    $padding = get_theme_mod('online_education_classes_button_padding', '10px 35px');

    $custom_css = "
        .btn,
        .button,
        button,
        input[type='submit'],
        .wp-block-button__link,
        #blog-section .read-more a,
        .read-more a,
        a.btn-slid.btn {
            border-radius: {$radius};
            padding: {$padding};
        }
    ";

    wp_add_inline_style('online-education-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'online_education_classes_custom_button_styles');

// Font Customization
function online_education_classes_customize_fonts() {
    $body_font = get_theme_mod('online_education_classes_body_font_family', 'Poppins, sans-serif');
    $heading_font = get_theme_mod('online_education_classes_heading_font_family', 'Poppins, sans-serif');

    $body_font_name = trim(explode(',', $body_font)[0]);
    $heading_font_name = trim(explode(',', $heading_font)[0]);

    $google_fonts_url = 'https://fonts.googleapis.com/css2?family=' . urlencode($body_font_name) . '&family=' . urlencode($heading_font_name) . '&display=swap';

    wp_enqueue_style('online-education-classes-fonts', $google_fonts_url, array(), null);

    $custom_css = "
        body, p, span, label, div {
            font-family: {$body_font};
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: {$heading_font};
        }
    ";

    wp_add_inline_style('online-education-classes-fonts', $custom_css);
}
add_action('wp_enqueue_scripts', 'online_education_classes_customize_fonts');

// page title box
function online_education_classes_page_title_dynamic_styles() {
    $bg_type = get_theme_mod('online_education_classes_page_bg_radio', '');
    $bg_color = get_theme_mod('online_education_classes_page_bg_color', '');
    $bg_image = get_theme_mod('online_education_classes_page_bg_image', '');
    $global_color = get_theme_mod('online_education_classes_global_color1', '#179BD7');

    $online_education_classes_dynamic_css = '';

    if ($bg_type === 'image' && !empty($bg_image)) {
        $online_education_classes_dynamic_css .= '.page-title {';
        $online_education_classes_dynamic_css .= 'background-image: url("' . esc_url($bg_image) . '");';
        $online_education_classes_dynamic_css .= 'background-size: cover;';
        $online_education_classes_dynamic_css .= 'background-position: center;';
        $online_education_classes_dynamic_css .= '}';
    } elseif ($bg_type === 'color' && !empty($bg_color)) {
        $online_education_classes_dynamic_css .= '.page-title {';
        $online_education_classes_dynamic_css .= 'background-color: ' . esc_attr($bg_color) . ';';
        $online_education_classes_dynamic_css .= '}';
    } else {
        // Fallback to global theme color
        $online_education_classes_dynamic_css .= '.page-title {';
        $online_education_classes_dynamic_css .= 'background-color: ' . esc_attr($global_color) . ';';
        $online_education_classes_dynamic_css .= '}';
    }

    if (!empty($online_education_classes_dynamic_css)) {
        echo '<style type="text/css">' . $online_education_classes_dynamic_css . '</style>';
    }
}
add_action('wp_head', 'online_education_classes_page_title_dynamic_styles', 20);

// global color
function online_education_classes_global_color_custom_css() {
    $online_education_classes_whole_color   = get_theme_mod('online_education_classes_global_color1', '#179BD7');
    
    $online_education_classes_bg_type       = get_theme_mod('online_education_classes_page_bg_radio', 'color');

    $online_education_classes_theme_css = '';

    if (!empty($online_education_classes_whole_color)) {
        // Apply global background only if no custom bg for page-title
        if ($online_education_classes_bg_type !== 'color' && $online_education_classes_bg_type !== 'image') {
            $online_education_classes_theme_css .= '.page-title .content-section{ background: ' . esc_attr($online_education_classes_whole_color) . '; }';
        }

        $online_education_classes_theme_css .= '#footer,#sidebar-wrapper h3, #sidebar-wrapper label.wp-block-search__label, #sidebar-wrapper .widget_block h3, #sidebar-wrapper h2, #sidebar-wrapper label.wp-block-search__label,.wp-block-file .wp-block-file__button,.wp-block-button .wp-block-button__link,#footer select,a.btntoTop:hover,a.wc-block-components-button.wp-element-button.wc-block-cart__submit-button.contained,#blog-section .read-more a,.post-tags a:hover,.blog .pagination .nav-links .current,.woocommerce .woocommerce-info .button,button.woocommerce-Button.button,.woocommerce span.onsale,.woocommerce div.product form.cart .button,.woocommerce ul.products li.product .button,.wc-block-grid__product-add-to-cart .wp-block-button__link,button,input[type="submit"],aside form #searchsubmit,#sidebar-wrapper ul li:not(.recentcomments) a:before,.menu-colr-bg,.slider-sec button.owl-prev i:hover,.slider-sec button.owl-next i:hover,a.btn-slid.btn,section#experiences-wrap button.owl-prev i,section#experiences-wrap button.owl-next i,vs{';
        $online_education_classes_theme_css .= 'background: ' . esc_attr($online_education_classes_whole_color) . ';';
        $online_education_classes_theme_css .= '}';

        $online_education_classes_theme_css .= 'textarea,#sidebar-wrapper .widget ul li a, #footer .footer-widgets .widget ul li a, #footer .footer-widgets .section ul li a,div#sidebar-wrapper .wp-block-latest-comments__comment-author, div#sidebar-wrapper .wp-block-latest-comments__comment-link,.loader-pulse,.woocommerce.widget_shopping_cart .buttons a,#footer .wp-block-button__link,div.footer-widgets-wrapper p.wp-block-tag-cloud a,div.footer-widgets-wrapper .tagcloud a,p.wp-block-tag-cloud a,div.footer-widgets-wrapper .tag-cloud a,#blog-section .meta a,#blog-section .meta span,#blog-section .meta span,#blog-section .meta span a,.nav-previous a .post-title,.nav-next a .post-title,aside #searchform div,.woocommerce ul.products li.product .price,.detail-sidebar ul li a:hover,.inn-sidebar ul li a:hover,.woocommerce-My,#site-navigation .menu ul li a:hover,.page_item_has_children ul li a,.main-navigation .menu .menu-item-has-children ul li a,.woocommerce-MyAccount-content a,.wp-block-file .wp-block-file__button,.wp-block-button.is-style-outline .wp-block-button__link,a.btntoTop,div#sidebar-wrapper .widget ul li a,div#sidebar-wrapper select,div#sidebar-wrapper p.wp-block-tag-cloud a:before,div#sidebar-wrapper .tagcloud a:before,div#sidebar-wrapper p.wp-block-tag-cloud a:before,div#sidebar-wrapper p.wp-block-tag-cloud a,div#sidebar-wrapper .tagcloud a,div#sidebar-wrapper p.wp-block-tag-cloud a,div#sidebar-wrapper .widget ul li,.blog-cat li a:hover,.achmnt-icon1 i,.achmnt-icon2 i,.achmnt-icon3 i,.follow-us i:hover,h6.bnr-sm-hd,a.btn-slid.btn:hover,h6.expernc-sm-hd,section#experiences-wrap button.owl-prev i:hover, section#experiences-wrap button.owl-next i:hover,.inn-sidebar .wp-block-latest-comments__comment-author,.inn-sidebar .wp-block-latest-comments__comment-link,.detail-sidebar .wp-block-latest-comments__comment-author,.detail-sidebar .wp-block-latest-comments__comment-link,.inn-sidebar .widget ul li a,.detail-sidebar .widget ul li a,.inn-sidebar ul li:hover,.detail-sidebar ul li:hover,.inn-sidebar p.wp-block-tag-cloud a:before,.inn-sidebar .tagcloud a:before,.inn-sidebar p.wp-block-tag-cloud a:before,.detail-sidebar p.wp-block-tag-cloud a:before,.detail-sidebar .tagcloud a:before,.detail-sidebar p.wp-block-tag-cloud a:before,.inn-sidebar .tagcloud a,.detail-sidebar .tagcloud a{';
        $online_education_classes_theme_css .= 'color: ' . esc_attr($online_education_classes_whole_color) . ';';
        $online_education_classes_theme_css .= '}';

        $online_education_classes_theme_css .= 'a.btntoTop,nav.woocommerce-MyAccount-navigation ul li,.wp-block-file .wp-block-file__button,.wp-block-button.is-style-outline .wp-block-button__link,.wp-block-pullquote blockquote,.wp-block-quote:not(.is-large):not(.is-style-large),div.footer-widgets-wrapper p.wp-block-tag-cloud a,div.footer-widgets-wrapper .tagcloud a,p.wp-block-tag-cloud a,div.footer-widgets-wrapper .tag-cloud a{';
        $online_education_classes_theme_css .= 'border-color: ' . esc_attr($online_education_classes_whole_color) . ';';
        $online_education_classes_theme_css .= '}';
    }

    if (!empty($online_education_classes_theme_css)) {
        echo '<style type="text/css">' . $online_education_classes_theme_css . '</style>';
    }
}
add_action('wp_head', 'online_education_classes_global_color_custom_css', 10);


