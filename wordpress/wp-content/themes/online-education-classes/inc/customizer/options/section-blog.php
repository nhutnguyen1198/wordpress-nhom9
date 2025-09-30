<?php
/**
 * Theme Customizer Controls
 *
 * @package Online Education Classes
 */

if ( ! function_exists( 'online_education_classes_customizer_blog_register' ) ) :
function online_education_classes_customizer_blog_register( $wp_customize ) {
	
	$wp_customize->add_panel(
        'online_education_classes_blog_settings_panel',
        array (
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Blog Settings', 'online-education-classes' ),
        )
    );

	// Section Posts
    $wp_customize->add_section(
        'online_education_classes_posts_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Posts', 'online-education-classes' ),
            'panel'          => 'online_education_classes_blog_settings_panel',
        )
    ); 

	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_post_meta_show', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_post_meta_show', 
		array(
		    'label'       => esc_html__( 'Posts Meta', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_post_meta_show',
		) 
	));

	// Add an option to enable the date
	$wp_customize->add_setting( 
		'online_education_classes_enable_posts_meta_date', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_posts_meta_date', 
		array(
		    'label'       => esc_html__( 'Show Date', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_posts_meta_date',
		) 
	));

	// Add an option to enable the author
	$wp_customize->add_setting( 
		'online_education_classes_enable_posts_meta_author', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_posts_meta_author', 
		array(
		    'label'       => esc_html__( 'Show Author', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_posts_meta_author',
		) 
	));

	// Add an option to enable the comments
	$wp_customize->add_setting( 
		'online_education_classes_enable_posts_meta_comments', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_posts_meta_comments', 
		array(
		    'label'       => esc_html__( 'Show Comments', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_posts_meta_comments',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_sidebar_layout', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_sidebar_layout', 
		array(
		    'label'       => esc_html__( 'Sidebar', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_sidebar_layout',
		) 
	));

	// Sidebar layout
    $wp_customize->add_setting(
        'online_education_classes_blog_sidebar_layout',
        array(
            'default'			=> 'right',
            'type'				=> 'theme_mod',
            'capability'		=> 'edit_theme_options',
            'sanitize_callback'	=> 'online_education_classes_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new Online_Education_Classes_Radio_Image_Control( $wp_customize,'online_education_classes_blog_sidebar_layout',
            array(
                'settings'		=> 'online_education_classes_blog_sidebar_layout',
                'section'		=> 'online_education_classes_posts_settings',
                'label'			=> esc_html__( 'Sidebar Layout', 'online-education-classes' ),
                'choices'		=> array(
                    'right'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cr.png',
                    'left' 	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cl.png',
                    'three_colm'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/c3.png',
                    'four_colm'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/c4.png',
                    'grid_layout'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/c5.png',
                    'grid_left_sidebar'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/c6.png',
                    'grid_right_sidebar'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/c7.png',
                    'no' 	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cn.png',
                )
            )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_blog_excerpt', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_blog_excerpt', 
		array(
		    'label'       => esc_html__( 'Post Excerpt', 'online-education-classes' ),
		    'section'     => 'online_education_classes_posts_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_blog_excerpt',
		) 
	));

	// add post excerpt textbox
    $wp_customize->add_setting(
        'online_education_classes_posts_excerpt_length',
        array(
            'type' => 'theme_mod',
            'default'           => 30,
            'sanitize_callback' => 'online_education_classes_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_posts_excerpt_length',
        array(
            'settings'      => 'online_education_classes_posts_excerpt_length',
            'section'       => 'online_education_classes_posts_settings',
            'type'          => 'number',
            'label'         => esc_html__( 'Post Excerpt Length', 'online-education-classes' ),
        )
    );

    // add readmore textbox
    $wp_customize->add_setting(
        'online_education_classes_posts_readmore_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'READ MORE', 'online-education-classes' ),
            'sanitize_callback' => 'online_education_classes_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_posts_readmore_text',
        array(
            'settings'      => 'online_education_classes_posts_readmore_text',
            'section'       => 'online_education_classes_posts_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Read More Text', 'online-education-classes' ),
        )
    );

    //=========================================================================

	// Section Single Post
    $wp_customize->add_section(
        'online_education_classes_single_post_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Single Post', 'online-education-classes' ),
            'panel'          => 'online_education_classes_blog_settings_panel',
        )
    ); 


    // Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_single_post_category_show', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_single_post_category_show', 
		array(
		    'label'       => esc_html__( 'Post Category', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_single_post_category_show',
		) 
	));

	// Add an option to enable the category
	$wp_customize->add_setting( 
		'online_education_classes_enable_single_post_cat', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_single_post_cat', 
		array(
		    'label'       => esc_html__( 'Show Category', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_single_post_cat',
		) 
	));

	// add category textbox
    $wp_customize->add_setting(
        'online_education_classes_single_post_category_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Category:', 'online-education-classes' ),
            'sanitize_callback' => 'online_education_classes_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_single_post_category_text',
        array(
            'settings'      => 'online_education_classes_single_post_category_text',
            'section'       => 'online_education_classes_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Category Text', 'online-education-classes' ),
        )
    );

	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_single_post_tag_show', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_single_post_tag_show', 
		array(
		    'label'       => esc_html__( 'Post Tags', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_single_post_tag_show',
		) 
	));

	// Add an option to enable the tags
	$wp_customize->add_setting( 
		'online_education_classes_enable_single_post_tags', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_single_post_tags', 
		array(
		    'label'       => esc_html__( 'Show Tags', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_single_post_tags',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_single_pos_meta_show', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_single_pos_meta_show', 
		array(
		    'label'       => esc_html__( 'Post Meta', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_single_pos_meta_show',
		) 
	));

	// Add an option to enable the date
	$wp_customize->add_setting( 
		'online_education_classes_enable_single_post_meta_date', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_single_post_meta_date', 
		array(
		    'label'       => esc_html__( 'Show Date', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_single_post_meta_date',
		) 
	));

	// Add an option to enable the author
	$wp_customize->add_setting( 
		'online_education_classes_enable_single_post_meta_author', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_single_post_meta_author', 
		array(
		    'label'       => esc_html__( 'Show Author', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_single_post_meta_author',
		) 
	));

	// Add an option to enable the comments
	$wp_customize->add_setting( 
		'online_education_classes_enable_single_post_meta_comments', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'online_education_classes_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Toggle_Control( $wp_customize, 'online_education_classes_enable_single_post_meta_comments', 
		array(
		    'label'       => esc_html__( 'Show Comments', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-toggle',
		    'settings'    => 'online_education_classes_enable_single_post_meta_comments',
		) 
	));

	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_single_pos_nav_show', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_single_pos_nav_show', 
		array(
		    'label'       => esc_html__( 'Post Navigation', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_single_pos_nav_show',
		) 
	));

    // add next article textbox
    $wp_customize->add_setting(
        'online_education_classes_single_post_next_article_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Next Article', 'online-education-classes' ),
            'sanitize_callback' => 'online_education_classes_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_single_post_next_article_text',
        array(
            'settings'      => 'online_education_classes_single_post_next_article_text',
            'section'       => 'online_education_classes_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Next Article Text', 'online-education-classes' ),
            'description'         => esc_html__( 'You can change the text displayed in the single post navigation', 'online-education-classes' ),
        )
    );

    // add previous article textbox
    $wp_customize->add_setting(
        'online_education_classes_single_post_previous_article_text',
        array(
            'type' => 'theme_mod',
            'default'           => esc_html__( 'Previous Article', 'online-education-classes' ),
            'sanitize_callback' => 'online_education_classes_sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'online_education_classes_single_post_previous_article_text',
        array(
            'settings'      => 'online_education_classes_single_post_previous_article_text',
            'section'       => 'online_education_classes_single_post_settings',
            'type'          => 'textbox',
            'label'         => esc_html__( 'Previous Article Text', 'online-education-classes' ),
            'description'         => esc_html__( 'You can change the text displayed in the single post navigation', 'online-education-classes' ),
        )
    );
    
	// Title label
	$wp_customize->add_setting( 
		'online_education_classes_label_single_sidebar_layout', 
		array(
		    'sanitize_callback' => 'online_education_classes_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Online_Education_Classes_Title_Info_Control( $wp_customize, 'online_education_classes_label_single_sidebar_layout', 
		array(
		    'label'       => esc_html__( 'Sidebar', 'online-education-classes' ),
		    'section'     => 'online_education_classes_single_post_settings',
		    'type'        => 'online-education-classes-title',
		    'settings'    => 'online_education_classes_label_single_sidebar_layout',
		) 
	));

	// Sidebar layout
    $wp_customize->add_setting(
        'online_education_classes_blog_single_sidebar_layout',
        array(
            'default'			=> 'no',
            'type'				=> 'theme_mod',
            'capability'		=> 'edit_theme_options',
            'sanitize_callback'	=> 'online_education_classes_sanitize_select'
        )
    );
    $wp_customize->add_control(
        new Online_Education_Classes_Radio_Image_Control( $wp_customize,'online_education_classes_blog_single_sidebar_layout',
            array(
                'settings'		=> 'online_education_classes_blog_single_sidebar_layout',
                'section'		=> 'online_education_classes_single_post_settings',
                'label'			=> esc_html__( 'Sidebar Layout', 'online-education-classes' ),
                'choices'		=> array(
                    'right'	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cr.png',
                    'left' 	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cl.png',
                    'no' 	        => ONLINE_EDUCATION_CLASSES_DIR_URI . '/inc/customizer/assets/images/cn.png',
                )
            )
        )
    );
}
endif;

add_action( 'customize_register', 'online_education_classes_customizer_blog_register' );