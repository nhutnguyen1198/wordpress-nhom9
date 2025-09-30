<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_footer_register' ) ) :
function online_education_classes_customizer_footer_register( $wp_customize ) {
 	
 	$wp_customize->add_section(
        'online_education_classes_footer_settings',
        array (
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Footer Settings', 'online-education-classes' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_footer_settings_title', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_footer_settings_title', 
		array(
		    'label'       => esc_html__( 'Footer Settings', 'online-education-classes' ),
		    'section'     => 'online_education_classes_footer_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_footer_settings_title',
		) 
	));

	// Copyright text
    $wp_customize->add_setting(
        'online_education_classes_footer_copyright_text',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'online_education_classes_sanitize_textarea_field'
        )
    );

    $wp_customize->add_control(
        'online_education_classes_footer_copyright_text',
        array(
            'settings'      => 'online_education_classes_footer_copyright_text',
            'section'       => 'online_education_classes_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer Copyright Text', 'online-education-classes' )
        )
    );
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_footer_register' );