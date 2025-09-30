<?php
/**
 * Online Education Classes Theme Customizer
 *
 * @package Online Education Classes
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if ( ! function_exists( 'online_education_classes_customize_register' ) ) :
function online_education_classes_customize_register( $wp_customize ) {

    // Add custom controls.
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/info/class-title-info-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/radio-images/class-radio-image-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/text-radio/class-text-radio-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/slider/class-slider-control.php' );
    require get_parent_theme_file_path( 'inc/customizer/custom-controls/typography/typo-custom-control.php' );

    // Register the custom control type.
    $wp_customize->register_control_type( 'Online_Education_Classes_Toggle_Control' );

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'online-education-classes' );

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'online_education_classes_site_title_callback',
            'fallback_refresh'    => false,
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'online_education_classes_site_description_callback',
            'fallback_refresh'    => false, 
        ) );
    }

   // Display Site Title
        $wp_customize->add_setting( 
            'online_education_classes_display_site_title', 
            array(
                'default'           => true,
                'type'              => 'theme_mod',
                'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
            ) 
        );
        $wp_customize->add_control( 
            new Online_Education_Classes_Toggle_Control( 
                $wp_customize, 
                'online_education_classes_display_site_title', 
                array(
                    'label'    => esc_html__( 'Display Site Title', 'online-education-classes' ),
                    'section'  => 'title_tagline',
                    'settings' => 'online_education_classes_display_site_title',
                ) 
            )
        );

        // Display Site Tagline
        $wp_customize->add_setting( 
            'online_education_classes_display_site_tagline', 
            array(
                'default'           => false,
                'type'              => 'theme_mod',
                'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
            ) 
        );
        $wp_customize->add_control( 
            new Online_Education_Classes_Toggle_Control( 
                $wp_customize, 
                'online_education_classes_display_site_tagline', 
                array(
                    'label'    => esc_html__( 'Display Tagline', 'online-education-classes' ),
                    'section'  => 'title_tagline',
                    'settings' => 'online_education_classes_display_site_tagline',
                ) 
            )
        );

    // Add setting
    $wp_customize->add_setting( 'online_education_classes_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage', // Optional for live preview
    ) );

    // Add control (range slider)
    $wp_customize->add_control( 'online_education_classes_logo_width', array(
        'label'       => __( 'Logo Resizer (px)', 'online-education-classes' ),
        'section'     => 'title_tagline',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 400,
            'step' => 1,
        ),
    ) );
    
}
endif;
add_action( 'customize_register', 'online_education_classes_customize_register' );

//General settings
get_template_part( 'inc/customizer/options/section-general' );

//Global Color settings
get_template_part( 'inc/customizer/options/section-global-color' );

//typography settings
get_template_part( 'inc/customizer/options/section-typography' );

//header settings
get_template_part( 'inc/customizer/options/section-header' );

//banner settings
get_template_part( 'inc/customizer/options/section-banner' );

//product settings
get_template_part( 'inc/customizer/options/section-experiences' );

//blog settings
get_template_part( 'inc/customizer/options/section-blog' );

//page settings
get_template_part( 'inc/customizer/options/section-page' );

//footer settings
get_template_part( 'inc/customizer/options/section-footer' );

//customizer helper
get_template_part( 'inc/customizer/customizer-helpers' );

//data sanitization
get_template_part( 'inc/customizer/data-sanitization' );

/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'online_education_classes_enqueue_customizer_stylesheets' ) ) :
function online_education_classes_enqueue_customizer_stylesheets() {
    wp_register_style( 'online-education-classes-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/css/customizer.css', array(), '1.0.9', 'all' );
    wp_enqueue_style( 'online-education-classes-customizer-css' );
}
endif;
add_action( 'customize_controls_print_styles', 'online_education_classes_enqueue_customizer_stylesheets' );