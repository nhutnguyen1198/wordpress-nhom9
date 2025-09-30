<?php
function gadget_store_post_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'gadget_store_post', array(
			'priority' => 31,
			'title' => esc_html__( 'Post Options', 'gadget-store' ),
		)
	);

	/*=========================================
	Archive Post  Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_archive_post_setting', array(
			'title' => esc_html__( 'Archive Post', 'gadget-store' ),
			'priority' => 1,
			'panel' => 'gadget_store_post',
		)
	);

	// Layouts Post
	$wp_customize->add_setting('gadget_store_blog_layout_option_setting',array(
	  'default' => 'Default',
	  'sanitize_callback' => 'gadget_store_sanitize_choices'
	));
	$wp_customize->add_control(new Gadget_Store_Image_Radio_Control($wp_customize, 'gadget_store_blog_layout_option_setting', array(
	  'type' => 'select',
	  'label' => __('Blog Post Layouts','gadget-store'),
	  'section' => 'gadget_store_archive_post_setting',
	  'choices' => array(
		'Default' => esc_url(get_template_directory_uri()).'/assets/images/layout-1.png',
		'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout-2.png',
		'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout-3.png',
	))));
		
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
		'gadget_store_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Timing Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'gadget-store' ),
			'section'     => 'gadget_store_archive_post_setting',
			'settings'    => 'gadget_store_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting('gadget_store_excerpt_limit', array(
        'default'           => 50,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('gadget_store_excerpt_limit', array(
        'label'   => __('Excerpt Word Limit', 'gadget-store'),
        'section' => 'gadget_store_archive_post_setting',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_133',
	array(
		'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Gadget_Store_Control_Upgrade(
		$wp_customize, 'gadget_store_upgrade_page_settings_133',
			array(
				'priority'      => 200,
				'section'       => 'gadget_store_archive_post_setting',
				'settings'      => 'gadget_store_upgrade_page_settings_133',
				'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
			)
		)
	); 

	/*=========================================
	Single Post  Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_single_post', array(
			'title' => esc_html__( 'Single Post', 'gadget-store' ),
			'priority' => 3,
			'panel' => 'gadget_store_post',
		)
	);
	
	// Post Heading Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_heading_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_heading_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Heading', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_heading_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Content Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_content_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_content_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Content', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_content_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Featured Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_featured_image_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_featured_image_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Feature Image', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_featured_image_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_date_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_date_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Date', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_date_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_comments_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_comments_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Comment', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_comments_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_author_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_author_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Author', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_author_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Date Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_timing_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_timing_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Timings', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_timing_settings',
			'type'        => 'checkbox'
		) 
	);

	// Post Tags Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_single_post_tags_settings' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_single_post_tags_settings', 
		array(
			'label'	      => esc_html__( 'Hide / Show Post Tags', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_single_post_tags_settings',
			'type'        => 'checkbox'
		) 
	);
	
	// Related Posts Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_show_hide_related_post' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_show_hide_related_post', 
		array(
			'label'	      => esc_html__( 'Hide / Show Related Posts', 'gadget-store' ),
			'section'     => 'gadget_store_single_post',
			'settings'    => 'gadget_store_show_hide_related_post',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting( 
    	'gadget_store_related_posts_heading',
    	array(
			'default' => 'Related Posts',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'gadget_store_related_posts_heading',
		array(
		    'label'   		=> __('Related Post Heading','gadget-store'),
		    'section'		=> 'gadget_store_single_post',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting('gadget_store_related_post_counts', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('gadget_store_related_post_counts', array(
        'label'   => __('Number Of Related Posts To Show', 'gadget-store'),
        'section' => 'gadget_store_single_post',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_58',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
	);
	$wp_customize->add_control( new Gadget_Store_Control_Upgrade(
		$wp_customize, 'gadget_store_upgrade_page_settings_58',
			array(
				'priority'      => 200,
				'section'       => 'gadget_store_single_post',
				'settings'      => 'gadget_store_upgrade_page_settings_58',
				'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
				'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
			)
		)
	); 
}

add_action( 'customize_register', 'gadget_store_post_setting' );