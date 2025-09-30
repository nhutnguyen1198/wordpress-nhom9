<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_global_color_setting_register' ) ) :
function online_education_classes_customizer_global_color_setting_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'online_education_classes_global_color_settings',
        array (
            'priority'      => 40,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Global Color Settings', 'online-education-classes' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'online_education_classes_theme_color_settings', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_theme_color_settings', 
		array(
		    'label'       => esc_html__( 'Global Color Settings', 'online-education-classes' ),
		    'section'     => 'online_education_classes_global_color_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_theme_color_settings',
		) 
	));

    $wp_customize->add_setting('online_education_classes_global_color1',
        array(
            'type' => 'theme_mod',
            'default'           => '#179BD7',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'online_education_classes_global_color1',
            array(
                'label'      => esc_html__( 'Global Color1', 'online-education-classes' ),
                'section'    => 'online_education_classes_global_color_settings',
                'settings'   => 'online_education_classes_global_color1',
            )
        )
    );

}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_global_color_setting_register' );