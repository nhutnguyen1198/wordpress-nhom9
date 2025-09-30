<?php
function gadget_store_sidebar_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'gadget_store_sidebar', array(
			'priority' => 31,
			'title' => esc_html__( 'Sidebar Options', 'gadget-store' ),
		)
	);

	/*=========================================
	Sidebar Option  Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_sidebar_settings', array(
			'title' => esc_html__( 'Sidebar Options', 'gadget-store' ),
			'priority' => 1,
			'panel' => 'gadget_store_general',
		)
	);
	

	// Archive Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_archive_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_archive_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Archive Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_archive_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Index Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_index_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_index_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Index Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_index_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Pages Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_paged_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_paged_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Pages Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_paged_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Search Result Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_search_result_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_search_result_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Search Result Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_search_result_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Single Post Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Single Post Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_single_post_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	// Sidebar Page Sidebar Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_page_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_page_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Page Width Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_sidebar_settings',
			'settings'    => 'gadget_store_single_page_sidebar_setting',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 'gadget_store_sidebar_position', array(
        'default'   => 'right',
        'sanitize_callback' => 'gadget_store_sanitize_sidebar_position',
    ));

    $wp_customize->add_control( 'gadget_store_sidebar_position', array(
        'label'    => __( 'Sidebar Position', 'gadget-store' ),
        'section'  => 'gadget_store_sidebar_settings',
        'settings' => 'gadget_store_sidebar_position',
        'type'     => 'radio',
        'choices'  => array(
            'right' => __( 'Right Sidebar', 'gadget-store' ),
            'left'  => __( 'Left Sidebar', 'gadget-store' ),
        ),
    ));

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_15',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_15',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_sidebar_settings',
                'settings'      => 'gadget_store_upgrade_page_settings_15',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 
}

add_action( 'customize_register', 'gadget_store_sidebar_setting' );