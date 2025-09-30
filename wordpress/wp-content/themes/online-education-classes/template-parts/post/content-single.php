<?php
/**
 * Template part for displaying posts in a single post.
 *
 * @package Online Education Classes
 */
?>
 <article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <div class="blog-post">
        <div class="image">
            <?php
                if(has_post_thumbnail()) {
                    the_post_thumbnail('full');
                }
            ?>
        </div>
        <div class="content">
             <?php
                if(get_theme_mod('online_education_classes_enable_single_post_meta_author',true) || get_theme_mod('online_education_classes_enable_single_post_meta_date',true) || get_theme_mod('online_education_classes_enable_single_post_meta_comments',true)) {
                    ?>
                        <div class="meta">
                            <?php
                                if(true===get_theme_mod('online_education_classes_enable_single_post_meta_author',true)) :
                                    ?>
                                        <span class="meta-item author"><i class="bi bi-person"></i> <a class="author-post-url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
                                        </span>
                                    <?php
                                endif;

                                if(true===get_theme_mod('online_education_classes_enable_single_post_meta_date',true)) :
                                    ?>
                                        <span class="meta-item date"><i class="bi bi-calendar-check"></i> <?php the_time(get_option('date_format')) ?>
                                        </span>
                                    <?php
                                endif;

                                if(true===get_theme_mod('online_education_classes_enable_single_post_meta_comments',true)) :
                                    ?>
                                    <span class="meta-item comments"><i class="bi bi-chat-dots"></i> <a class="post-comments-url" href="<?php the_permalink() ?>#comments"><?php comments_number('0','1','%'); ?></a>
                                        </span>
                                    <?php
                                endif; 
                            ?>
                        </div>
                    <?php   
                }
            ?>             
            <div class="title">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            </div>  
            <?php
                the_content();
                wp_link_pages(array(
                    'before'       => '<div class="page-link">' . esc_html__('pages','online-education-classes'),
                    'after'        => '</div>',
                    'link_before'  => '<span>',
                    'link_after'   => '</span>',
                ));
            ?>
            <?php
                if(has_tag() && get_theme_mod('online_education_classes_enable_single_post_tags',true) ){
                    ?>
                        <div class="post-tags">
                            <i class="bi bi-tags"></i> <?php the_tags(); ?>
                        </div>
                    <?php
                }
            ?>
            <div class="clearfix"></div>
            <?php
                if(true===get_theme_mod('online_education_classes_enable_single_post_cat',true)) {
                    ?>
                        <div class="post-categories">
                            <?php $online_education_classes_cat = esc_html(get_theme_mod('online_education_classes_single_post_category_text',esc_html__('Category:','online-education-classes')));?>
                            <span><i class="bi bi-folder"></i> <?php echo $online_education_classes_cat ?></span>&nbsp;<?php the_category(); ?>
                        </div>  
                    <?php   
                }
            ?>
           
        </div>
    </div>
 </article>
 <?php esc_html(online_education_classes_single_post_after_content($post->ID)); ?>
