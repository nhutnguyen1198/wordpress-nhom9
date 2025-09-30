<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_general_setting_register' ) ) :
function online_education_classes_customizer_general_setting_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'online_education_classes_general_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'General Settings', 'online-education-classes' )
        )
    );

 	// Add general Panel for preloader and scrolltop
    $wp_customize->add_panel(
        'online_education_classes_general_settings_panel',
        array(
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'General Settings', 'online-education-classes' ),
        )
    );

    // Section preloader
    $wp_customize->add_section(
        'online_education_classes_prelodr_settings',
        array(
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Preloader', 'online-education-classes' ),
            'panel'         => 'online_education_classes_general_settings_panel',
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'online_education_classes_preloader_settings', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_preloader_settings', 
		array(
		    'label'       => esc_html__( 'Preloader Settings', 'online-education-classes' ),
		    'section'     => 'online_education_classes_prelodr_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_preloader_settings',
		) 
	));

	// Add an option to enable the preloader
	$wp_customize->add_setting( 
		'online_education_classes_enable_preloader', 
		array(
		    'default'           => false,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_preloader', 
		array(
		    'label'       => esc_html__( 'Show Preloader', 'online-education-classes' ),
		    'section'     => 'online_education_classes_prelodr_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_preloader',
		) 
	));


    // Section Body Typography
    $wp_customize->add_section(
        'online_education_classes_scrol_settings',
        array(
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Scroll Top', 'online-education-classes' ),
            'panel'         => 'online_education_classes_general_settings_panel',
        )
    );


	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_scroll_top_settings', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_scroll_top_settings', 
		array(
		    'label'       => esc_html__( 'Scroll Top Settings', 'online-education-classes' ),
		    'section'     => 'online_education_classes_scrol_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_scroll_top_settings',
		) 
	));

	// Add an option to enable the scrolltop
	$wp_customize->add_setting( 
		'online_education_classes_enable_scrolltop', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_scrolltop', 
		array(
		    'label'       => esc_html__( 'Show Scroll Top', 'online-education-classes' ),
		    'section'     => 'online_education_classes_scrol_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_scrolltop',
		) 
	));

	 $wp_customize->add_section(
        'online_education_classes_button_settings',
        array(
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Buttons', 'online-education-classes' ),
            'panel'         => 'online_education_classes_general_settings_panel',
        )
    );

	 // Border Radius Setting
	$wp_customize->add_setting(
	    'online_education_classes_button_border_radius',
	    array(
	        'default'           => '0px',
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'refresh',
	    )
	);

	$wp_customize->add_control(
	    'online_education_classes_button_border_radius',
	    array(
	        'type'     => 'text',
	        'label'    => esc_html__( 'Button Border Radius (e.g. 4px, 50%)', 'online-education-classes' ),
	        'section'  => 'online_education_classes_button_settings',
	    )
	);

	// Button Padding Setting
	$wp_customize->add_setting(
	    'online_education_classes_button_padding',
	    array(
	        'default'           => '10px 35px',
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'refresh',
	    )
	);

	$wp_customize->add_control(
	    'online_education_classes_button_padding',
	    array(
	        'type'     => 'text',
	        'label'    => esc_html__( 'Button Padding (e.g. 10px 20px)', 'online-education-classes' ),
	        'section'  => 'online_education_classes_button_settings',
	    )
	);


}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_general_setting_register' );