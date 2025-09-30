<?php

/**
 * Wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $gadget_store_theme_name = '';
	protected $gadget_store_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $gadget_store_page_slug = '';
	protected $gadget_store_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $gadget_store_plugin_url = '';

	public $gadget_store_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['gadget_store_page_slug'] ) ) {
			$this->gadget_store_page_slug = esc_attr( $config['gadget_store_page_slug'] );
		}
		if( isset( $config['gadget_store_page_title'] ) ) {
			$this->gadget_store_page_title = esc_attr( $config['gadget_store_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->gadget_store_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->gadget_store_plugin_path );
		$this->gadget_store_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$gadget_store_current_theme = wp_get_theme();
		$this->gadget_store_theme_title = $gadget_store_current_theme->get( 'Name' );
		$this->gadget_store_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $gadget_store_current_theme->get( 'Name' ) ) );
		$this->gadget_store_page_slug = apply_filters( $this->gadget_store_theme_name . '_theme_setup_wizard_gadget_store_page_slug', $this->gadget_store_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->gadget_store_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'gadget-store-demo-import-style', get_template_directory_uri() . '/demo-import/assets/css/demo-import-style.css');
		wp_register_script( 'gadget-store-demo-import-script', get_template_directory_uri() . '/demo-import/assets/js/demo-import-script.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'gadget-store-demo-import-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'gadget-store' )
			)
		);
		wp_enqueue_script( 'gadget-store-demo-import-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->gadget_store_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->gadget_store_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->gadget_store_page_title ), esc_html( $this->gadget_store_page_title ), 'manage_options', $this->gadget_store_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'gadget-store' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$gadget_store_theme = wp_get_theme();
		$gadget_store_theme_title = $gadget_store_theme->get( 'Name' );
		$gadget_store_theme_version = $gadget_store_theme->get( 'Version' );

		?>
		<div class="wrap">
			<?php 
			// Theme Title and Version
			printf( '<h1>%s %s</h1>', esc_html( $gadget_store_theme_title ), esc_html( '(Version :- ' . $gadget_store_theme_version . ')' ) );
			?>
			
			<div class="card whizzie-wrap">
				<div class="demo_content_image">
					<div class="demo_content">
						<?php

						$gadget_store_steps = $this->get_steps();
						echo '<ul class="whizzie-menu">';
						foreach ( $gadget_store_steps as $gadget_store_step ) {
							$class = 'step step-' . esc_attr( $gadget_store_step['id'] );
							echo '<li data-step="' . esc_attr( $gadget_store_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
							printf( '<h2>%s</h2>', esc_html( $gadget_store_step['title'] ) );

							$content = call_user_func( array( $this, $gadget_store_step['view'] ) );
							if ( isset( $content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $content['summary'] )
								);
							}
							if ( isset( $content['detail'] ) ) {
								printf( '<p><a href="#" class="more-info">%s</a></p>', esc_html__( 'More Info', 'gadget-store' ) );
								printf(
									'<div class="detail">%s</div>',
									wp_kses_post( $content['detail'] )
								);
							}
							if ( isset( $gadget_store_step['button_text'] ) && $gadget_store_step['button_text'] ) {
								printf( 
									'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( $gadget_store_step['callback'] ),
									esc_attr( $gadget_store_step['id'] ),
									esc_html( $gadget_store_step['button_text'] )
								);
							}
							if ( isset( $gadget_store_step['can_skip'] ) && $gadget_store_step['can_skip'] ) {
								printf( 
									'<div class="button-wrap" style="margin-left: 0.5em;"><a href="#" class="button button-secondary do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( 'do_next_step' ),
									esc_attr( $gadget_store_step['id'] ),
									esc_html__( 'Skip', 'gadget-store' )
								);
							}
							echo '</li>';
						}
						echo '</ul>';
						?>
						
						<ul class="whizzie-nav">
							<?php
							foreach ( $gadget_store_steps as $gadget_store_step ) {
								if ( isset( $gadget_store_step['icon'] ) && $gadget_store_step['icon'] ) {
									echo '<li class="nav-step-' . esc_attr( $gadget_store_step['id'] ) . '"><span class="dashicons dashicons-' . esc_attr( $gadget_store_step['icon'] ) . '"></span></li>';
								}
							}
							?>
						</ul>

						<div class="step-loading"><span class="spinner"></span></div>
					</div> <!-- .demo_content -->

					<div class="demo_image">
						<div class="demo_image buttons">
							<a href="<?php echo esc_url( GADGET_STORE_PRO_THEME_URL ); ?>" class="button button-primary bundle" target="_blank"><?php echo esc_html__( 'Buy Now', 'gadget-store' ); ?></a>
							<a href="<?php echo esc_url( GADGET_STORE_THEME_BUNDLE_URL ); ?>" class="button button-primary bundle pro" target="_blank"><?php echo esc_html__( 'Buy All Themes', 'gadget-store' ); ?></a>
							<a href="<?php echo esc_url( GADGET_STORE_FREE_DOCS_THEME_URL ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Free Documentation', 'gadget-store' ); ?></a>
							<a href="<?php echo esc_url( GADGET_STORE_SUPPORT_THEME_URL ); ?>" target="_blank" class="button button-primary"><?php echo esc_html__( 'Support', 'gadget-store' ); ?></a>
						</div>
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr( $gadget_store_theme_title ); ?>" />
					</div> <!-- .demo_image -->

				</div> <!-- .demo_content_image -->
			</div> <!-- .whizzie-wrap -->
		</div> <!-- .wrap -->
		<?php
	}


		
	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$gadget_store_dev_steps = $this->config_steps;
		$gadget_store_steps = array( 
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'gadget-store' ) . $this->gadget_store_theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro',
				'callback'		=> 'do_next_step',
				'button_text'	=> __( 'Start Now', 'gadget-store' ),
				'can_skip'		=> false
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'gadget-store' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'gadget-store' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'gadget-store' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo Content', 'gadget-store' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'gadget-store' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $gadget_store_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from demo-import-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $gadget_store_dev_steps as $gadget_store_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $gadget_store_dev_step['id'] ) ) {
					$id = $gadget_store_dev_step['id'];
					if( isset( $gadget_store_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $gadget_store_dev_step[$element] ) ) {
								$gadget_store_steps[$id][$element] = $gadget_store_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $gadget_store_steps;
	}
	
	/**
	 * Print the content for the intro step
	 */
	public function get_step_intro() { ?>
		<div class="summary">
			<div class="steps_content">
				<p>
					<?php printf(
						/* translators: %s: Theme name. */
						esc_html__('Thank you for choosing the %s theme. You will only need a few minutes to configure and launch your new website with the help of this quick setup tutorial. To begin using your website, simply follow the wizard\'s instructions.', 'gadget-store'),
						esc_html($this->gadget_store_theme_title)
					); ?>
				</p>
			</div>
		</div>
	<?php }

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
	$plugins = $this->get_plugins();
	$content = array(); ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','gadget-store') ?>
			</p>
		</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {

			if ( $slug != 'yith-woocommerce-wishlist' ) {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';
			}

		}
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?>
	<div class="summary">
		<p>
			<?php esc_html_e('This theme supports importing the demo content and adding widgets. Get them installed with the below button. Using the Customizer, it is possible to update or even deactivate them.','gadget-store'); ?>
		</p>
	</div>
	<?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
		<div id="gadget-store-demo-setup-guid">
			<div class="customize_div"><?php echo esc_html( 'Now Customize your website' ); ?>
				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="customize_link">
					<?php echo esc_html( 'Customize ' ); ?> 
					<span class="dashicons dashicons-share-alt2"></span>
				</a>
			</div>
			<div class="gadget-store-setup-finish">
				<a target="_blank" href="<?php echo esc_url( admin_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'Go To Dashboard', 'gadget-store' ); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'Preview Site', 'gadget-store' ); ?>
				</a>
			</div>
		</div>
	<?php }


	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','gadget-store' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','gadget-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','gadget-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','gadget-store' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','gadget-store' ) ) );
		}
		exit;
	}


	public function gadget_store_customizer_nav_menu() {

		// ---------------- Create Primary Menu ---------------- //

		$gadget_store_themename = 'Gadget Store';
		$gadget_store_menuname = $gadget_store_themename . ' Primary Menu';
		$gadget_store_menulocation = 'primary';
		$gadget_store_menu_exists = wp_get_nav_menu_object($gadget_store_menuname);

		if (!$gadget_store_menu_exists) {
			$gadget_store_menu_id = wp_create_nav_menu($gadget_store_menuname);

			// Home
			wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
				'menu-item-title' => __('Home', 'gadget-store'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$gadget_store_page_about = get_page_by_path('about');
			if($gadget_store_page_about){
				wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
					'menu-item-title' => __('About', 'gadget-store'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($gadget_store_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$gadget_store_page_services = get_page_by_path('services');
			if($gadget_store_page_services){
				wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
					'menu-item-title' => __('Services', 'gadget-store'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($gadget_store_page_services),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$gadget_store_page_blog = get_page_by_path('blog');
			if($gadget_store_page_blog){
				wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'gadget-store'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($gadget_store_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// 404 Page
			$gadget_store_notfound = get_page_by_path('404 Page');
			if($gadget_store_notfound){
				wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
					'menu-item-title' => __('404 Page', 'gadget-store'),
					'menu-item-classes' => '404',
					'menu-item-url' => get_permalink($gadget_store_notfound),
					'menu-item-status' => 'publish'
				));
			}

			// Contact Us
			$gadget_store_page_contact = get_page_by_path('contact');
			if($gadget_store_page_contact){
				wp_update_nav_menu_item($gadget_store_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'gadget-store'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($gadget_store_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			if (!has_nav_menu($gadget_store_menulocation)) {
				$gadget_store_locations = get_theme_mod('nav_menu_locations');
				$gadget_store_locations[$gadget_store_menulocation] = $gadget_store_menu_id;
				set_theme_mod('nav_menu_locations', $gadget_store_locations);
			}
		}
	}

	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function setup_widgets(){

		//................................................. MENUS .................................................//
		
			// Creation of home page //
			$gadget_store_home_content = '';
			$gadget_store_home_title = 'Home';
			$gadget_store_home = array(
					'post_type' => 'page',
					'post_title' => $gadget_store_home_title,
					'post_content'  => $gadget_store_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$gadget_store_home_id = wp_insert_post($gadget_store_home);

			add_post_meta( $gadget_store_home_id, '_wp_page_template', 'templates/template-frontpage.php' );

			$gadget_store_home = get_page_by_path( 'Home' );
			update_option( 'page_on_front', $gadget_store_home->ID );
			update_option( 'show_on_front', 'page' );

			// Creation of blog page //
			$gadget_store_blog_title = 'Blog';
			$gadget_store_blog_check = get_page_by_path('blog');
			if (!$gadget_store_blog_check) {
				$gadget_store_blog = array(
					'post_type'    => 'page',
					'post_title'   => $gadget_store_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$gadget_store_blog_id = wp_insert_post($gadget_store_blog);

				if (!is_wp_error($gadget_store_blog_id)) {
					update_option('page_for_posts', $gadget_store_blog_id);
				}
			}

			// Creation of contact us page //
			$gadget_store_contact_title = 'Contact Us';
			$gadget_store_contact_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$gadget_store_contact_check = get_page_by_path('contact');
			if (!$gadget_store_contact_check) {
				$gadget_store_contact = array(
					'post_type'    => 'page',
					'post_title'   => $gadget_store_contact_title,
					'post_content'   => $gadget_store_contact_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'contact' // Unique slug for the Contact Us page
				);
				wp_insert_post($gadget_store_contact);
			}

			// Creation of about page //
			$gadget_store_about_title = 'About';
			$gadget_store_about_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$gadget_store_about_check = get_page_by_path('about');
			if (!$gadget_store_about_check) {
				$gadget_store_about = array(
					'post_type'    => 'page',
					'post_title'   => $gadget_store_about_title,
					'post_content'   => $gadget_store_about_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'about' // Unique slug for the About page
				);
				wp_insert_post($gadget_store_about);
			}

			// Creation of services page //
			$gadget_store_services_title = 'Services';
			$gadget_store_services_content = 'What is Lorem Ipsum?
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
														&nbsp;
														Why do we use it?
														It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
														&nbsp;
														Where does it come from?
														There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
			$gadget_store_services_check = get_page_by_path('services');
			if (!$gadget_store_services_check) {
				$gadget_store_services = array(
					'post_type'    => 'page',
					'post_title'   => $gadget_store_services_title,
					'post_content'   => $gadget_store_services_content,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'services' // Unique slug for the Services page
				);
				wp_insert_post($gadget_store_services);
			}

			// Creation of 404 page //
			$gadget_store_notfound_title = '404 Page';
			$gadget_store_notfound = array(
				'post_type'   => 'page',
				'post_title'  => $gadget_store_notfound_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug'   => '404'
			);
			$gadget_store_notfound_id = wp_insert_post($gadget_store_notfound);
			add_post_meta($gadget_store_notfound_id, '_wp_page_template', '404.php');

			// Creation of Slider page //
			$gadget_store_slider_title = 'Apple Studio Display Texture Glass 01';
			$gadget_store_slider_content = 'Free shipping on all your order.';
			$gadget_store_slider_check = get_page_by_path('slider-page');

			// Check if the page already exists, if not, create the page
			if (!$gadget_store_slider_check) {
				// Insert the page
				$gadget_store_slider = array(
					'post_type'   => 'page',
					'post_title'  => $gadget_store_slider_title,
					'post_content'  => $gadget_store_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-page'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($gadget_store_slider);
				
				// Get the image URL (replace 'slider.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			// Creation of Slider page //
			$gadget_store_slider_title = 'Apple Studio Display Texture Glass 02';
			$gadget_store_slider_content = 'Free shipping on all your order.';
			$gadget_store_slider_check = get_page_by_path('slider-pages');

			// Check if the page already exists, if not, create the page
			if (!$gadget_store_slider_check) {
				// Insert the page
				$gadget_store_slider = array(
					'post_type'   => 'page',
					'post_title'  => $gadget_store_slider_title,
					'post_content'  => $gadget_store_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pages'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($gadget_store_slider);
				
				// Get the image URL (replace 'slider02.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider02.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider02.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			// Creation of Slider page //
			$gadget_store_slider_title = 'Apple Studio Display Texture Glass 03';
			$gadget_store_slider_content = 'Free shipping on all your order.';
			$gadget_store_slider_check = get_page_by_path('slider-pagess');

			// Check if the page already exists, if not, create the page
			if (!$gadget_store_slider_check) {
				// Insert the page
				$gadget_store_slider = array(
					'post_type'   => 'page',
					'post_title'  => $gadget_store_slider_title,
					'post_content'  => $gadget_store_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pagess'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($gadget_store_slider);
				
				// Get the image URL (replace 'slider03.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider03.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider03.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			// Creation of Slider page //
			$gadget_store_slider_title = '75% OFF';
			$gadget_store_slider_content = 'Misfit By Boat 1200 Runtime: 120 Mins 6-in-1 Trimmer For Men';
			$gadget_store_slider_check = get_page_by_path('slider-pageone');

			// Check if the page already exists, if not, create the page
			if (!$gadget_store_slider_check) {
				// Insert the page
				$gadget_store_slider = array(
					'post_type'   => 'page',
					'post_title'  => $gadget_store_slider_title,
					'post_content'  => $gadget_store_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pageone'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($gadget_store_slider);
				
				// Get the image URL (replace 'slider1.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider1.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider1.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}

			// Creation of Slider page //
			$gadget_store_slider_title = 'KitchenAid Pro Line Series 2';
			$gadget_store_slider_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy.';
			$gadget_store_slider_check = get_page_by_path('slider-pagetwo');

			// Check if the page already exists, if not, create the page
			if (!$gadget_store_slider_check) {
				// Insert the page
				$gadget_store_slider = array(
					'post_type'   => 'page',
					'post_title'  => $gadget_store_slider_title,
					'post_content'  => $gadget_store_slider_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_name'   => 'slider-pagetwo'
				);
				
				// Insert the post (page)
				$page_id = wp_insert_post($gadget_store_slider);
				
				// Get the image URL (replace 'slider2.png' with the actual path to the image)
				$image_path = get_template_directory() . '/assets/images/slider2.png';  // Path to your image in theme folder
				
				// If the image exists, upload it to the media library and set it as the featured image
				if (file_exists($image_path)) {
					// Upload the image
					$upload = wp_upload_bits('slider2.png', null, file_get_contents($image_path));
					
					// Check if the upload was successful
					if (!$upload['error']) {
						// Create an attachment post
						$attachment = array(
							'guid' => $upload['url'], 
							'post_mime_type' => 'image/png',
							'post_title' => basename($image_path),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						
						// Insert the attachment into the media library
						$attachment_id = wp_insert_attachment($attachment, $upload['file'], $page_id);
						
						// Generate the metadata for the attachment
						$attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
						wp_update_attachment_metadata($attachment_id, $attachment_data);
						
						// Set the image as the featured image for the page
						set_post_thumbnail($page_id, $attachment_id);
					}
				}
			}


		/* -------------- Header ------------------*/
			
			set_theme_mod('gadget_store_topheader_text', 'Welcome to Worldwide Ecommerce Store');
			set_theme_mod('gadget_store_topheader_about_text', 'About Us');
			set_theme_mod('gadget_store_topheader_about_link', '#');
			set_theme_mod('gadget_store_topheader_order_text', 'Order Tracking');
			set_theme_mod('gadget_store_topheader_order_link', '#');
			set_theme_mod('gadget_store_notification', '#');
			set_theme_mod('gadget_store_like_option', '#');


		/* -------------- Products ------------------*/

		$gadget_store_product_category= array(
			'Gadgets' => array(
						'DSLR',
						'Mobile',
						'Laptop',
						'Watch',
						'Tablet',
						'Earphones',
						'Smart Watch',
						'Camera',
			),
		);
		$k = 1;
		foreach ( $gadget_store_product_category as $gadget_store_product_cats => $gadget_store_products_name ) {

			// Insert porduct cats Start
			$content = 'Lorem ipsum dolor sit amet';
			$parent_category	=	wp_insert_term(
			$gadget_store_product_cats, // the term
			'product_cat', // the taxonomy
			array(
				'description'=> $content,
				'slug' => 'product_cat'.$k
			));

			$image_url = get_template_directory_uri().'/assets/images/slider'.$k.'.png';

			$gadget_store_image_name= 'img'.$k.'.png';
			$upload_dir       = wp_upload_dir();
			// Set upload folder
			$gadget_store_image_data= file_get_contents($image_url);
			// Get image data
			$unique_file_name = wp_unique_filename( $upload_dir['path'], $gadget_store_image_name );
			// Generate unique name
			$filename= basename( $unique_file_name );
			// Create image file name

			// Check folder permission and define file location
			if( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
			} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
			}

			// Create the image  file on the server
			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
			
			WP_Filesystem();
			global $wp_filesystem;
			
			if ( ! $wp_filesystem->put_contents( $file, $gadget_store_image_data, FS_CHMOD_FILE ) ) {
				wp_die( 'Error saving file!' );
			}
			
			// Check image file type
			$wp_filetype = wp_check_filetype( $filename, null );

			// Set attachment data
			$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_type'     => 'product',
			'post_status'    => 'inherit'
			);

			// Create the attachment
			$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

			// Include image.php
			require_once(ABSPATH . 'wp-admin/includes/image.php');

			// Define attachment metadata
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

			// Assign metadata to attachment
			wp_update_attachment_metadata( $attach_id, $attach_data );

			update_woocommerce_term_meta( $parent_category['term_id'], 'thumbnail_id', $attach_id );

			// create Product START
			foreach ( $gadget_store_products_name as $key => $gadget_store_product_title ) {

				$content = 'Te obtinuit ut adepto satis somno.';
				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags( $gadget_store_product_title ),
					'post_content'  => $content,
					'post_status'   => 'publish',
					'post_type'     => 'product',
				);

				// Insert the post into the database
				$post_id    = wp_insert_post($my_post);

				wp_set_object_terms( $post_id, 'product_cat' . $k, 'product_cat', true );

				update_post_meta($post_id, '_regular_price', '14.22'); // Set regular price	
				update_post_meta($post_id, '_sale_price', '12'); // Set sale price
				update_post_meta($post_id, '_price', '12'); // Set current price (sale price is applied)

				// Now replace meta w/ new updated value array
				$image_url = get_template_directory_uri().'/assets/images/'.str_replace( " ", "-", $gadget_store_product_title).'.png';

				echo $image_url . "<br>";

				$gadget_store_image_name       = $gadget_store_product_title.'.png';
				$upload_dir = wp_upload_dir();
				// Set upload folder
				$gadget_store_image_data = file_get_contents(esc_url($image_url));

				// Get image data
				$unique_file_name = wp_unique_filename($upload_dir['path'], $gadget_store_image_name);
				// Generate unique name
				$filename = basename($unique_file_name);
				// Create image file name

				// Check folder permission and define file location
				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'].'/'.$filename;
				} else {
					$file = $upload_dir['basedir'].'/'.$filename;
				}

				// Create the image  file on the server
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $file, $gadget_store_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}

				// Check image file type
				$wp_filetype = wp_check_filetype($filename, null);

				// Set attachment data
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($filename),
					'post_type'      => 'product',
					'post_status'    => 'inherit',
				);

				// Create the attachment
				$attach_id = wp_insert_attachment($attachment, $file, $post_id);

				// Include image.php
				require_once (ABSPATH.'wp-admin/includes/image.php');

				// Define attachment metadata
				$attach_data = wp_generate_attachment_metadata($attach_id, $file);

				// Assign metadata to attachment
				wp_update_attachment_metadata($attach_id, $attach_data);

				// And finally assign featured image to post
				set_post_thumbnail($post_id, $attach_id);
			}
			// Create product END
			++$k;
		}


		/* -------------- Slider ------------------*/
	
			set_theme_mod('gadget_store_slider_text', 'Sale up to 30% OFF');
			set_theme_mod('gadget_store_banner_top', 'Summer Sale');

			$gadget_store_sliders = array('slider-page', 'slider-pagess', 'slider-pages');

			for ($i = 0; $i < count($gadget_store_sliders); $i++) {
				$page = get_page_by_path($gadget_store_sliders[$i]);

				if ($page) {
					set_theme_mod('gadget_store_slider' . ($i + 1), $page->ID);
				} else {
					set_theme_mod('gadget_store_slider' . ($i + 1), 0);
				}
			}


		/* -------------- Products ------------------*/

			set_theme_mod('gadget_store_best_seller_heading', 'Best Seller');

        
        $this->gadget_store_customizer_nav_menu();

	    exit;
	}
}