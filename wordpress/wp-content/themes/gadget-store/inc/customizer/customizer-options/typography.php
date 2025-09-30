<?php
function gadget_store_typography_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'gadget_store_typography', array(
			'priority' => 31,
			'title' => esc_html__( 'Typography Options', 'gadget-store' ),
		)
	);

	/*=========================================
	Archive Post  Section
	=========================================*/
	$wp_customize->add_section(
		'gadget_store_typography_settings', array(
			'title' => esc_html__( 'Heading/Content Typography Options', 'gadget-store' ),
			'priority' => 1,
			'panel' => 'gadget_store_typography',
		)
	);
	$gadget_store_font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'gadget_store_headings_text', array(
		'sanitize_callback' => 'gadget_store_sanitize_fonts',
	));

	$wp_customize->add_control( 'gadget_store_headings_text', array(
		'type' => 'select',
		'description' => __('Select your appropriate font for the headings.', 'gadget-store'),
		'section' => 'gadget_store_typography_settings',
		'choices' => $gadget_store_font_choices

	));

	$wp_customize->add_setting( 'gadget_store_body_text', array(
		'sanitize_callback' => 'gadget_store_sanitize_fonts'
	));

	$wp_customize->add_control( 'gadget_store_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your appropriate font for the body.', 'gadget-store' ),
		'section' => 'gadget_store_typography_settings',
		'choices' => $gadget_store_font_choices
	) );
	
	$wp_customize->add_section(
	'gadget_store_dynamic_color_settings', array(
		'title' => esc_html__( 'Dynamic Color Options', 'gadget-store' ),
		'priority' => 1,
		'panel' => 'gadget_store_typography',
		)
	);

	$wp_customize->add_setting('gadget_store_dynamic_color_one', array(
        'default'           => '#27c0fe',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gadget_store_dynamic_color_one', array(
        'label'    => __('First Dynamic Color', 'gadget-store'),
        'section'  => 'gadget_store_dynamic_color_settings',
    )));

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_20_color',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_20_color',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_dynamic_color_settings',
                'settings'      => 'gadget_store_upgrade_page_settings_20_color',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 

	$wp_customize->add_setting( 'gadget_store_upgrade_page_settings_20',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Gadget_Store_Control_Upgrade(
        $wp_customize, 'gadget_store_upgrade_page_settings_20',
            array(
                'priority'      => 200,
                'section'       => 'gadget_store_typography_settings',
                'settings'      => 'gadget_store_upgrade_page_settings_20',
                'label'         => __( 'Gadget Store Pro comes with additional features.', 'gadget-store' ),
                'choices'       => array( __( '15+ Ready-Made Sections', 'gadget-store' ), __( 'One-Click Demo Import', 'gadget-store' ), __( 'WooCommerce Integrated', 'gadget-store' ), __( 'Drag & Drop Section Reordering', 'gadget-store' ),__( 'Advanced Typography Control', 'gadget-store' ),__( 'Intuitive Customization Options', 'gadget-store' ),__( '24/7 Support', 'gadget-store' ), )
            )
        )
    ); 
}

add_action( 'customize_register', 'gadget_store_typography_setting' );