<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_learning_experiences_register' ) ) :
function online_education_classes_customizer_learning_experiences_register( $wp_customize ) {

    $wp_customize->add_section(
        'online_education_classes_learning_experiences_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Learning Experiences Settings', 'online-education-classes' )
        )
    );

    // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_experience_settings_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_experience_settings_title', 
        array(
            'label'       => esc_html__( 'Learning Experience Settings', 'online-education-classes' ),
            'section'     => 'online_education_classes_learning_experiences_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_experience_settings_title',
        ) 
    ));

    $wp_customize->add_setting(
        'online_education_classes_learning_experiences_small_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_learning_experiences_small_heading',
        array(
            'label'           => sprintf( esc_html__( 'Small Heading', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_learning_experiences_settings',
            'settings'        => 'online_education_classes_learning_experiences_small_heading' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_learning_experiences_main_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_learning_experiences_main_heading',
        array(
            'label'           => sprintf( esc_html__( 'Main Heading', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_learning_experiences_settings',
            'settings'        => 'online_education_classes_learning_experiences_main_heading' ,
            'type'            => 'text',
        )
    );
    
    $wp_customize->add_setting( 'online_education_classes_learning_experiences_increase', array(
        'default'           => '', 
        'sanitize_callback' => 'online_education_classes_sanitize_number',
    ));

    // Add control for number of Services
    $wp_customize->add_control( 'online_education_classes_learning_experiences_increase', array(
        'label'       => __( 'Number of Experiences to Display', 'online-education-classes' ),
        'section'     => 'online_education_classes_learning_experiences_settings', 
        'type'        => 'number', 
        'input_attrs' => array(
            'min' => 1,
            'max' => 8,
        ),      
    ));

    $online_education_classes_learning_experiences_count =  get_theme_mod('online_education_classes_learning_experiences_increase');

    for($i=1; $i<=$online_education_classes_learning_experiences_count; $i++ ) {  

    $wp_customize->add_setting(
        'online_education_classes_learning_experiences_image'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'online_education_classes_sanitize_image',

        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'online_education_classes_learning_experiences_image'.$i, 
            array(
                'label'           => sprintf( esc_html__( 'Experiences Image', 'online-education-classes' ).$i, ),
                'settings'  => 'online_education_classes_learning_experiences_image'.$i,
                'section'   => 'online_education_classes_learning_experiences_settings'
            ) 
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_learning_experiences_inner_heading'.$i,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_learning_experiences_inner_heading'.$i,
        array(
            'label'           => sprintf( esc_html__( 'Inner Heading', 'online-education-classes' ).$i, ),
            'section'         => 'online_education_classes_learning_experiences_settings',
            'settings'        => 'online_education_classes_learning_experiences_inner_heading'.$i ,
            'type'            => 'text',
        )
    );
    }
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_learning_experiences_register' );