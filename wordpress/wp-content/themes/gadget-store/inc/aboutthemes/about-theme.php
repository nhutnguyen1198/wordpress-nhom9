<?php
/**
 * Theme Page
 *
 * @package Gadget Store
 */

if ( ! defined( 'GADGET_STORE_FREE_THEME_URL' ) ) {
	define( 'GADGET_STORE_FREE_THEME_URL', 'https://www.seothemesexpert.com/products/free-gadget-wordpress-theme' );
}
if ( ! defined( 'GADGET_STORE_PRO_THEME_URL' ) ) {
	define( 'GADGET_STORE_PRO_THEME_URL', 'https://www.seothemesexpert.com/products/gadget-website-template' );
}
if ( ! defined( 'GADGET_STORE_FREE_DOCS_THEME_URL' ) ) {
    define( 'GADGET_STORE_FREE_DOCS_THEME_URL', 'https://demo.seothemesexpert.com/documentation/gadget-store/' );
}
if ( ! defined( 'GADGET_STORE_DEMO_THEME_URL' ) ) {
	define( 'GADGET_STORE_DEMO_THEME_URL', 'https://demo.seothemesexpert.com/gadget-store-pro/' );
}
if ( ! defined( 'GADGET_STORE_RATE_THEME_URL' ) ) {
    define( 'GADGET_STORE_RATE_THEME_URL', 'https://wordpress.org/support/theme/gadget-store/reviews/#new-post' );
}
if ( ! defined( 'GADGET_STORE_SUPPORT_THEME_URL' ) ) {
    define( 'GADGET_STORE_SUPPORT_THEME_URL', 'https://wordpress.org/support/theme/gadget-store/' );
}
if ( ! defined( 'GADGET_STORE_THEME_BUNDLE_URL' ) ) {
    define( 'GADGET_STORE_THEME_BUNDLE_URL', 'https://www.seothemesexpert.com/products/wordpress-theme-bundle' );
}

/**
 * Add theme page
 */
function gadget_store_menu() {
	add_theme_page( esc_html__( 'About Theme', 'gadget-store' ), esc_html__( 'About Theme', 'gadget-store' ), 'edit_theme_options', 'gadget-store-about', 'gadget_store_about_display' );
}
add_action( 'admin_menu', 'gadget_store_menu' );

/**
 * Display About page
 */
function gadget_store_about_display() { ?>
	<div class="wrap about-wrap full-width-layout">		
		<h1 class="d-none"></h1>
		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'gadget-store' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'gadget-store-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'gadget-store-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'gadget-store' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'gadget-store-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Compare free Vs Pro', 'gadget-store' ); ?></a>
		</nav>

		<?php
			gadget_store_main_screen();

			gadget_store_free_vs_pro();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'gadget-store' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'gadget-store' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'gadget-store' ) : esc_html_e( 'Go to Dashboard', 'gadget-store' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function gadget_store_main_screen() {
	if ( isset( $_GET['page'] ) && 'gadget-store-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="main-col-box">
			<div class="feature-section two-col">
				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Upgrade To Pro', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'Take a step towards excellence, try our premium theme. Use Code', 'gadget-store' ) ?><span class="usecode"><?php esc_html_e( '" STEPRO10 "', 'gadget-store' ); ?></span></p>
					<p><a target="_blank" href="<?php echo esc_url( GADGET_STORE_PRO_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Upgrade Pro', 'gadget-store' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Lite Documentation', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'The free theme documentation can help you set up the theme.', 'gadget-store' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( GADGET_STORE_FREE_DOCS_THEME_URL ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Lite Documentation', 'gadget-store' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Theme Info', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'Know more about Gadget Store.', 'gadget-store' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( GADGET_STORE_FREE_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Theme Info', 'gadget-store' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'You can get all theme options in customizer.', 'gadget-store' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'gadget-store' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Need Support?', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'If you are having some issues with the theme or you want to tweak some thing, you can contact us our expert team will help you.', 'gadget-store' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( GADGET_STORE_SUPPORT_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Support Forum', 'gadget-store' ); ?></a></p>
				</div>

				<div class="card">
					<h2 class="title"><?php esc_html_e( 'Review', 'gadget-store' ); ?></h2>
					<p><?php esc_html_e( 'If you have loved our theme please show your support with the review.', 'gadget-store' ) ?></p>
					<p><a target="_blank" href="<?php echo esc_url( GADGET_STORE_RATE_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Rate Us', 'gadget-store' ); ?></a></p>
				</div>		
			</div>
			<div class="about-theme">
				<?php $gadget_store_theme = wp_get_theme(); ?>

				<h1><?php echo esc_html( $gadget_store_theme ); ?></h1>
				<p class="version"><?php esc_html_e( 'Version', 'gadget-store' ); ?>: <?php echo esc_html($gadget_store_theme['Version']);?></p>
				<div class="theme-description">
					<p class="actions">
						<a target="_blank" href="<?php echo esc_url( GADGET_STORE_PRO_THEME_URL ); ?>" class="protheme button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'gadget-store' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( GADGET_STORE_DEMO_THEME_URL ); ?>" class="demo button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'gadget-store' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( GADGET_STORE_THEME_BUNDLE_URL ); ?>" class="bundle button button-secondary" target="_blank"><?php esc_html_e( 'Buy All Themes', 'gadget-store' ); ?></a>

						<a target="_blank" href="<?php echo esc_url( GADGET_STORE_FREE_DOCS_THEME_URL ); ?>" class="docs button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'gadget-store' ); ?></a>
					</p>
				</div>
				<div class="theme-screenshot">
					<img src="<?php echo esc_url( $gadget_store_theme->get_screenshot() ); ?>" />
				</div>
			</div>
		</div>
	<?php
	}
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function gadget_store_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<div class="theme-description">
				<p class="actions">
					<a target="_blank" href="<?php echo esc_url( GADGET_STORE_PRO_THEME_URL ); ?>" class="protheme button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'gadget-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( GADGET_STORE_DEMO_THEME_URL ); ?>" class="demo button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'gadget-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( GADGET_STORE_THEME_BUNDLE_URL ); ?>" class="bundle button button-secondary" target="_blank"><?php esc_html_e( 'Buy All Themes', 'gadget-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( GADGET_STORE_FREE_DOCS_THEME_URL ); ?>" class="docs button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'gadget-store' ); ?></a>
				</p>
			</div>
			<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'gadget-store' ); ?></p>
			<div class="vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'gadget-store' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'gadget-store' ); ?></th>
						</tr>
					</thead>
					<tbody>
					<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'One click demo import', 'gadget-store' ); ?></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( '15+ Theme Sections', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Extensive Typography Settings & Color Pallets', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Rearrange Sections', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Fully SEO Optimized', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Expert Technical Support', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Attractive Preloader Design', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Enhanced Plugin Integration', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>	
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Custom Post Types', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'High-Level Compatibility with Modern Browsers', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Real-Time Theme Customizer', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Extensive Customization', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Easy Customization', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Regular Bug Fixes', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Responsive Design', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Multiple Blog Layouts', 'gadget-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a target="_blank" class="sidebar-button single-btn protheme button button-secondary" href="<?php echo esc_url(GADGET_STORE_PRO_THEME_URL);?>"><?php esc_html_e( 'Go for Premium', 'gadget-store' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}
