</div>
<?php
    $gadget_shop_footer_bg_color = get_theme_mod('gadget_store_footer_bg_color');
    $gadget_shop_footer_bg_image = get_theme_mod('gadget_store_footer_bg_image');
    $gadget_shop_footer_opacity = get_theme_mod('gadget_store_footer_bg_image_opacity', 50);
    $gadget_shop_opacity_decimal = $gadget_shop_footer_opacity / 100;

    // Compose inline styles for footer background
    $gadget_shop_footer_styles = 'background-color: ' . esc_attr($gadget_shop_footer_bg_color) . ';';
    if ($gadget_shop_footer_bg_image) {
        $gadget_shop_footer_styles .= ' background-image: linear-gradient(rgba(0,0,0,' . (1 - $gadget_shop_opacity_decimal) . '), rgba(0,0,0,' . (1 - $gadget_shop_opacity_decimal) . ')), url(' . esc_url($gadget_shop_footer_bg_image) . ');';
    }
?>
<footer class="footer-area" style="<?php echo esc_attr($gadget_shop_footer_styles); ?>">  
	<div class="container"> 
		<?php 
		$gadget_shop_footer_widgets_setting = get_theme_mod('gadget_store_footer_widgets_setting', '1');

		do_action('gadget_shop_footer_above'); 
		
		if ($gadget_shop_footer_widgets_setting != '') { 
			if (is_active_sidebar('gadget-store-footer-widget-area')) { ?>
				<div class="row footer-row"> 
					<?php dynamic_sidebar('gadget-store-footer-widget-area'); ?>
				</div>  
			<?php 
			} else { ?>
				<div class="row footer-row">
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="search-3" class="widget widget_search default_footer_search">
							<h2 class="widget-title w-title"><?php esc_html_e('Search', 'gadget-shop'); ?></h2>
							<?php get_search_form(); ?>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="archives-2" class="widget widget_archive">
							<h2 class="widget-title w-title"><?php esc_html_e('Recent Posts', 'gadget-shop'); ?></h2>
							<ul>
								<?php
								wp_get_archives(array(
									'type' => 'postbypost',
									'format' => 'html',
									'limit' => 5,
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="pages-2" class="widget widget_pages">
							<h2 class="widget-title w-title"><?php esc_html_e('Pages', 'gadget-shop'); ?></h2>
							<ul>
								<?php
								wp_list_pages(array(
									'title_li' => '',
									'number'  => 5,
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="categories-2" class="widget widget_categories">
							<h2 class="widget-title w-title"><?php esc_html_e('Categories', 'gadget-shop'); ?></h2>
							<ul>
								<?php
								wp_list_categories(array(
									'title_li' => '',
									'number'  => 5,
								));
								?>
							</ul>
						</aside>
					</div>
				</div>
			<?php } 
		} ?>
	</div>

	<?php 
		$gadget_store_footer_copyright = get_theme_mod('gadget_store_footer_copyright','');
	?>
	<?php $gadget_store_footer_copyright_setting = get_theme_mod('gadget_store_footer_copyright_setting','1');
	 if( $gadget_store_footer_copyright_setting != ''){?>
		<div class="copy-right"> 
			<div class="container">
				<p class="copyright-text">	
					<?php
						echo esc_html( apply_filters('gadget_shop_footer_copyright',($gadget_store_footer_copyright)));
				    ?>
					<?php if ( empty($gadget_store_footer_copyright) ) { ?>
					    <?php
					        echo esc_html__( 'Copyright &copy; 2025,', 'gadget-shop' );
					    ?>
					    <a href="<?php echo esc_url('https://www.seothemesexpert.com/products/free-gadget-wordpress-theme'); ?>" target="_blank">
					        <?php
					            echo esc_html__( 'Gadget Shop', 'gadget-shop' );
					        ?>
					    </a>
					    <span> | </span>
					    <a href="https://wordpress.org/" target="_blank">
					        <?php
					            echo esc_html__( 'WordPress Theme', 'gadget-shop' );
					        ?>
					    </a>
					<?php } ?>
				</p>
			</div>
		</div>
	<?php } ?>
	<?php $gadget_store_scroll_top = get_theme_mod('gadget_store_scroll_top_setting','1');
      if($gadget_store_scroll_top == '1') { ?>
		<a id="scrolltop"><span><?php esc_html_e('TOP','gadget-shop'); ?><span></a>
	<?php } ?>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>