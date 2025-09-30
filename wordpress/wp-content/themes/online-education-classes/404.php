<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Online Education Classes
 */

get_header();
online_education_classes_before_title();
if (true === get_theme_mod('online_education_classes_enable_page_title', true)) :
    do_action('online_education_classes_get_page_title');
endif;
online_education_classes_after_title();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="content-page">
			<div class="content-inner">
				<div class="container">
					<div class="row">
						<?php
							if('right'===esc_html(get_theme_mod('online_education_classes_blog_sidebar','right'))) {
								?>
									<div id="post-wrapper" class="col-md-8">
										<div class="page-content-area">	
											<h1 class="page-error"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'online-education-classes' ); ?></h1>
											<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'online-education-classes' ); ?></p>
											<?php get_search_form(); ?>
										</div>
									</div>
									<div id="sidebar-wrapper" class="col-md-4">
										<?php get_sidebar('primary-sidebar'); ?>
									</div>
								<?php
							}
							else if('left'===esc_html(get_theme_mod('online_education_classes_blog_sidebar','right'))) {
								?>
									<div id="sidebar-wrapper" class="col-md-4">
										<?php get_sidebar('primary-sidebar'); ?>
									</div>
									<div id="post-wrapper" class="col-md-8">
										<div class="page-content-area">	
											<h1 class="page-error"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'online-education-classes' ); ?></h1>
											<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'online-education-classes' ); ?></p>
											<?php get_search_form(); ?>
										</div>
									</div>
									
								<?php
							}
							else{
								?>
									<div class="col-md-12">
										<div class="page-content-area">	
											<h1 class="page-error"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'online-education-classes' ); ?></h1>
											<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'online-education-classes' ); ?></p>
											<?php get_search_form(); ?>
										</div>
									</div>
								<?php
							}
						?>			
					</div>
				</div>
			</div>
		</div>
	</main>
</div>

<?php
get_footer();