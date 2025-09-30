<?php

/**
 * Welcome Notice class.
 */
class Online_Education_Classes_Welcome_Notice {

	/**
	** Constructor.
	*/
	public function __construct() {
		// Render Notice
		add_action( 'admin_notices', [$this, 'online_education_classes_render_notice'] );

		// Enque AJAX Script
		add_action( 'admin_enqueue_scripts', [$this, 'online_education_classes_admin_enqueue_scripts'], 5 );

		// Dismiss
		add_action( 'admin_enqueue_scripts', [$this, 'online_education_classes_notice_enqueue_scripts'], 5 );
		add_action( 'wp_ajax_online_education_classes_dismissed_handler', [$this, 'online_education_classes_dismissed_handler'] );

		// Reset
		add_action( 'switch_theme', [$this, 'online_education_classes_reset_notices'] );
		add_action( 'after_switch_theme', [$this, 'online_education_classes_reset_notices'] );

	}

	/**
	** Render Notice
	*/
	public function online_education_classes_render_notice() {
		global $pagenow;

		$online_education_classes_screen = get_current_screen();

		if ($online_education_classes_screen && $online_education_classes_screen->id !== 'appearance_page_online-education-classes-theme-info') {
		
			$online_education_classes_transient_name = sprintf( '%s_activation_notice', get_template() );

			if ( ! get_transient( $online_education_classes_transient_name ) ) {
				?>
				<div class="online-education-classes-notice notice notice-info is-dismissible" data-notice="<?php echo esc_attr( $online_education_classes_transient_name ); ?>">
					<button type="button" class="notice-dismiss"></button>

					<?php $this->online_education_classes_render_notice_content(); ?>
				</div>
				<?php
			}
		}
	}

	/**
	** Render Notice Content
	*/
	public function online_education_classes_render_notice_content() {
		$online_education_classes_action = 'install-activate';
		$online_education_classes_redirect_url = 'admin.php?page=online-education-classes-theme-info';
		$online_education_classes_demo_redirect_url = 'themes.php?page=online-education-classes-demo';
		
		$online_education_classes_screen = get_current_screen();

		?>
		<div class="notice-left-icon-box">
			<span class="dashicons dashicons-welcome-learn-more notc-theme-icon"></span>
		</div>
		<div class="welcome-message">
			<div class="notc-contnt">
				<h4><?php esc_html_e('Thank you for installing Legacy Themes!', 'online-education-classes'); ?></h4>
				<h1><?php esc_html_e('Welcome to Online Education Classes WordPress Theme!', 'online-education-classes'); ?></h1>
				<p><?php esc_html_e( 'Our WordPress themes are modern, minimalist, fully responsive, SEO-friendly, and packed with features—perfect for designers, bloggers, and creative professionals across various fields.', 'online-education-classes' );?>
				</p>			
				<div class="action-buttons">
					<a href="<?php echo esc_url(admin_url($online_education_classes_redirect_url)); ?>" class="button notice-btn button-hero" data-action="<?php echo esc_attr($online_education_classes_action); ?>">
						<span class="notc-btn-txt"><?php echo esc_html__( 'Get Started with Online Education Classes', 'online-education-classes' ); ?></span>
					</a>
					<a href="<?php echo esc_url(admin_url($online_education_classes_demo_redirect_url)); ?>" class="demo-btn btn" >
						<span class="demo-btn-txt"><?php echo esc_html__( 'Demo Import', 'online-education-classes' ); ?></span>
					</a>
				</div>
			</div>			
		</div>
		<div class="notice-right-img-box">
			<img class="notc-right-img" src="<?php echo esc_url( get_template_directory_uri() . '/inc/activation-notice/img/notice-right.png' ); ?>" alt="<?php esc_attr_e( 'notice themes img', 'online-education-classes' ); ?>" />
		</div>

		<?php
	}

	/**
	** Reset Notice.
	*/
	public function online_education_classes_reset_notices() {
		delete_transient( sprintf( '%s_activation_notice', get_template() ) );
	}

	/**
	** Dismissed handler
	*/
	public function online_education_classes_dismissed_handler() {
		wp_verify_nonce( null );

		if ( isset( $_POST['notice'] ) ) {
			set_transient( sanitize_text_field( wp_unslash( $_POST['notice'] ) ), true, 0 );
		}
	}

	/**
	** Notice Enqunue Scripts
	*/
	public function online_education_classes_notice_enqueue_scripts( $page ) {
		
		wp_enqueue_script( 'jquery' );

		ob_start();
		?>
		<script>
			jQuery(function($) {
				$( document ).on( 'click', '.online-education-classes-notice .notice-dismiss', function () {
					jQuery.post( 'ajax_url', {
						action: 'online_education_classes_dismissed_handler',
						notice: $( this ).closest( '.online-education-classes-notice' ).data( 'notice' ),
					});
					$( '.online-education-classes-notice' ).hide();
				} );
			});
		</script>
		<?php
		$script = str_replace( 'ajax_url', admin_url( 'admin-ajax.php' ), ob_get_clean() );

		wp_add_inline_script( 'jquery', str_replace( ['<script>', '</script>'], '', $script ) );
	}

	/**
	** Register scripts and styles for welcome notice.
	*/
	public function online_education_classes_admin_enqueue_scripts( $page ) {
		// Enqueue Styles.
		wp_enqueue_style( 'online-education-classes-welcome-notic-css', get_template_directory_uri() . '/inc/activation-notice/css/notice-bar.css' );
	}

}

new Online_Education_Classes_Welcome_Notice();