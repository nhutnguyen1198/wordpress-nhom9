<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_home_banner_register' ) ) :
function online_education_classes_customizer_home_banner_register( $wp_customize ) {
    
    $wp_customize->add_section(
        'online_education_classes_home_banner_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Banner Settings', 'online-education-classes' )
        )
    );

    // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_banner_settings_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_banner_settings_title', 
        array(
            'label'       => esc_html__( 'Banner Settings', 'online-education-classes' ),
            'section'     => 'online_education_classes_home_banner_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_banner_settings_title',
        ) 
    ));

     $wp_customize->add_setting('online_education_classes_slider_increase',array(
        'default' => '',
        'sanitize_callback' => 'online_education_classes_sanitize_number',
    ));
    $wp_customize->add_control('online_education_classes_slider_increase',array(
        'label' => __('Number of slides to show','online-education-classes'),
        'section' => 'online_education_classes_home_banner_settings',
        'type'    => 'number'
    ));
      $online_education_classes_banner_count =  get_theme_mod('online_education_classes_slider_increase');

        for($i=1; $i<=$online_education_classes_banner_count; $i++ ) {  

    // Image
    $wp_customize->add_setting(
        'online_education_classes_banner_image'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'online_education_classes_sanitize_image',

        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'online_education_classes_banner_image'.$i, 
            array(
                'label'           => sprintf( esc_html__( 'Banner Image', 'online-education-classes' ).$i, ),
                'settings'  => 'online_education_classes_banner_image'.$i,
                'section'   => 'online_education_classes_home_banner_settings'
            ) 
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_banner_small_heading'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_banner_small_heading'.$i,
        array(
            'label'           => sprintf( esc_html__( 'Banner Small Heading', 'online-education-classes' ).$i, ),
            'section'         => 'online_education_classes_home_banner_settings',
            'settings'        => 'online_education_classes_banner_small_heading'.$i ,
            'type'            => 'text',
        )
    );

    // Banner Heading
    $wp_customize->add_setting(
        'online_education_classes_banner_heading'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_banner_heading'.$i,
        array(
            'label'           => sprintf( esc_html__( 'Banner Heading', 'online-education-classes' ).$i, ),
            'section'         => 'online_education_classes_home_banner_settings',
            'settings'        => 'online_education_classes_banner_heading'.$i ,
            'type'            => 'text',
        )
    );
    // banner Button
    $wp_customize->add_setting(
        'online_education_classes_banner_button_link'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_banner_button_link'.$i,
        array(
            'label'           => sprintf( esc_html__( 'Banner Button Link', 'online-education-classes' ).$i, ),
            'section'         => 'online_education_classes_home_banner_settings',
            'settings'        => 'online_education_classes_banner_button_link'.$i ,
            'type'            => 'url',
        )
    );

    }
    // Slider Content Alignment Setting
    $wp_customize->add_setting(
        'online_education_classes_slider_content_alignment',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'online_education_classes_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_slider_content_alignment',
        array(
            'label'    => esc_html__( 'Slider Content Alignment', 'online-education-classes' ),
            'section'  => 'online_education_classes_home_banner_settings',
            'settings' => 'online_education_classes_slider_content_alignment',
            'type'     => 'select',
            'choices'  => array(
                'left'   => esc_html__( 'Left', 'online-education-classes' ),
                'center' => esc_html__( 'Center', 'online-education-classes' ),
                'right'  => esc_html__( 'Right', 'online-education-classes' ),
            ),
        )
    );
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_home_banner_register' );