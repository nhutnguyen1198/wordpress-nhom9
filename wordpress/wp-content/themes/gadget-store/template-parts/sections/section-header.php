<header class="main-header">
	<?php 
	  $gadget_store_header = get_theme_mod('gadget_store_header_setting','1');
	  
	  if($gadget_store_header == '1') {
	?>
  <div class="upper-header-area">
  	<div class="container">
    	<?php
				$gadget_store_social_media_facebook = get_theme_mod('gadget_store_social_media_facebook','#');
				$gadget_store_social_media_twitter = get_theme_mod('gadget_store_social_media_twitter','#');
				$gadget_store_social_media_instagram = get_theme_mod('gadget_store_social_media_instagram','#');
				$gadget_store_social_media_linkedin = get_theme_mod('gadget_store_social_media_linkedin','#');
				$gadget_store_social_media_youtube = get_theme_mod('gadget_store_social_media_youtube','#');

				$gadget_store_topheader_text = get_theme_mod( 'gadget_store_topheader_text','Welcome to Worldwide Ecommerce Store' );

				$gadget_store_topheader_about_text = get_theme_mod( 'gadget_store_topheader_about_text','About Us' );
				$gadget_store_topheader_about_link = get_theme_mod( 'gadget_store_topheader_about_link','#' );

				$gadget_store_topheader_order_text = get_theme_mod( 'gadget_store_topheader_order_text','Order Tracking' );
				$gadget_store_topheader_order_link = get_theme_mod( 'gadget_store_topheader_order_link','#' );

				$gadget_store_notification = get_theme_mod( 'gadget_store_notification','#' );
				$gadget_store_like_option = get_theme_mod( 'gadget_store_like_option','#' );

			?>
			<div class="row">
				<div class="col-xl-5 col-lg-5 col-md-5 text-md-start text-center align-self-center">
					<?php if( $gadget_store_topheader_text != ''){?>
            <p class="mb-0 offer-text"><?php echo esc_html( apply_filters('gadget_store_topheader', $gadget_store_topheader_text)); ?></p>
          <?php } ?>
        </div>
        <div class="col-xl-5 col-lg-4 col-md-5 text-md-end text-center align-self-center">
        	<?php if( $gadget_store_topheader_about_text != '' || $gadget_store_topheader_about_link != '' ){?>
						<a class="me-3" href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_topheader_about_link)); ?>"><i class="fas fa-info-circle me-2"></i><?php echo esc_html( apply_filters('gadget_store_topheader', $gadget_store_topheader_about_text)); ?></a>
					<?php }?>
					<?php if( $gadget_store_topheader_order_text != '' || $gadget_store_topheader_order_link != '' ){?>
						<a href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_topheader_order_link)); ?>"><i class="fas fa-truck me-2"></i><?php echo esc_html( apply_filters('gadget_store_topheader', $gadget_store_topheader_order_text)); ?></a>
					<?php }?>
        </div>
				<div class="col-xl-2 col-lg-3 col-md-2 text-md-end text-center align-self-center">
					<?php if( $gadget_store_social_media_facebook != ''){?>
						<a class="me-3" href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_social_media_facebook)); ?>"><i class="fab fa-facebook-f"></i></a>
					<?php }?>
					<?php if( $gadget_store_social_media_twitter != ''){?>
						<a class="me-3" href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_social_media_twitter)); ?>"><i class="fab fa-twitter"></i></a>
					<?php }?>
					<?php if( $gadget_store_social_media_instagram != ''){?>
						<a class="me-3" href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_social_media_instagram)); ?>"><i class="fab fa-instagram"></i></a>
					<?php }?>
					<?php if( $gadget_store_social_media_linkedin != ''){?>
						<a class="me-3" href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_social_media_linkedin)); ?>"><i class="fab fa-linkedin-in"></i></a>
					<?php }?>
					<?php if( $gadget_store_social_media_youtube != ''){?>
						<a href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_social_media_youtube)); ?>"><i class="fab fa-youtube"></i></a>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<div class="center-header-area py-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-6 align-self-center">
					<div class="logo">
						<?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            // Check if both title and tagline settings are disabled
                            $gadget_store_tagline_enabled = get_theme_mod('gadget_store_tagline_setting', false);
                            $gadget_store_title_enabled = get_theme_mod('gadget_store_site_title_setting', false);

                            if (!$gadget_store_tagline_enabled && !$gadget_store_title_enabled) {
                                // Display the default logo
                                $gadget_store_default_logo_url = get_template_directory_uri() . '/assets/images/logo.png'; // Replace with your default logo path
                                echo '<a href="' . esc_url(home_url('/')) . '">';
                                echo '<img src="' . esc_url($gadget_store_default_logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                                echo '</a>';
                            }

                            // Display tagline if the setting is enabled
                            if ($gadget_store_tagline_enabled) :
                                $gadget_store_site_desc = get_bloginfo('description'); ?>
                                <p class="site-description"><?php echo esc_html($gadget_store_site_desc); ?></p>
                            <?php endif; ?>

                            <?php
                            // Display site title if the setting is enabled
                            if ($gadget_store_title_enabled) : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>">
                                        <?php echo esc_html(get_bloginfo('name')); ?>
                                    </a>
                                </p>
                            <?php endif; ?>
                        <?php } ?>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 align-self-center category-box">
        	<?php if(class_exists('woocommerce')){ ?>
	          <button class="category-btn"><i class="fa fa-bars me-2" aria-hidden="true"></i><?php echo esc_html('All Categories','gadget-store'); ?></button>
	          <div class="category-dropdown">
	            <?php
	              $args = array(
	                'number'     => 30,
	                'orderby'    => 'title',
	                'order'      => 'ASC',
	                'hide_empty' => 0,
	                'parent'  => 0
	              );
	              $gadget_store_product_categories = get_terms( 'product_cat', $args );
	              $count = count($gadget_store_product_categories);
	              if ( $count > 0 ){
	                foreach ( $gadget_store_product_categories as $gadget_store_product_category ) {
	                  $gadget_store_cat_id   = $gadget_store_product_category->term_id;
	                  $cat_link = get_category_link( $gadget_store_cat_id );
	                  if ($gadget_store_product_category->category_parent == 0) { ?>
	                <ul><li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $gadget_store_product_category ) ); ?>">
	                <?php
	              }
	                echo esc_html( $gadget_store_product_category->name ); ?></a></li></ul>
	                <?php
	                }
	              }
	            ?>
	          </div>
        	<?php }?>
      	</div>
	      <div class="col-lg-5 col-md-6 align-self-center">
          <div class="search_inner">
            <?php if(class_exists('woocommerce')){ ?>
              <?php get_product_search_form(); ?>
            <?php }?>
          </div>
	      </div>
	      <div class="col-lg-3 col-md-6 align-self-center">
	        <div class="header-details">
            <p class="mb-0">
              <?php if(class_exists('woocommerce')){ ?>
                <?php if (is_user_logged_in()) : ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="fas fa-sign-out-alt"></i><?php esc_html_e( 'Logout', 'gadget-store' ); ?></a>
                <?php else : ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><i class="far fa-user"></i><?php esc_html_e( 'User', 'gadget-store' ); ?></a>
                <?php endif;?>
              <?php } ?>
            </p>
            <?php if( $gadget_store_notification != ''){?>
	            <p class="mb-0"><a href="<?php echo esc_url( apply_filters('gadget_store_topheader', $gadget_store_notification)); ?>"><i class="fas fa-comment-alt"></i> <?php esc_html_e( 'Notification', 'gadget-store' ); ?></a></p>
	          <?php }?>
	          	<?php if ( ! empty( $expert_dental_specialist_like_option ) ) : ?>
				    <p class="mb-0">
				        <a href="<?php echo esc_url( $expert_dental_specialist_like_option ); ?>">
				            <i class="far fa-heart me-3"></i><?php esc_html_e( 'Like', 'gadget-store' ); ?>
				        </a>
				    </p>
				<?php endif; ?>

				<?php if ( class_exists( 'YITH_WCWL' ) ) : ?>
				    <p class="mb-0">
				        <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
				            <i class="far fa-heart"></i><?php esc_html_e( 'Like', 'gadget-store' ); ?>
				        </a>
				    </p>
				<?php endif; ?>

            <p class="mb-0">
              <?php if(class_exists('woocommerce')){ ?>
              	<a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><i class="fas fa-shopping-basket"></i><?php esc_html_e( 'Cart', 'gadget-store' ); ?></a>
              <?php } ?>
            </p>
	        </div>
	      </div>
			</div>
		</div>
	</div>
	<div class="main-text-header <?php if( get_theme_mod( 'gadget_store_sticky_header', '0')) { ?>sticky-header<?php } else { ?>close-sticky<?php } ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-6 align-self-center">
					<div class="lower-header-area">
						<div class="container">
							<div class="navbar-menubar responsive-menu navigation_header">
								<div class="toggle-nav mobile-menu">
									<button onclick="gadget_store_openNav()">
										<i class="fa fa-bars"></i> <!-- Initial hamburger icon -->
									</button>
								</div>
								<div id="mySidenav" class="nav sidenav">
									<nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'gadget-store' ); ?>">

										<?php 
											wp_nav_menu(
												array(
													'theme_location' => 'primary',
													'container_class' => 'main-menu clearfix',
													'menu_class' => 'clearfix menu',
													'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
													'fallback_cb' => 'wp_page_menu',
												)
											);
										?>
										<a href="javascript:void(0)" class="closebtn mobile-menu" onclick="gadget_store_closeNav()">
											<i class="fa fa-times"></i> <!-- Close icon for the menu -->
										</a>
									</nav>
								</div>
							</div>
				    	</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 menu-right">
					<span class="translate-btn d-flex me-lg-4 me-md-2 me-0">
		              <?php if (get_theme_mod('gadget_store_cart_language_translator', false) && class_exists('GTranslate')) : ?>
		                  <div class="translate-lang position-relative d-md-inline-block me-3">
		                      <?php echo wp_kses_post(do_shortcode('[gtranslate]')); ?>
		                  </div>
		              <?php endif; ?>
		            </span>
	            	<span class="globe-icon mb-md-0">
					  <?php
					  // Get the globe icon link from theme mod
					  $gadget_store_globe_icon_link = get_theme_mod( 'gadget_store_interactive_globe_symbol' );

					  // Only display if the link is not empty
					  if ( ! empty( $gadget_store_globe_icon_link ) ) : ?>
					    <span class="ship-to-text">
					      <?php esc_html_e( 'Ship To', 'gadget-store' ); ?>:
					    </span>
					    <a class="viewall-btn"
					       href="<?php echo esc_url( $gadget_store_globe_icon_link ); ?>"
					       aria-label="<?php echo esc_attr__( 'Interactive Globe Link', 'gadget-store' ); ?>">
					      <i class="fas fa-globe ms-2"></i>
					    </a>
					  <?php endif; ?>
					</span>
				</div>
			</div>
		</div>
  	</div>
</header>