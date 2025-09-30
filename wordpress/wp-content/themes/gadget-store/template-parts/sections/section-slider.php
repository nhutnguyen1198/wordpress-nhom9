<?php 
  $gadget_store_slider = get_theme_mod('gadget_store_slider_setting','1');
  
  if($gadget_store_slider == '1') {
?>
<section id="slider-section" class="slider-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-12 mb-3">
        <div id="owl-carousel" class="owl-carousel owl-theme">
            <?php

            $gadget_store_pages = array();
            for ($gadget_store_count = 1; $gadget_store_count <= 3; $gadget_store_count++) {
                $gadget_store_mod = intval(get_theme_mod('gadget_store_slider' . $gadget_store_count));
                if ('page-none-selected' != $gadget_store_mod) {
                    $gadget_store_pages[] = $gadget_store_mod;
                }
            }
            if (!empty($gadget_store_pages)) :
                $gadget_store_args = array(
                    'post_type' => 'page',
                    'post__in' => $gadget_store_pages,
                    'orderby' => 'post__in'
                );
                $query = new WP_Query($gadget_store_args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
            ?>
            <div class="item">
                <?php if (has_post_thumbnail()) { ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" />
                <?php } else { ?>
                    <div class="slider-color-box"></div>
                <?php } ?>
                <div class="carousel-caption">
                    <div class="inner_carousel">
                        <h2><?php the_title(); ?></h2>
                        <div class="slider-border">
                          <p class="slider-saletext my-2 ms-3"><?php
                          $gadget_store_slider_text = esc_html(get_theme_mod('gadget_store_slider_text'));
                          $gadget_store_words = explode(' ', $gadget_store_slider_text);
                          $gadget_store_total_words = count($gadget_store_words);
                          $gadget_store_last_two_words = array_slice($gadget_store_words, -2); // Get the last two words

                          // Output all words with the last two words wrapped in a span with a class
                          foreach ($gadget_store_words as $gadget_store_key => $gadget_store_word) {
                              if ($gadget_store_key >= $gadget_store_total_words - 2) {
                                  // If it's one of the last two words, add it to the HTML output without space
                                  echo '<span class="red-bg">' . $gadget_store_word . '</span>';
                              } else {
                                  // Otherwise, just append the word to the HTML output with a space
                                  echo $gadget_store_word . ' ';
                              }
                          }
                          ?></p>
                          <p class="ms-3"><?php echo esc_html(wp_trim_words(get_the_content(), '15')); ?></p>
                        </div>
                        <div class="read-btn">
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html('Shop Now', 'gadget-store'); ?><i class="fas fa-arrow-right ps-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                else :
            ?>
            <div class="no-postfound"></div>
            <?php endif;
            endif; ?>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-12">
        <div class="slider-post-box1 mb-3 mb-md-0">
          <?php 
          $gadget_store_pages = array();
          $gadget_store_mod = get_theme_mod('gadget_store_slide_post1');
          if (!empty($gadget_store_mod) && $gadget_store_mod !== 'page-none-selected') {
              $gadget_store_pages[] = intval($gadget_store_mod);
          }
          if (empty($gadget_store_pages)) {
              $gadget_store_page = get_page_id_by_slug('slider-pageone');
              if ($gadget_store_page > 0) {
                  $gadget_store_pages[] = $gadget_store_page;
              }
          }

          if (!empty($gadget_store_pages)) :
            $gadget_store_args = array(
              'post_type' => 'page',
              'post__in' => $gadget_store_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query($gadget_store_args);
            if ($query->have_posts()) :
              while ($query->have_posts()) : $query->the_post(); ?>
                <div class="slider-post mb-3">
                  <?php if (has_post_thumbnail()) { ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                  <?php } else { ?>
                    <div class="slider-color-box"></div>
                  <?php } ?>
                  <div class="slider-post-content">
                    <?php $gadget_store_banner_top = get_theme_mod('gadget_store_banner_top'); ?>
                    <p class="banner-top text-capitalize"><?php echo esc_html($gadget_store_banner_top); ?></p>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_content(), 8)); ?></p>
                    <a href="<?php the_permalink(); ?>">
                      <?php esc_html_e('Shop Now', 'gadget-store'); ?>
                      <i class="fas fa-arrow-right ps-2"></i>
                    </a>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            else : ?>
              <div class="no-postfound"></div>
            <?php endif;
          endif; ?>
        </div>
        <!-- slider post 2 -->
        <div class="slider-post-box2">
          <?php 
          $gadget_store_pages = array();
          $gadget_store_mod = get_theme_mod('gadget_store_slide_post2');
          if (!empty($gadget_store_mod) && $gadget_store_mod !== 'page-none-selected') {
              $gadget_store_pages[] = intval($gadget_store_mod);
          }
          if (empty($gadget_store_pages)) {
              $gadget_store_page = get_page_id_by_slug('slider-pagetwo');
              if ($gadget_store_page > 0) {
                  $gadget_store_pages[] = $gadget_store_page;
              }
          }

          if (!empty($gadget_store_pages)) :
            $gadget_store_args = array(
              'post_type' => 'page',
              'post__in' => $gadget_store_pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query($gadget_store_args);
            if ($query->have_posts()) :
              while ($query->have_posts()) : $query->the_post(); ?>
                <div class="slider-post">
                  <?php if (has_post_thumbnail()) { ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                  <?php } else { ?>
                    <div class="slider-color-box"></div>
                  <?php } ?>
                  <div class="slider-post-content">
                    <?php $gadget_store_banner_top = get_theme_mod('gadget_store_banner_top'); ?>
                    <p class="banner-top text-uppercase"><?php echo esc_html($gadget_store_banner_top); ?></p>
                    <h3><?php the_title(); ?></h3>
                    <a href="<?php the_permalink(); ?>">
                      <?php esc_html_e('Shop Now', 'gadget-store'); ?>
                      <i class="fas fa-arrow-right ps-2"></i>
                    </a>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            else : ?>
              <div class="no-postfound"></div>
            <?php endif;
          endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>