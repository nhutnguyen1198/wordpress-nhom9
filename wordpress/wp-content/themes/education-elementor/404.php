<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package education-elementor
 */

get_header();
?>

    <!-- Page Breadcrumb Start -->
    <?php  education_elementor_breadbrumb(); ?>
    <!-- Page Breadcrumb Ends -->

	<section class="page-404">
        <div class="container">
            <div class="page-404-inner">
                <h1><?php echo esc_html__('404','education-elementor'); ?></h1>
                <h3><i class="fa fa-exclamation-triangle"></i><?php echo esc_html__( 'Oops! Page Not Found', 'education-elementor' ); ?></h3>
                <p><?php echo esc_html__( 'Sorry but the page you are looking for is not found. Please make sure you have typed the correct URL.', 'education-elementor' ); ?></p>
                <div class="btn-group">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php echo esc_html__( 'Back To Home','education-elementor'); ?> 
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();