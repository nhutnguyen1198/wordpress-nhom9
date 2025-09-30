<?php
/**
 * @package Online Education Classes
 */

/**
 * Footer
 */
if (! function_exists( 'online_education_classes_footer_copyrights' ) ):
    function online_education_classes_footer_copyrights() {
        ?>
            <div class="row">
                <div class="copyrights">
                    <p>
                        <?php
                            if("" != esc_html(get_theme_mod( 'online_education_classes_footer_copyright_text'))) :
                                echo esc_html(get_theme_mod( 'online_education_classes_footer_copyright_text'));
                                if(get_theme_mod('online_education_classes_en_footer_credits',true)) :
                                    ?> 
                                    <span class="copyrg-link"><a href="<?php echo esc_url(ONLINE_EDUCATION_CLASSES_AUT); ?>" target="_blank" rel="nofollow noopener"><?php esc_html_e(' | Online Courses WordPress Theme','online-education-classes') ?></a><?php esc_html_e(' by Legacy Themes','online-education-classes') ?></span>
                                    <?php   
                                endif;
                            else :
                                echo date_i18n(
                                    /* translators: Copyright date format, see https://secure.php.net/date */
                                    _x( 'Y', 'copyright date format', 'online-education-classes' )
                                );
                                ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                    <span class="copyrg-link"><a href="<?php echo esc_url(ONLINE_EDUCATION_CLASSES_AUT); ?>" target="_blank" rel="nofollow noopener"><?php esc_html_e(' | Online Courses WordPress Theme','online-education-classes') ?></a><?php esc_html_e(' by Legacy Themes','online-education-classes') ?></span>
                                <?php
                            endif;
                        ?>
                    </p>
                </div>
            </div>
        <?php    
    }
endif;
add_action( 'online_education_classes_action_footer', 'online_education_classes_footer_copyrights' );

/**
 * Page Title Settings
 */
if ( ! function_exists( 'online_education_classes_show_page_title' ) ) :
    function online_education_classes_show_page_title() {
        if ( ! is_front_page() ) {
            ?>
            <div class="page-title"> 
                <div class="content-section img-overlay">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="section-title"> 
                                    <?php
                                    // WooCommerce Pages
                                    if ( function_exists( 'is_shop' ) && is_shop() ) {
                                        // Shop Page
                                        echo '<h1 class="main-title">' . esc_html__( 'Shop Page', 'online-education-classes' ) . '</h1>';

                                    } elseif ( function_exists( 'is_product' ) && is_product() ) {
                                        // Single Product Page
                                        echo '<h1 class="main-title">' . esc_html__( 'Single Product Page', 'online-education-classes' ) . '</h1>';

                                    } elseif ( function_exists( 'is_checkout' ) && is_checkout() ) {
                                        // Checkout Page
                                        echo '<h1 class="main-title">' . esc_html__( 'Checkout', 'online-education-classes' ) . '</h1>';

                                    } elseif ( function_exists( 'is_account_page' ) && is_account_page() ) {
                                        // My Account Page
                                        echo '<h1 class="main-title">' . esc_html__( 'My Account', 'online-education-classes' ) . '</h1>';

                                    } elseif ( is_home() ) {
                                        // Blog Index Page
                                        echo '<h1 class="main-title">' . esc_html__( 'Blog Page', 'online-education-classes' ) . '</h1>';

                                    } elseif ( is_singular( 'post' ) ) {
                                        // Single Blog Post
                                        echo '<h1 class="main-title">' . get_the_title() . '</h1>';

                                    } elseif ( is_category() ) {
                                        echo '<h1 class="main-title">' . single_cat_title( '', false ) . '</h1>';

                                    } elseif ( is_tag() ) {
                                        echo '<h1 class="main-title">' . single_tag_title( '', false ) . '</h1>';

                                    } elseif ( is_author() ) {
                                        echo '<h1 class="main-title">' . get_the_author() . '</h1>';

                                    } elseif ( is_archive() ) {
                                        echo '<h1 class="main-title">' . get_the_archive_title() . '</h1>';

                                    } elseif ( is_search() ) {
                                        echo '<h1 class="main-title">' . esc_html__( 'Search Results', 'online-education-classes' ) . '</h1>';

                                    } elseif ( is_404() ) {
                                        echo '<h1 class="main-title">' . esc_html__( 'Page Not Found', 'online-education-classes' ) . '</h1>';

                                    } else {
                                        // Default for all other pages
                                        echo '<h1 class="main-title">' . get_the_title() . '</h1>';
                                    }
                                    ?>
                                </div>                      
                            </div>
                        </div>
                    </div>  
                </div>
            </div>  <!-- End page-title --> 
            <?php
        }
    }
endif;

// Register page title action globally
add_action( 'online_education_classes_get_page_title', 'online_education_classes_show_page_title' );

/**
 * Home Banner Section
 */
