<?php
function gadget_store_social_media_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	/*=========================================
	Social Media
	=========================================*/
	$wp_customize->add_section(
        'gadget_store_social_media_header',
        array(
        	'priority'      => 3,
            'title' 		=> __('Social Media','gadget-store'),
			'panel'  		=> 'gadget_store_frontpage_sections',
		)
    );

   	$wp_customize->add_setting(
    	'gadget_store_social_media_facebook',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_social_media_facebook',
		array(
		    'label'   		=> __('Facebook URL','gadget-store'),
		    'section'		=> 'gadget_store_social_media_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_social_media_twitter',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_social_media_twitter',
		array(
		    'label'   		=> __('Twitter URL','gadget-store'),
		    'section'		=> 'gadget_store_social_media_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)  
	);	

	$wp_customize->add_setting(
    	'gadget_store_social_media_instagram',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_social_media_instagram',
		array(
		    'label'   		=> __('Instagram URL','gadget-store'),
		    'section'		=> 'gadget_store_social_media_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_social_media_linkedin',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_social_media_linkedin',
		array(
		    'label'   		=> __('Linkedin URL','gadget-store'),
		    'section'		=> 'gadget_store_social_media_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)  
	);

	$wp_customize->add_setting(
    	'gadget_store_social_media_youtube',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);	
	$wp_customize->add_control( 
		'gadget_store_social_media_youtube',
		array(
		    'label'   		=> __('Youtube URL','gadget-store'),
		    'section'		=> 'gadget_store_social_media_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)  
	);

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_16',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_16',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_social_media_header',
                'settings'      => 'gadget_store_upgrade_page_settings_16',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 
}
add_action( 'customize_register', 'gadget_store_social_media_header_settings' );