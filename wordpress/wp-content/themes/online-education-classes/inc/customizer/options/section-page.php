<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_page_register' ) ) :
function online_education_classes_customizer_page_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'online_education_classes_page_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Page Settings', 'online-education-classes' )
        )
    );

    // Info label
     $wp_customize->add_setting( 
        'online_education_classes_label_page_title_hide_settings', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_page_title_hide_settings', 
        array(
            'label'       => esc_html__( 'Hide Page Title', 'online-education-classes' ),
            'section'     => 'online_education_classes_page_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_page_title_hide_settings',
        ) 
    ));  

    // Hide page title section
    $wp_customize->add_setting(
        'online_education_classes_enable_page_title',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'online_education_classes_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_page_title', 
        array(
            'settings'      => 'online_education_classes_enable_page_title',
            'section'       => 'online_education_classes_page_settings',
            'type'          => 'online-education-classes-toggle',
            'label'         => esc_html__( 'Show Page Title Section:', 'online-education-classes' ),
            'description'   => '',           
        )
    ));

    // Info label
    $wp_customize->add_setting( 
        'online_education_classes_label_page_title_bg_settings', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_page_title_bg_settings', 
        array(
            'label'       => esc_html__( 'Page Title Background', 'online-education-classes' ),
            'section'     => 'online_education_classes_page_settings',
            'type'        => 'title',
            'settings'    => 'online_education_classes_label_page_title_bg_settings',
            'active_callback' => 'online_education_classes_page_title_enable',
        ) 
    ));

    // Background selection
    $wp_customize->add_setting(
        'online_education_classes_page_bg_radio',
        array(
            'type' => 'theme_mod',
            'default'           => 'color',
            'sanitize_callback' => 'online_education_classes_sanitize_select'
        )
    );

    $wp_customize->add_control(
    	new Online_Education_Classes_Text_Radio_Control( $wp_customize, 'online_education_classes_page_bg_radio',
        array(
            'settings'      => 'online_education_classes_page_bg_radio',
            'section'       => 'online_education_classes_page_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Choose Page Title Background Color or Background Image:', 'online-education-classes' ),
            'description'   => esc_html__('This setting will change the background of the page title area.', 'online-education-classes'),
            'choices' => array(
                            'color' => esc_html__('Background Color','online-education-classes'),
                            'image' => esc_html__('Background Image','online-education-classes'),
                            ),
            'active_callback' => 'online_education_classes_page_title_enable',
        )
    ));

    // Background color
    $wp_customize->add_setting(
        'online_education_classes_page_bg_color',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'online_education_classes_page_bg_color',
            array(
                'label'      => esc_html__( 'Select Background Color', 'online-education-classes' ),
                'description'   => esc_html__('This setting will add background color to the page title area if Background Color was selected above.', 'online-education-classes'),
                'section'    => 'online_education_classes_page_settings',
                'settings'   => 'online_education_classes_page_bg_color',
                'active_callback' => 'online_education_classes_page_title_color_enable',
            )
        )
    );

    // Background image
    $wp_customize->add_setting(
        'online_education_classes_page_bg_image',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'online_education_classes_page_bg_image',
            array(
                'label'       => esc_html__( 'Upload Background Image', 'online-education-classes' ),
                'description' => esc_html__('This setting will add a background image to the page title area if Background Image was selected above.', 'online-education-classes'),
                'section'     => 'online_education_classes_page_settings',
                'settings'    => 'online_education_classes_page_bg_image',
                'active_callback' => 'online_education_classes_page_title_image_enable',
            )
        )
    );
    
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_page_register' );