if (! function_exists( 'online_education_classes_home_banner_section' ) ):
    function online_education_classes_home_banner_section() {
        ?>
        <section id="main-banner-wrap">
            <div class="slider-sec">
                <div class="owl-carousel">
                    <?php $online_education_classes_banner_count = get_theme_mod("online_education_classes_slider_increase");
                    for ($i = 1; $i <= $online_education_classes_banner_count; $i++) { ?>
                    <?php
                    $online_education_classes_banner_image = get_theme_mod( 'online_education_classes_banner_image'.$i, '' );
                    if ( ! empty( $online_education_classes_banner_image ) ) { ?>
                        <div class="banner-side-margin position-relative">
                            <div class="main-banner-inner-box">                   
                                <img src="<?php echo esc_url( $online_education_classes_banner_image ); ?>">
                            </div>
                            <?php
                            $online_education_classes_alignment_class = get_theme_mod( 'online_education_classes_slider_content_alignment', 'center' );
                            ?>
                            <div class="main-banner-content-box content-<?php echo esc_attr( $online_education_classes_alignment_class ); ?>">
                                <?php
                                    $online_education_classes_banner_small_heading = get_theme_mod( 'online_education_classes_banner_small_heading'.$i, '' );                        
                                    if ( ! empty( $online_education_classes_banner_small_heading ) ) { ?>
                                        <h6 class="bnr-sm-hd p-0 mb-0 mb-lg-4"><?php echo esc_html( $online_education_classes_banner_small_heading ); ?></h6>
                                <?php } ?>
                                <?php
                                $online_education_classes_banner_heading = get_theme_mod( 'online_education_classes_banner_heading'.$i, '' );                        
                                if ( ! empty( $online_education_classes_banner_heading ) ) {
                                    $excerpt_heading = wp_trim_words( $online_education_classes_banner_heading, 5, '...' );?>
                                    <h2 class="bnr-hd1 p-0 mb-0 mb-lg-4"><?php echo esc_html( $excerpt_heading ); ?></h2>
                                <?php } ?>
                               <div class="btn-box-slid">
                                    <?php
                                    $online_education_classes_banner_button_link = get_theme_mod( 'online_education_classes_banner_button_link'.$i, '' );
                                        if ( ! empty( $online_education_classes_banner_button_link ) ) { ?>
                                        <a class="btn-slid btn" href="<?php echo esc_url( $online_education_classes_banner_button_link ); ?>"><?php echo esc_html('Learn More','online-education-classes'); ?></a>
                                    <?php } ?>                                 
                                </div>
                            </div>    
                        </div>
                    <?php } } ?>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action( 'online_education_classes_action_home_banner', 'online_education_classes_home_banner_section' );


/**
 * Home experiences Section
 */
if (! function_exists( 'online_education_classes_learning_experiences_section' ) ):
    function online_education_classes_learning_experiences_section() {
        ?>
    <section id="experiences-wrap">
        <div class="container">
            <div class="inner-wrap">
                <div class="experiences-head-box">
                    <?php
                        $online_education_classes_learning_experiences_small_heading = get_theme_mod( 'online_education_classes_learning_experiences_small_heading', '' );
                        if ( ! empty( $online_education_classes_learning_experiences_small_heading ) ) { ?>
                        <h6 class="expernc-sm-hd pb-0 m-0 pt-5"><?php echo esc_html( $online_education_classes_learning_experiences_small_heading ); ?></h6>
                    <?php } ?>
                    <?php
                        $online_education_classes_learning_experiences_main_heading = get_theme_mod( 'online_education_classes_learning_experiences_main_heading', '' );
                        if ( ! empty( $online_education_classes_learning_experiences_main_heading ) ) { ?>
                        <h3 class="expernc-main-hd pt-0 m-0"><?php echo esc_html( $online_education_classes_learning_experiences_main_heading ); ?></h3>
                    <?php } ?>
                </div>
                <div class="experiences-box pt-4">
                    <div class="owl-carousel">
                        <?php $online_education_classes_learning_experiences_count = get_theme_mod("online_education_classes_learning_experiences_increase");
                        for ($i = 1; $i <= $online_education_classes_learning_experiences_count; $i++) { ?>
                            <div class="serv-detail">
                                <div class="serv-img-box">
                                    <?php
                                    $online_education_classes_learning_experiences_image = get_theme_mod( 'online_education_classes_learning_experiences_image'.$i, '' );
                                    if ( ! empty( $online_education_classes_learning_experiences_image ) ) { ?>
                                        <img src="<?php echo esc_url( $online_education_classes_learning_experiences_image ); ?>">
                                    <?php } ?>    
                                    <div class="serv-title">
                                        <?php
                                            $online_education_classes_learning_experiences_inner_heading = get_theme_mod( 'online_education_classes_learning_experiences_inner_heading'.$i, '' );
                                            if ( ! empty( $online_education_classes_learning_experiences_inner_heading ) ) { ?>
                                            <h6 class="serv-inn-hd pt-3 m-0"><?php echo esc_html( $online_education_classes_learning_experiences_inner_heading ); ?></h6>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> 
                        <?php } ?>
                    </div>
                </div>
            </div>                
        </div>
    </section>
    <?php    
    }
endif;
add_action( 'online_education_classes_action_learning_experiences', 'online_education_classes_learning_experiences_section' );

/**
 * Home page another adding Section
 */
if (! function_exists( 'online_education_classes_home_extra_section' ) ):
    function online_education_classes_home_extra_section() {
        ?>
        <div id="custom-home-extra-content" class="my-5">
            <div class="container">
              <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
              <?php endwhile; ?>
            </div>
        </div>
        <?php    
    }
endif;
add_action( 'online_education_classes_action_home_extra', 'online_education_classes_home_extra_section' );