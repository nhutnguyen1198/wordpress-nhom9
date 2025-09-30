<?php
/**
 * Template part for displaying header menu
 *
 * @package Online Education Classes
 */

?>
<?php
    $online_education_classes_page_val= is_front_page() ? 'home':'page' ;

?>

<header id="<?php echo esc_attr($online_education_classes_page_val);?>-inner" class="elementer-menu-anchor theme-menu-wrapper full-width-menu style1 page" role="banner">
    <?php
        if(true===get_theme_mod('online_education_classes_enable_highlighted area',true) && is_front_page()){
            ?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('skip to content','online-education-classes'); ?> </a> <?php
        }
        else{
        ?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('skip to content','online-education-classes');?></a> <?php
    }
    ?>
    <div id="header-main" class="header-wrapper">
        <div id="topbar">
            <div class="container">
                <div class="row py-2">
                    <div class="col-lg-2 col-md-4 col-12 align-self-center text-center text-lg-start text-md-center">
                        <div class="tbr-time">
                            <?php
                                $online_education_classes_topbar_time = get_theme_mod( 'online_education_classes_topbar_time', '' );
                                if ( ! empty( $online_education_classes_topbar_time ) ) { ?>
                                    <span>
                                        <i class="bi bi-clock-fill tbr-clck-icn me-1"></i>
                                    </span>
                                    <span class="topbar-time text-center text-lg-start text-md-center mb-0"><?php echo esc_html( $online_education_classes_topbar_time ); ?></span>
                            <?php } ?>
                        </div>  
                    </div>
                    <div class="col-lg-3 col-md-5 col-12 align-self-center text-center text-lg-start text-md-center">
                        <div class="tbr-adrs">
                            <?php
                            $online_education_classes_topbar_address = get_theme_mod( 'online_education_classes_topbar_address', '' );
                            if ( ! empty( $online_education_classes_topbar_address ) ) { ?>
                                <span>
                                   <i class="bi bi-geo-alt-fill tbr-map-icn me-1"></i>
                                </span>
                                <span class="topbar-addrs text-center text-lg-start text-md-center mb-0"><?php echo esc_html( $online_education_classes_topbar_address ); ?></span>
                            <?php } ?>
                        </div>
                    </div>  
                    <div class="col-lg-2 col-md-3 col-12 align-self-center text-center text-lg-start text-md-center">
                        <div class="tbr-phone">
                            <?php
                            $online_education_classes_topbar_call = get_theme_mod( 'online_education_classes_topbar_call', '' );
                            if ( ! empty( $online_education_classes_topbar_call ) ) { ?>
                                <span>
                                   <i class="bi bi-telephone-fill tbr-call-icn me-1"></i>
                                </span>
                                <span class="topbar-call text-center text-lg-start text-md-center mb-0"><?php echo esc_html( $online_education_classes_topbar_call ); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 align-self-center text-center text-lg-start text-md-center">
                        <div class="tbr-mail text-center text-lg-start text-md-center">
                            <?php $online_education_classes_topbar_email_id = get_theme_mod('online_education_classes_topbar_email_id', '' );
                                if ( ! empty( $online_education_classes_topbar_email_id ) ) { ?>
                                    <span>
                                        <i class="bi bi-envelope-open-fill tbr-mail-icn me-1"></i>
                                    </span> 
                                    <span class="topbr-mail-id text-center text-lg-start text-md-center mb-0">
                                    <?php echo esc_html( $online_education_classes_topbar_email_id ); ?></span>
                            <?php } ?>
                        </div>
                    </div>                    
                    <div class="col-lg-2 col-md-6 col-12 align-self-center text-center text-lg-end text-md-end">
                        <div class="follow-us my-2 my-lg-0">
                            <?php
                                $online_education_classes_social_media1_heading = get_theme_mod( 'online_education_classes_social_media1_heading', '' );
                                if ( ! empty( $online_education_classes_social_media1_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media1_heading ); ?>"><i class="bi bi-facebook me-3 fb"></i></a>
                            <?php } ?>
                            <?php
                                $online_education_classes_social_media2_heading = get_theme_mod( 'online_education_classes_social_media2_heading', '' );
                                if ( ! empty( $online_education_classes_social_media2_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media2_heading ); ?>"><i class="bi bi-instagram me-3 inst"></i></a>
                            <?php } ?>
                            <?php
                                $online_education_classes_social_media3_heading = get_theme_mod( 'online_education_classes_social_media3_heading', '' );
                                if ( ! empty( $online_education_classes_social_media3_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media3_heading ); ?>"><i class="bi bi-twitter-x me-3 twt"></i></a>
                            <?php } ?>
                            <?php
                                $online_education_classes_social_media4_heading = get_theme_mod( 'online_education_classes_social_media4_heading', '' );
                                if ( ! empty( $online_education_classes_social_media4_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media4_heading ); ?>"><i class="bi bi-youtube me-3 utb"></i></a>
                            <?php } ?>
                            <?php
                                $online_education_classes_social_media5_heading = get_theme_mod( 'online_education_classes_social_media5_heading', '' );
                                if ( ! empty( $online_education_classes_social_media5_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media5_heading ); ?>"><i class="bi bi-pinterest me-3 pin"></i></a>
                            <?php } ?>
                            <?php
                                $online_education_classes_social_media6_heading = get_theme_mod( 'online_education_classes_social_media6_heading', '' );
                                if ( ! empty( $online_education_classes_social_media6_heading ) ) { ?>
                                <a href="<?php echo esc_url( $online_education_classes_social_media6_heading ); ?>"><i class="bi bi-linkedin me-3 lnk"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="custom-header">
            <?php if ( display_header_text() ) : ?>
            <div id="topbar2">
                <div class="container">
                    <div class="row py-2">
                        <div class="col-lg-4 col-md-12 col-12 align-self-center text-center text-lg-start text-md-center ri8-logo">
                            <div class="logo <?php echo (has_custom_logo() ? 'has-logo' : 'no-logo'); ?>" itemscope itemtype="https://schema.org/Organization">
                                <?php 
                                    // Display custom logo if available
                                    if ( has_custom_logo() ) {
                                        online_education_classes_custom_logo();
                                    }

                                    // Display sticky header logo if enabled
                                    if ( get_theme_mod( 'online_education_classes_enable_logo_stickyheader', false ) ) {
                                        $online_education_classes_alt_logo = esc_url( get_theme_mod( 'online_education_classes_logo_stickyheader' ) );
                                        if ( ! empty( $online_education_classes_alt_logo ) ) {
                                            ?>
                                            <a id="logo-alt" class="logo-alt" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                <img src="<?php echo esc_url( $online_education_classes_alt_logo ); ?>" alt="<?php esc_attr_e( 'logo', 'online-education-classes' ); ?>">
                                            </a>
                                            <?php
                                        }
                                    }

                                    // Site title and tagline settings
                                    $online_education_classes_show_title   = get_theme_mod( 'online_education_classes_display_site_title', true );
                                    $online_education_classes_show_tagline = get_theme_mod( 'online_education_classes_display_site_tagline', false );
                                    $online_education_classes_header_class = $online_education_classes_show_title ? 'site-title' : 'screen-reader-text';

                                    // Display site title
                                    if ( $online_education_classes_show_title && get_bloginfo( 'name' ) ) {
                                        if ( is_front_page() ) {
                                            ?>
                                            <h1 class="<?php echo esc_attr( $online_education_classes_header_class ); ?>">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                                            </h1>
                                            <?php
                                        } else {
                                            ?>
                                            <p class="<?php echo esc_attr( $online_education_classes_header_class ); ?>">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                                            </p>
                                            <?php
                                        }
                                    }

                                    // Display tagline
                                    if ( $online_education_classes_show_tagline ) {
                                        $online_education_classes_description = get_bloginfo( 'description', 'display' );
                                        if ( $online_education_classes_description || is_customize_preview() ) {
                                            ?>
                                            <p class="site-description"><?php echo esc_html( $online_education_classes_description ); ?></p>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-12 align-self-center">
                            <div class="row achv-shift">
                                <div class="col-lg-4 col-md-4 col-12 align-self-center text-center text-lg-start text-md-center ri8-achv">
                                    <div class="achievement1-box row">
                                        <?php 
                                        $online_education_classes_achievement_head1 = get_theme_mod('online_education_classes_achievement_head1', '' );
                                        $online_education_classes_achievement1 = get_theme_mod('online_education_classes_achievement1', '' );
                                        if ( ! empty( $online_education_classes_achievement1 ) ) { ?>
                                        <div class="col-lg-2 col-md-2 col-2 align-self-center achmnt-icon1">
                                            <i class="bi bi-trophy-fill trphy-icon"></i>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-10 ps-lg-0 achvmnt-info1">
                                            <p class="achvmnt-hd mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement_head1 ); ?></p>
                                            <p class="achvmnt-name mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement1 ); ?></p>
                                        </div>
                                        <?php } ?>                     
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 align-self-center text-center text-lg-start text-md-center ri8-achv2">
                                    <div class="achievement2-box row">
                                        <?php 
                                        $online_education_classes_achievement_head2 = get_theme_mod('online_education_classes_achievement_head2', '' );
                                        $online_education_classes_achievement2 = get_theme_mod('online_education_classes_achievement2', '' );
                                        if ( ! empty( $online_education_classes_achievement2 ) ) { ?>
                                        <div class="col-lg-2 col-md-2 col-2 align-self-center achmnt-icon2">
                                            <i class="bi bi-file-check-fill"></i>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-10 ps-lg-0 achvmnt-info2">
                                            <p class="achvmnt-hd mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement_head2 ); ?></p>
                                            <p class="achvmnt-name mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement2 ); ?></p>
                                        </div>
                                        <?php } ?>                     
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 align-self-center text-center text-lg-start text-md-center ri8-achv3">
                                    <div class="achievement3-box row">
                                        <?php 
                                        $online_education_classes_achievement_head3 = get_theme_mod('online_education_classes_achievement_head3', '' );
                                        $online_education_classes_achievement3 = get_theme_mod('online_education_classes_achievement3', '' );
                                        if ( ! empty( $online_education_classes_achievement3 ) ) { ?>
                                        <div class="col-lg-2 col-md-2 col-2 align-self-center achmnt-icon3">
                                            <i class="bi bi-award awrd-icon"></i>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-10 ps-lg-0 achvmnt-info3">
                                            <p class="achvmnt-hd mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement_head3 ); ?></p>
                                            <p class="achvmnt-name mb-0">
                                            <?php echo esc_html( $online_education_classes_achievement3 ); ?></p>
                                        </div>
                                        <?php } ?>                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div id="content-header">
            <div class="container">
                <div class="menu-colr-bg ps-4 pe-3">
                    <div class="row">
                       <div class="col-lg-10 col-md-6 col-3 align-self-center">
                            <div class="top-menu-wrapper">
                                <div class="navigation_header">
                                    <div class="toggle-nav mobile-menu">
                                        <button onclick="online_education_classes_openNav()"><i class="bi bi-list"></i></button>
                                    </div>
                                    <div id="mySidenav" class="nav sidenav">
                                        <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'online-education-classes' ); ?>">
                                            <?php {
                                                    wp_nav_menu(
                                                        array(
                                                            'theme_location' => 'primary',
                                                            'container_class' => 'navi clearfix navbar-nav' ,
                                                            'menu_class'     => 'menu clearfix', 
                                                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                            'fallback_cb' => 'wp_page_menu',
                                                        )
                                                    );
                                                } ?>
                                        </nav>
                                        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="online_education_classes_closeNav()"><i class="bi bi-x"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                       <div class="col-lg-2 col-md-6 col-9 align-self-center">
                            <div class="hdr-counslt-btn">
                                <?php
                                    $online_education_classes_header_counsult_button_link = get_theme_mod( 'online_education_classes_header_counsult_button_link', '' );
                                    if ( ! empty( $online_education_classes_header_counsult_button_link ) ) { ?>
                                    <div class="hdr-button">
                                        <a href="<?php echo esc_url( $online_education_classes_header_counsult_button_link ); ?>"><?php echo esc_html('FREE CONSULTATION','online-education-classes'); ?></a>
                                    </div> 
                                <?php } ?>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</header>

<div class="clearfix"></div>
<div id="content" class="elementor-menu-anchor"></div>

<div class="content-wrap">