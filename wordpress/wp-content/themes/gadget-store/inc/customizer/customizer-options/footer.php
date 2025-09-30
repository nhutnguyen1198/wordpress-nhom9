<?php

function gadget_store_footer( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'gadget_store_footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'gadget-store'),
		) 
	);

	// Footer Widgets // 
	$wp_customize->add_section(
        'gadget_store_footer_top',
        array(
            'title' 		=> __('Footer Widgets','gadget-store'),
			'panel'  		=> 'gadget_store_footer_section',
			'priority'      => 3,
		)
    );

    // Footer Widgets Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'footer_widgets_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'footer_widgets_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Widgets', 'gadget-store' ),
			'section'     => 'gadget_store_footer_top',
			'settings'    => 'footer_widgets_setting',
			'type'        => 'checkbox'
		) 
	);

	// Footer Background Color Setting
	$wp_customize->add_setting('gadget_store_footer_bg_color',array(
		'default' => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'gadget_store_footer_bg_color',array(
		'label' => esc_html__('Footer Background Color', 'gadget-store'),
		'section' => 'gadget_store_footer_top', // Adjust section if needed
		'settings' => 'gadget_store_footer_bg_color',
	)));

	// Footer Background Image Setting
	$wp_customize->add_setting('gadget_store_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'gadget_store_footer_bg_image',array(
	'label' => __('Footer Background Image','gadget-store'),
	'section' => 'gadget_store_footer_top'
	)));

	// Footer Background Image Opacity
	$wp_customize->add_setting('gadget_store_footer_bg_image_opacity', array(
		'default'           => 50,
		'sanitize_callback' => 'absint',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control('gadget_store_footer_bg_image_opacity', array(
		'label'    => __('Footer Background Image Opacity (%)', 'gadget-store'),
		'section'  => 'gadget_store_footer_top',
		'type'     => 'range',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_1',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_1',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_footer_top',
                'settings'      => 'gadget_store_upgrade_page_settings_1',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	
	// Footer Bottom // 
	$wp_customize->add_section(
        'gadget_store_footer_bottom',
        array(
            'title' 		=> __('Footer Bottom','gadget-store'),
			'panel'  		=> 'gadget_store_footer_section',
			'priority'      => 3,
		)
    );

	// Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_footer_copyright_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_footer_copyright_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Footer Copyright', 'gadget-store' ),
			'section'     => 'gadget_store_footer_bottom',
			'settings'    => 'gadget_store_footer_copyright_setting',
			'type'        => 'checkbox'
		) 
	);
	
	// Footer Copyright 
	$wp_customize->add_setting(
    	'gadget_store_footer_copyright',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);

	$wp_customize->add_control( 
		'gadget_store_footer_copyright',
		array(
		    'label'   		=> __('Edit Copyright Text','gadget-store'),
		    'section'		=> 'gadget_store_footer_bottom',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting( 'gadget_store_copyright_alignment', array(
        'default'   => 'center',
        'sanitize_callback' => 'gadget_store_sanitize_copyright_position',
    ));

    $wp_customize->add_control( 'gadget_store_copyright_alignment', array(
        'label'    => __( 'Copyright Position', 'gadget-store' ),
        'section'  => 'gadget_store_footer_bottom',
        'settings' => 'gadget_store_copyright_alignment',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Align', 'gadget-store' ),
            'left'  => __( 'Left Align', 'gadget-store' ),
            'center'  => __( 'Center Align', 'gadget-store' ),
        ),
    ));

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_2',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_2',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_footer_bottom',
                'settings'      => 'gadget_store_upgrade_page_settings_2',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 
}
add_action( 'customize_register', 'gadget_store_footer' );

// Footer selective refresh
function gadget_store_footer_partials( $wp_customize ){
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.copy-right .copyright-text',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'gadget_store_footer_copyright_render_callback',
	) );
}
add_action( 'customize_register', 'gadget_store_footer_partials' );

// copyright_content
function gadget_store_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}