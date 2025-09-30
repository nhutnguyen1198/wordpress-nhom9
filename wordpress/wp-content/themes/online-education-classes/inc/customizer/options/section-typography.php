<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_typography_setting_register' ) ) :
function online_education_classes_customizer_typography_setting_register( $wp_customize ) {

    // Add Typography Panel for Body and Heading
    $wp_customize->add_panel(
        'online_education_classes_typography_settings_panel',
        array(
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Typography Settings', 'online-education-classes' ),
        )
    );

    // Section Body Typography
    $wp_customize->add_section(
        'online_education_classes_body_typography_settings',
        array(
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Body', 'online-education-classes' ),
            'panel'         => 'online_education_classes_typography_settings_panel',
        )
    );

    // Body Font Family Setting
    $wp_customize->add_setting(
        'online_education_classes_body_font_family',
        array(
            'default'           => 'Poppins, sans-serif', // Default font
            'sanitize_callback' => 'online_education_classes_sanitize_font_family', // Custom sanitize function
        )
    );

    $wp_customize->add_control(
    new Online_Education_Classes_Font_Select_Control(
        $wp_customize,
        'online_education_classes_body_font_family',
        array(
            'label'   => esc_html__( 'Body Font Family', 'online-education-classes' ),
            'section' => 'online_education_classes_body_typography_settings',
            'choices' => online_education_classes_get_google_fonts(),
            'settings' => 'online_education_classes_body_font_family',
        )));


    // Section Heading Typography
    $wp_customize->add_section(
        'online_education_classes_heading_typography_settings',
        array(
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Heading', 'online-education-classes' ),
            'panel'         => 'online_education_classes_typography_settings_panel',
        )
    );

    // Heading Font Family Setting
    $wp_customize->add_setting(
        'online_education_classes_heading_font_family',
        array(
            'default'           => 'Poppins, sans-serif', // Default font
            'sanitize_callback' => 'online_education_classes_sanitize_font_family', // Custom sanitize function
        )
    );

    $wp_customize->add_control(
    new Online_Education_Classes_Font_Select_Control(
        $wp_customize,
        'online_education_classes_heading_font_family',
        array(
            'label'   => esc_html__( 'Heading Font Family', 'online-education-classes' ),
            'section' => 'online_education_classes_heading_typography_settings',
            'choices' => online_education_classes_get_google_fonts(),
            'settings' => 'online_education_classes_heading_font_family',
        )));

}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_typography_setting_register' );

// Function to fetch Google Fonts
function online_education_classes_get_google_fonts() {
    // Add Google Fonts to be available for selection
    return array(
        'Poppins, sans-serif'   => 'Poppins',
        'Arial, sans-serif'   => 'Arial',
        'Georgia, serif'      => 'Georgia',
        'Verdana, sans-serif' => 'Verdana',
        'Times New Roman, serif' => 'Times New Roman',
        'Roboto, sans-serif'  => 'Roboto',
        'Open Sans, sans-serif' => 'Open Sans',
        'Lora, serif'         => 'Lora',
        'Merriweather, serif' => 'Merriweather',
        'Montserrat, sans-serif' => 'Montserrat',
        'Outfit, serif' => 'Outfit', 
        // Add more Google fonts as needed
    );
}

// Sanitize Google Fonts input
function online_education_classes_sanitize_font_family( $value ) {
    $allowed_fonts = array(
        'Poppins, sans-serif','Arial, sans-serif', 'Georgia, serif', 'Verdana, sans-serif', 
        'Times New Roman, serif', 'Roboto, sans-serif', 'Open Sans, sans-serif',
        'Lora, serif', 'Merriweather, serif', 'Montserrat, sans-serif','Outfit, serif',
        // Add more allowed fonts to this array
    );

    if ( in_array( $value, $allowed_fonts ) ) {
        return $value;
    } else {
        return 'Poppins, sans-serif'; // Default fallback font
    }
}

function online_education_classes_sanitize_title( $value ) {
    return sanitize_text_field( $value );
}
