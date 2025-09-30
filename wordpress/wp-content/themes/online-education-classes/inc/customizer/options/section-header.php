<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_header_register' ) ) :
function online_education_classes_customizer_header_register( $wp_customize ) {

    $wp_customize->add_section(
        'online_education_classes_home_header_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Header Settings', 'online-education-classes' )
        )
    );    

     // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_header_settings_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_header_settings_title', 
        array(
            'label'       => esc_html__( 'Contact Details', 'online-education-classes' ),
            'section'     => 'online_education_classes_home_header_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_header_settings_title',
        ) 
    ));

    $wp_customize->add_setting(
        'online_education_classes_topbar_time',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_topbar_time',
        array(
            'label'           => sprintf( esc_html__( 'Day and Time', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_topbar_time' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_topbar_address',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_topbar_address',
        array(
            'label'           => sprintf( esc_html__( 'Address', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_topbar_address' ,
            'type'            => 'text',
        )
    );

    // Phone Number
    $wp_customize->add_setting(
        'online_education_classes_topbar_call',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_topbar_call',
        array(
            'label'           => sprintf( esc_html__( 'Phone Number', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_topbar_call' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_topbar_email_id',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_topbar_email_id',
        array(
            'label'           => sprintf( esc_html__( 'Email Id', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_topbar_email_id' ,
            'type'            => 'text',
        )
    );

    
    // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_social_meida_settings_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_social_meida_settings_title', 
        array(
            'label'       => esc_html__( 'Social Media Links', 'online-education-classes' ),
            'section'     => 'online_education_classes_home_header_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_social_meida_settings_title',
        ) 
    ));

    // Facebook Link
    $wp_customize->add_setting(
        'online_education_classes_social_media1_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media1_heading',
        array(
            'label'           => sprintf( esc_html__( 'Facebook Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media1_heading' ,
            'type'            => 'url',
        )
    );

    // Instagram Link
    $wp_customize->add_setting(
        'online_education_classes_social_media2_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media2_heading',
        array(
            'label'           => sprintf( esc_html__( 'Instagram Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media2_heading' ,
            'type'            => 'url',
        )
    );

    // Twitter Link
    $wp_customize->add_setting(
        'online_education_classes_social_media3_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media3_heading',
        array(
            'label'           => sprintf( esc_html__( 'Twitter Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media3_heading' ,
            'type'            => 'url',
        )
    );

    // Youtube Link
    $wp_customize->add_setting(
        'online_education_classes_social_media4_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media4_heading',
        array(
            'label'           => sprintf( esc_html__( 'Youtube Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media4_heading' ,
            'type'            => 'url',
        )
    );

    // Pinterest Link
    $wp_customize->add_setting(
        'online_education_classes_social_media5_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media5_heading',
        array(
            'label'           => sprintf( esc_html__( 'Pinterest Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media5_heading' ,
            'type'            => 'url',
        )
    );

    // Linkedin Link
    $wp_customize->add_setting(
        'online_education_classes_social_media6_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_social_media6_heading',
        array(
            'label'           => sprintf( esc_html__( 'Linkedin Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_social_media6_heading' ,
            'type'            => 'url',
        )
    );

     // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_topbar2_settings_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_topbar2_settings_title', 
        array(
            'label'       => esc_html__( 'Topbar2 Achievement Details', 'online-education-classes' ),
            'section'     => 'online_education_classes_home_header_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_topbar2_settings_title',
        ) 
    ));

    $wp_customize->add_setting(
        'online_education_classes_achievement_head1',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement_head1',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Head1', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement_head1' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_achievement1',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement1',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Title1', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement1' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_achievement_head2',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement_head2',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Head2', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement_head2' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_achievement2',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement2',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Title2', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement2' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_achievement_head3',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement_head3',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Head3', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement_head3' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_achievement3',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_achievement3',
        array(
            'label'           => sprintf( esc_html__( 'Achievement Title3', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_achievement3' ,
            'type'            => 'text',
        )
    );

    // Title label
    $wp_customize->add_setting( 
        'online_education_classes_label_header_button_title', 
        array(
            'sanitize_callback' => 'online_education_classes_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_header_button_title', 
        array(
            'label'       => esc_html__( 'Header Button', 'online-education-classes' ),
            'section'     => 'online_education_classes_home_header_settings',
            'type'        => 'online-education-classes-title',
            'settings'    => 'online_education_classes_label_header_button_title',
        ) 
    ));

    $wp_customize->add_setting(
        'online_education_classes_achievement_head1',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_setting(
        'online_education_classes_header_counsult_button_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_header_counsult_button_link',
        array(
            'label'           => sprintf( esc_html__( 'Header Button Link', 'online-education-classes' ), ),
            'section'         => 'online_education_classes_home_header_settings',
            'settings'        => 'online_education_classes_header_counsult_button_link' ,
            'type'            => 'url',
        )
    );
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_header_register' );