<div class="theme-offer">
<?php

    function online_education_classes_create_customizer_nav_menu() {
        // ------- Create Nav Menu --------
        $online_education_classes_menuname = 'Primary';
        $online_education_classes_menulocation = 'primary';
        $online_education_classes_menu_exists = wp_get_nav_menu_object($online_education_classes_menuname);

        if (!$online_education_classes_menu_exists) {
            $online_education_classes_menu_id = wp_create_nav_menu($online_education_classes_menuname);

            wp_update_nav_menu_item($online_education_classes_menu_id, 0, array(
                'menu-item-title' => __('Home', 'online-education-classes'),
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
            ));

            wp_update_nav_menu_item($online_education_classes_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'online-education-classes'),
                'menu-item-url' => home_url('/index.php/about-us/'),
                'menu-item-status' => 'publish',
            ));

            wp_update_nav_menu_item($online_education_classes_menu_id, 0, array(
                'menu-item-title' => __('Services', 'online-education-classes'),
                'menu-item-url' => home_url('/index.php/services/'),
                'menu-item-status' => 'publish',
            ));

            wp_update_nav_menu_item($online_education_classes_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'online-education-classes'),
                'menu-item-url' => home_url('/index.php/pages/'),
                'menu-item-status' => 'publish',
            ));

            wp_update_nav_menu_item($online_education_classes_menu_id, 0, array(
                'menu-item-title' => __('Blog', 'online-education-classes'),
                'menu-item-url' => home_url('/index.php/blog/'),
                'menu-item-status' => 'publish',
            ));

            // Set menu to location
            $online_education_classes_locations = get_theme_mod('nav_menu_locations');
            if (!is_array($online_education_classes_locations)) {
                $online_education_classes_locations = array();
            }
            $online_education_classes_locations[$online_education_classes_menulocation] = $online_education_classes_menu_id;
            set_theme_mod('nav_menu_locations', $online_education_classes_locations);
        }
    }

    // POST and update the customizer and other related data of Online Education Classes
    if (isset($_POST['submit'])) {

        // -------- Plugin Installation and Activation (WooCommerce & Classic Widgets) -------- //
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
        include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
        include_once(ABSPATH . 'wp-admin/includes/file.php');
        include_once(ABSPATH . 'wp-admin/includes/misc.php');

        // Plugin list
        $online_education_classes_plugins = array(
            array(
                'slug' => 'classic-widgets',
                'file' => 'classic-widgets/classic-widgets.php',
                'download_url' => 'https://downloads.wordpress.org/plugin/classic-widgets.zip'
            )
        );

        foreach ($online_education_classes_plugins as $plugin) {
            $installed_plugins = get_plugins();

            // Install the plugin if it's not installed
            if (!isset($installed_plugins[$plugin['file']])) {
                $upgrader = new Plugin_Upgrader();
                $upgrader->install($plugin['download_url']);
            }

            // Activate the plugin if it's not active
            if (file_exists(WP_PLUGIN_DIR . '/' . $plugin['file']) && !is_plugin_active($plugin['file'])) {
                activate_plugin($plugin['file']);
            }
        }

        // ------- Create Menu --------
        online_education_classes_create_customizer_nav_menu();

        // ------- Create Pages --------
        function create_demo_page($title, $content = '', $template = '') {
            $page_id = online_education_classes_get_page_id_by_title($title);
        
            if (!$page_id) {
                $page_data = array(
                    'post_type'    => 'page',
                    'post_title'   => $title,
                    'post_content' => $content,
                    'post_status'  => 'publish',
                    'post_author'  => 1,
                );
        
                $page_id = wp_insert_post($page_data);
        
                if ($template && !is_wp_error($page_id)) {
                    update_post_meta($page_id, '_wp_page_template', $template);
                }
            }
        
            return $page_id;
        }
        

        $online_education_classes_home_id = create_demo_page('Home', '', 'home/home.php');
        update_option('page_on_front', $online_education_classes_home_id);
        update_option('show_on_front', 'page');

        create_demo_page('Pages', '<p>Lorem Ipsum ...</p>');
        create_demo_page('About Us', '<p>Lorem Ipsum ...</p>');
        create_demo_page('Services', '<p>Service description...</p>');

        // Create blog page and assign it to display posts
        $blog_page_id = create_demo_page('Blog');
        update_option('page_for_posts', $blog_page_id);

        // Create the nav menu
        online_education_classes_create_customizer_nav_menu();

        // ------- Set Theme Mods -------

        set_theme_mod('online_education_classes_topbar_time', 'Mon - Fri 09:00 - 17:00');
        set_theme_mod('online_education_classes_topbar_address', 'AlBahr St, Tanta AlGharbia, Egypt');
        set_theme_mod('online_education_classes_topbar_call', '+1-223-3344-34');
        set_theme_mod('online_education_classes_topbar_email_id', 'education@example.com');

        set_theme_mod('online_education_classes_achievement_head1', 'NUMBER 1');
        set_theme_mod('online_education_classes_achievement1', 'Law firm in Egypt');
        set_theme_mod('online_education_classes_achievement_head2', 'TRUSTED BY');
        set_theme_mod('online_education_classes_achievement2', '5000+ Clients');
        set_theme_mod('online_education_classes_achievement_head3', 'WIN OVER');
        set_theme_mod('online_education_classes_achievement3', '50+ Education award');
        set_theme_mod('online_education_classes_header_counsult_button_link', '#');

        set_theme_mod('online_education_classes_social_media1_heading', 'www.facebook.com');
        set_theme_mod('online_education_classes_social_media2_heading', 'www.instagram.com');
        set_theme_mod('online_education_classes_social_media3_heading', 'www.twitter.com');
        set_theme_mod('online_education_classes_social_media4_heading', 'www.youtube.com');

        // ------- Banner Section --------

        $online_education_classes_banner_headings = array('Empowering Minds, Shaping Futures.', 'Developing Minds, Shaping Futures.','Empowering Minds, Shaping Futures.');
        set_theme_mod('online_education_classes_slider_increase', 3);
        for ($i = 1; $i <= 3; $i++) {
            set_theme_mod("online_education_classes_banner_image$i", get_template_directory_uri() . "/img/banner$i.png");
            set_theme_mod("online_education_classes_banner_heading$i", $online_education_classes_banner_headings[$i - 1]);
            set_theme_mod("online_education_classes_banner_small_heading$i", 'We Are Here To Help You Education');
            set_theme_mod("online_education_classes_banner_button_link$i", '#');
        }

        // ------- Services Section --------

        set_theme_mod('online_education_classes_learning_experiences_small_heading', 'Our Marvellous Stretagies');
        set_theme_mod('online_education_classes_learning_experiences_main_heading', 'LEARNING EXPERIENCES');
        
        $online_education_classes_service_headings = array('Creative Studies', 'Personal Development', 'Teaching Methods', 'Innovation','Personal Development');

        set_theme_mod('online_education_classes_learning_experiences_increase', 5);
        for ($i = 1; $i <= 5; $i++) {
            set_theme_mod("online_education_classes_learning_experiences_image$i", get_template_directory_uri() . "/img/exper$i.png");
            
            set_theme_mod("online_education_classes_learning_experiences_inner_heading$i", $online_education_classes_service_headings[$i - 1]);
        }

        echo '<div class="success">Demo Import Successful</div>';
    }
?>

<ul>
    <li>
        <hr>
        <?php if (!isset($_POST['submit'])) : ?>
            <?php echo esc_html__('Click on the below button to get demo content installed.', 'online-education-classes'); ?>
            <br>
            <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
                <input class="run-btn" type="submit" name="submit" value="<?php echo esc_attr('Run Importer', 'online-education-classes'); ?>">
            </form>
        <?php else: ?>
            <div class="visit">
                <a href="<?php echo esc_url(home_url()); ?>" class="button button-primary button-large run-btn" style="margin-top: 10px;" target="_blank">View Site</a>
            </div>
        <?php endif; ?>
        <hr>
    </li>
</ul>
</div>