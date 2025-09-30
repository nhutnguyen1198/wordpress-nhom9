<?php
function gadget_store_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

    // Site Title Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_site_title_setting' , 
			array(
			'default' => '0',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_site_title_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Site Title', 'gadget-store' ),
			'section'     => 'title_tagline',
			'settings'    => 'gadget_store_site_title_setting',
			'type'        => 'checkbox'
		) 
	);

	// Tagline Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_tagline_setting' , 
			array(
			'default' => '',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_tagline_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Tagline', 'gadget-store' ),
			'section'     => 'title_tagline',
			'settings'    => 'gadget_store_tagline_setting',
			'type'        => 'checkbox'
		) 
	);

	// Add the setting for logo width
	$wp_customize->add_setting(
	    'gadget_store_logo_width',
	    array(
	        'sanitize_callback' => 'gadget_store_sanitize_logo_width',
	        'priority'          => 2,
	    )
	);

	// Add control for logo width
	$wp_customize->add_control( 
	    'gadget_store_logo_width',
	    array(
	        'label'     => __('Logo Width', 'gadget-store'),
	        'section'   => 'title_tagline',
	        'type'      => 'number',
	        'input_attrs' => array(
	            'min'   => 1,
	            'max'   => 150,
	            'step'  => 1,
	        ),
	        'transport' => $selective_refresh,
	    )  
	);

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_11',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_11',
            array(
                'priority'      => 200,
                'section'       => 'title_tagline',
                'settings'      => 'gadget_store_upgrade_page_settings_11',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	/*=========================================
	Gadget Store Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','gadget-store'),
			'panel'  		=> 'gadget_store_frontpage_sections',
		)
    );    

	/*=========================================
	Top header
	=========================================*/
	$wp_customize->add_section(
        'gadget_store_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Header','gadget-store'),
			'panel'  		=> 'gadget_store_frontpage_sections',
		)
    );

    // Header Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_header_setting' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'gadget_store_header_setting', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'gadget-store' ),
			'section'     => 'gadget_store_top_header',
			'settings'    => 'gadget_store_header_setting',
			'type'        => 'checkbox'
		) 
	);

   	$wp_customize->add_setting(
    	'gadget_store_topheader_text',
    	array(
			'default' => 'Welcome to Worldwide Ecommerce Store',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'gadget_store_topheader_text',
		array(
		    'label'   		=> __('Header Text','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

   	$wp_customize->add_setting(
    	'gadget_store_topheader_about_text',
    	array(
			'default' => 'About Us',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'gadget_store_topheader_about_text',
		array(
		    'label'   		=> __('Header About Text','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

   	$wp_customize->add_setting(
    	'gadget_store_topheader_about_link',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'gadget_store_topheader_about_link',
		array(
		    'label'   		=> __('Header About Link','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting(
    	'gadget_store_topheader_order_text',
    	array(
			'default' => 'Order Tracking',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'gadget_store_topheader_order_text',
		array(
		    'label'   		=> __('Header Track Order Text','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

   	$wp_customize->add_setting(
    	'gadget_store_topheader_order_link',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'gadget_store_topheader_order_link',
		array(
		    'label'   		=> __('Header Track Order Link','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting(
    	'gadget_store_notification',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'gadget_store_notification',
		array(
		    'label'   		=> __('Header Notification Link','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_setting(
    	'gadget_store_like_option',
    	array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 
		'gadget_store_like_option',
		array(
		    'label'   		=> __('Header Like Link','gadget-store'),
		    'section'		=> 'gadget_store_top_header',
			'type' 			=> 'url',
			'transport'         => $selective_refresh,
		)
	);

	// Slider Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'gadget_store_cart_language_translator' , 
			array(
			'default' => '0',
			'sanitize_callback' => 'gadget_store_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	$wp_customize->add_control(
	'gadget_store_cart_language_translator', 
		array(
			'label'	      => esc_html__( 'Show / Hide Language Translator', 'gadget-store' ),
			'section'     => 'gadget_store_top_header',
			'settings'    => 'gadget_store_cart_language_translator',
			'type'        => 'checkbox'
		) 
	);

	$wp_customize->add_setting('gadget_store_interactive_globe_symbol',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gadget_store_interactive_globe_symbol',array(
		'label'	=> esc_html__('Add globe with interaction link','gadget-store'),
		'section'=> 'gadget_store_top_header',
		'type'=> 'url'
	));

	 $wp_customize->add_setting( 'gadget_store_upgrade_page_settings_12',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_12',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_top_header',
                'settings'      => 'gadget_store_upgrade_page_settings_12',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	$wp_customize->register_panel_type( 'Gadget_Store_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Gadget_Store_WP_Customize_Section' );

}
add_action( 'customize_register', 'gadget_store_header_settings' );


if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Gadget_Store_WP_Customize_Panel extends WP_Customize_Panel {
	   public $panel;
	   public $type = 'gadget_store_panel';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Gadget_Store_WP_Customize_Section extends WP_Customize_Section {
	   public $section;
	   public $type = 'gadget_store_section';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}