<?php
/**
 * The template for displaying all single posts.
 *
 * @package Online Education Classes
 */

get_header();
online_education_classes_before_title();
if (true === get_theme_mod('online_education_classes_enable_page_title', true)) :
    do_action('online_education_classes_get_page_title');
endif;
online_education_classes_after_title();

$online_education_classes_prevarticle = esc_html(get_theme_mod( 'online_education_classes_single_post_previous_article_text', esc_html__('Previous Article','online-education-classes')));
$online_education_classes_nextarticle = esc_html(get_theme_mod( 'online_education_classes_single_post_next_article_text', esc_html__('Next Article','online-education-classes')));

?>
<div class="content-section img-overlay"></div>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="content-inner">
			<div id="blog-section">
				<div class="container">
			        <div class="row">
			        	<?php
			        		if('right'===esc_html(get_theme_mod('online_education_classes_blog_single_sidebar_layout','right'))) {
			        			?>			        				
        							<div id="post-wrapper" class="col-md-8">
										<?php
											while ( have_posts() ) : the_post();

												get_template_part( 'template-parts/post/content', 'single');

												the_post_navigation(
												    array(
												        'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="bi bi-arrow-left-circle"></i>'. $online_education_classes_prevarticle .'</span> ' .
																		'<span class="screen-reader-text"> '. $online_education_classes_prevarticle .' </span> ' .
																		'<h5 class="post-title">%title</h5>',
												        'next_text' => '<span class="meta-nav" aria-hidden="true">'. $online_education_classes_nextarticle .'</span> ' .
																		'<span class="screen-reader-text">'. $online_education_classes_nextarticle .'</span> <i class="bi bi-arrow-right-circle"></i> ' .
																		'<h5 class="post-title">%title</h5>',
												        'screen_reader_text' => esc_html__('Posts navigation', 'online-education-classes')
												    )
												);

												// If comments are open or we have at least one comment, load up the comment template.
												if ( comments_open() || get_comments_number() ) :
													comments_template();
												endif;

											endwhile; // End of the loop.
										?>							
									</div>
									<div id="sidebar-wrapper" class="col-md-4">
										<?php get_sidebar(); ?>
									</div>
			        			<?php
			        		}
			        		else if('left'===esc_html(get_theme_mod('online_education_classes_blog_single_sidebar_layout','right'))) {
			        			?>
        							<div id="sidebar-wrapper" class="col-md-4">
										<?php get_sidebar(); ?>
									</div>
			        				<div id="post-wrapper" class="col-md-8">
										<?php
											while ( have_posts() ) : the_post();

												get_template_part( 'template-parts/post/content', 'single');

												the_post_navigation(
												    array(
												        'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="bi bi-arrow-left-circle"></i>'. $online_education_classes_prevarticle .'</span> ' .
																		'<span class="screen-reader-text"> '. $online_education_classes_prevarticle .' </span> ' .
																		'<h5 class="post-title">%title</h5>',
												        'next_text' => '<span class="meta-nav" aria-hidden="true">'. $online_education_classes_nextarticle .'</span> ' .
																		'<span class="screen-reader-text">'. $online_education_classes_nextarticle .'</span><i class="bi bi-arrow-right-circle"></i> ' .
																		'<h5 class="post-title">%title</h5>',
												        'screen_reader_text' => esc_html__('Posts navigation', 'online-education-classes')
												    )
												);

												// If comments are open or we have at least one comment, load up the comment template.
												if ( comments_open() || get_comments_number() ) :
													comments_template();
												endif;

											endwhile; // End of the loop.
										?>							
									</div>
			        			<?php
			        		}
			        		else {
			        			?>
									<div class="col-md-12">
										<?php
											while ( have_posts() ) : the_post();

												get_template_part( 'template-parts/post/content', 'single');

												the_post_navigation(
												    array(
												        'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="bi bi-arrow-left-circle"></i>'. $online_education_classes_prevarticle .'</span> ' .
																		'<span class="screen-reader-text"> '. $online_education_classes_prevarticle .' </span> ' .
																		'<h5 class="post-title">%title</h5>',
												        'next_text' => '<span class="meta-nav" aria-hidden="true">'. $online_education_classes_nextarticle .'</span> ' .
																		'<span class="screen-reader-text">'. $online_education_classes_nextarticle .'</span><i class="bi bi-arrow-right-circle"></i> ' .
																		'<h5 class="post-title">%title</h5>',
												        'screen_reader_text' => esc_html__('Posts navigation', 'online-education-classes')
												    )
												);
												
												// If comments are open or we have at least one comment, load up the comment template.
												if ( comments_open() || get_comments_number() ) :
													comments_template();
												endif;

											endwhile; // End of the loop.
										?>
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
