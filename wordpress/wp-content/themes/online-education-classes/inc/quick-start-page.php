<?php
/*
 * @package Online Education Classes
 */

function online_education_classes_admin_enqueue_scripts() {
    wp_enqueue_style( 'online-education-classes-admin-style', esc_url( get_template_directory_uri() ).'/inc/quick-start-page.css' );
}
add_action( 'admin_enqueue_scripts', 'online_education_classes_admin_enqueue_scripts' );

function online_education_classes_theme_info_menu_link() {
    add_theme_page(
        esc_html__( 'Theme Demo Import', 'online-education-classes' ),
        esc_html__( 'Theme Demo Import', 'online-education-classes' ),
        'edit_theme_options',
        'online-education-classes-demo',
        'online_education_classes_demo_content_page'
    );

}
add_action( 'admin_menu', 'online_education_classes_theme_info_menu_link' );


function online_education_classes_demo_content_page() {

    $online_education_classes_theme = wp_get_theme();
    ?>
    <div class="demo-box">
        <div class="wrapper-demo">
            <div class="importer-content">
                <h2><?php echo esc_html( 'Welcome to Online Education Classes', 'online-education-classes' ); ?> <span class="demo-versn"><?php echo $online_education_classes_theme->get( 'Version' ); ?></span></h2>
                <h6><?php echo esc_html('Importing Demo Content','online-education-classes');?> </h6>
                <p><?php echo esc_html('Click Run Importer to begin the process of configuring your website. This will enable you to easily duplicate the theme\'s sample layout by automatically importing all required demo content, such as pages, settings, and configurations. It is strongly advised that you create a complete backup of your website before launching the importer. This guarantees that your current data is secure and recoverable in the event of an emergency. For best speed and appearance, the suggested Customizer settings are automatically applied by the demo importer, which is designed to work perfectly with Online Education Classes. All of the settings and content will be applied after the import is finished. You can, however, freely alter things further to suit your tastes using the WordPress Customizer.','online-education-classes'); ?></p>
                <?php require get_parent_theme_file_path( '/inc/quick-start-content.php' ); ?>
            </div>
            <div class="thme-img-box">
                <img src="<?php echo esc_url( get_template_directory_uri().'/screenshot.png' ); ?>" />
            </div>
        </div>
    </div>

<?php
}

?>