<?php
function gadget_store_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'gadget_store_general', array(
			'priority' => 2,
			'title' => esc_html__( 'General Options', 'gadget-store' ),
		)
	);

	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_breadcrumb_setting', array(
			'title' => esc_html__( 'Breadcrumb Options', 'gadget-store' ),
			'priority' => 1,
			'panel' => 'gadget_store_general',
		)
	);
	
	// Settings 
	$wp_customize->add_setting(
		'gadget_store_breadcrumb_settings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'gadget_store_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'gadget_store_breadcrumb_settings',
		array(
			'type' => 'hidden',
			'label' => __('Settings','gadget-store'),
			'section' => 'gadget_store_breadcrumb_setting',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_hs_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_hs_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'gadget-store' ),
			'section'     => 'gadget_store_breadcrumb_setting',
			'settings'    => 'gadget_store_hs_breadcrumb',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting(
    	'gadget_store_breadcrumb_seprator',
    	array(
			'default' => '/',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'gadget_store_breadcrumb_seprator',
		array(
		    'label'   		=> __('Breadcrumb separator','gadget-store'),
		    'section'		=> 'gadget_store_breadcrumb_setting',
			'type' 			=> 'text',
		)  
	);

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_5',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_5',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_breadcrumb_setting',
                'settings'      => 'gadget_store_upgrade_page_settings_5',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	/*=========================================
	Preloader Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_preloader_section_setting', array(
			'title' => esc_html__( 'Preloader Options', 'gadget-store' ),
			'priority' => 3,
			'panel' => 'gadget_store_general',
		)
	);

	// Preloader Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_preloader_setting' , 
			array(
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_preloader_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'gadget-store' ),
			'section'     => 'gadget_store_preloader_section_setting',
			'settings'    => 'gadget_store_preloader_setting',
			'type'        => 'checkbox'
		) 
	);

	
	$wp_customize->add_setting(
    	'gadget_store_preloader_text',
    	array(
			'default' => 'Loading',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'gadget_store_preloader_text',
		array(
		    'label'   		=> __('Preloader Text','gadget-store'),
		    'section'		=> 'gadget_store_preloader_section_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	// Preloader Background Color Setting
	$wp_customize->add_setting(
		'gadget_store_preloader_bg_color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gadget_store_preloader_bg_color',
			array(
				'label' => esc_html__('Preloader Background Color', 'gadget-store'),
				'section' => 'gadget_store_preloader_section_setting', // Adjust section if needed
				'settings' => 'gadget_store_preloader_bg_color',
			)
		)
	);

	// Preloader Color Setting
	$wp_customize->add_setting(
		'gadget_store_preloader_color',
		array(
			'default' => '#27c0fe',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gadget_store_preloader_color',
			array(
				'label' => esc_html__('Preloader Color', 'gadget-store'),
				'section' => 'gadget_store_preloader_section_setting', // Adjust section if needed
				'settings' => 'gadget_store_preloader_color',
			)
		)
	);

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_6',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Gadget_Store_Control_Upgrade(
		$wp_customize, 'gadget_store_upgrade_page_settings_6',
			array(
				'priority'      => 200,
				'section'       => 'gadget_store_preloader_section_setting',
				'settings'      => 'gadget_store_upgrade_page_settings_6',
				'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
			)
		)
	); 


	/*=========================================
	Scroll To Top Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_scroll_to_top_section_setting', array(
			'title' => esc_html__( 'Scroll To Top Options', 'gadget-store' ),
			'priority' => 3,
			'panel' => 'gadget_store_footer_section',
		)
	);

	// Scroll To Top Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_scroll_top_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_scroll_top_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroll To Top', 'gadget-store' ),
			'section'     => 'gadget_store_scroll_to_top_section_setting',
			'settings'    => 'gadget_store_scroll_top_setting',
			'type'        => 'checkbox'
		) 
	);

	// Scroll To Top Color Setting
	$wp_customize->add_setting(
		'gadget_store_scroll_top_color',
		array(
			'default'           => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gadget_store_scroll_top_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Color', 'gadget-store' ),
				'section'  => 'gadget_store_scroll_to_top_section_setting',
				'settings' => 'gadget_store_scroll_top_color',
			)
		)
	);

	// Scroll To Top Background Color Setting
	$wp_customize->add_setting(
		'gadget_store_scroll_top_bg_color',
		array(
			'default'           => '#27c0fe',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gadget_store_scroll_top_bg_color',
			array(
				'label'    => esc_html__( 'Scroll To Top Background Color', 'gadget-store' ),
				'section'  => 'gadget_store_scroll_to_top_section_setting',
				'settings' => 'gadget_store_scroll_top_bg_color',
			)
		)
	);

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_7',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_7',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_scroll_to_top_section_setting',
                'settings'      => 'gadget_store_upgrade_page_settings_7',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 


	/*=========================================
	Woocommerce Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_woocommerce_section_setting', array(
			'title' => esc_html__( 'Woocommerce Settings', 'gadget-store' ),
			'priority' => 3,
			'panel' => 'woocommerce',
		)
	);

	$wp_customize->add_setting(
    	'gadget_store_custom_shop_per_columns',
    	array(
			'default' => '3',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_custom_shop_per_columns',
		array(
		    'label'   		=> __('Product Per Columns','gadget-store'),
		    'section'		=> 'gadget_store_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_custom_shop_product_per_page',
    	array(
			'default' => '9',
			'sanitize_callback' => 'absint',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_custom_shop_product_per_page',
		array(
		    'label'   		=> __('Product Per Page','gadget-store'),
		    'section'		=> 'gadget_store_woocommerce_section_setting',
			'type' 			=> 'number',
			'transport'         => $selective_refresh,
		)  
	);

	// Woocommerce Sidebar Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_wocommerce_sidebar_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_wocommerce_sidebar_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Woocommerce Sidebar', 'gadget-store' ),
			'section'     => 'gadget_store_woocommerce_section_setting',
			'settings'    => 'gadget_store_wocommerce_sidebar_setting',
			'type'        => 'checkbox'
		)
	);

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_22',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Gadget_Store_Control_Upgrade(
		$wp_customize, 'gadget_store_upgrade_page_settings_22',
			array(
				'priority'      => 200,
				'section'       => 'gadget_store_woocommerce_section_setting',
				'settings'      => 'gadget_store_upgrade_page_settings_22',
				'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
			)
		)
	); 

	/*=========================================
	Sticky Header Section
	=========================================*/
	$wp_customize->add_section(
		'sticky_header_section_setting', array(
			'title' => esc_html__( 'Sticky Header Options', 'gadget-store' ),
			'priority' => 3,
			'panel' => 'gadget_store_general',
		)
	);

	// Sticky Header Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_sticky_header' , 
			array(
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_sticky_header', 
		array(
			'label'	      => esc_html__( 'Hide / Show Sticky Header', 'gadget-store' ),
			'section'     => 'sticky_header_section_setting',
			'settings'    => 'gadget_store_sticky_header',
			'type'        => 'checkbox'
		) 
	);

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_9',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_9',
            array(
                'priority'      => 200,
                'section'       => 'sticky_header_section_setting',
                'settings'      => 'gadget_store_upgrade_page_settings_9',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	/*=========================================
	404 Page Options
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_404_section', array(
			'title' => esc_html__( '404 Page Options', 'gadget-store' ),
			'priority' => 1,
			'panel' => 'gadget_store_general',
		)
	);

	$wp_customize->add_setting(
    	'gadget_store_404_title',
    	array(
			'default' => '404',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_404_title',
		array(
		    'label'   		=> __('404 Heading','gadget-store'),
		    'section'		=> 'gadget_store_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_404_Text',
    	array(
			'default' => 'Page Not Found',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_404_Text',
		array(
		    'label'   		=> __('404 Title','gadget-store'),
		    'section'		=> 'gadget_store_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_404_content',
    	array(
			'default' => 'The page you were looking for could not be found.',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_404_content',
		array(
		    'label'   		=> __('404 Content','gadget-store'),
		    'section'		=> 'gadget_store_404_section',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_10',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_10',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_404_section',
                'settings'      => 'gadget_store_upgrade_page_settings_10',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

}

add_action( 'customize_register', 'gadget_store_general_setting' );