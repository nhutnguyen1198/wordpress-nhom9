<?php
/**
 * The header for our theme.
 *
 * @package Online Education Classes
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('at-sticky-sidebar'); ?>>
    <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        }
        else {
            do_action('wp_body_open');
        }
    ?>

    <?php if(get_theme_mod('online_education_classes_enable_preloader',false)=="1"){ ?>
            <!-- start preloader -->
            <div class="loader-wrapper lds-flickr">
                <div id="pre-loader">
                    <div class="loader-pulse"></div>
                </div>
            </div>
            <!-- end preloader -->
        <?php
        }
    ?>

    <!-- header styles -->
    <?php
        get_template_part( 'inc/header-menu/content-header-style');
    ?>