<?php 
/**
 * Handle adding the admin menu 
 *
 * @package exponent
 * @author Brand Exponents
 **/
if( !class_exists( 'ExponentAdminMenu' ) ) {
	class ExponentAdminMenu {
		public static $settings;

		public function __construct($core) {
			$this->core = $core;
			$settings = array();
			$this::$settings = wp_parse_args( $settings, array(
				'page-title' => esc_html__( 'Exponent', 'exponent' ),
				'menu-title' => esc_html__( 'Exponent', 'exponent' ),
				'capability' => 'edit_theme_options',
				'menu-slug' => 'be_register',
				'function' => array($this, 'menu_content'),
				'icon_url' => get_template_directory_uri().'/lib/admin-tpl/assets/img/exponent.png'
				) );
		}
		public function run(){
			add_action( 'admin_menu',array($this, 'menu') );
		}
		public function get_settings($setting) {
			return $this::$settings[$setting];
		}
		public function menu(){
			//$page = add_theme_page( $this::$settings['page-title'], $this::$settings['menu-title'], $this::$settings['capability'], $this::$settings['menu-slug'], $this::$settings['function'], $this::$settings['icon_url'], 2 );
			$page = add_theme_page( $this::$settings['page-title'], $this::$settings['menu-title'], $this::$settings['capability'], $this::$settings['menu-slug'], $this::$settings['function'], 2 ); 
			add_action('load-'.$page, array($this,'menu_scripts'));
		}
		public function menu_content() {
			require_once get_template_directory() . '/lib/admin-tpl/start-page.php';
		}

		public function menu_scripts() {
			add_action( 'admin_enqueue_scripts', array($this,'register_scripts'), 10, 1 );
		}

		public function register_scripts($hook) {
			wp_enqueue_script( 'clipboard', get_template_directory_uri().'/lib/admin-tpl/assets/js/clipboard.min.js', array( 'jquery' ), false, false );

			wp_enqueue_script( 'image-picker', get_template_directory_uri().'/lib/admin-tpl/assets/js/image-picker.min.js', array( 'jquery' ), false, false );

			wp_enqueue_script( 'notify', get_template_directory_uri().'/lib/admin-tpl/assets/js/notify.js', array( 'jquery' ), false, false );

			wp_enqueue_script( 'be-start-scripts', get_template_directory_uri().'/lib/admin-tpl/assets/js/start-page.js', array( 'jquery' ), false, false );
			
			wp_enqueue_style( 'be-admin-tabs', get_template_directory_uri().'/lib/admin-tpl/assets/stylesheets/start-page.css', false );

			wp_enqueue_style( 'image-picker-css', get_template_directory_uri().'/lib/admin-tpl/assets/stylesheets/image-picker.css' );

			wp_enqueue_style( 'notify-metro-css', get_template_directory_uri().'/lib/admin-tpl/assets/stylesheets/notify-metro.css' );
		}

		public function sub_menu() {	
			add_theme_page( $this::$settings['menu-slug'], esc_html__( 'Prdouct License', 'exponent' ), esc_html__( 'Prdouct License', 'exponent' ), $this::$settings['capability'] , $this::$settings['menu-slug'].'#be-welcome', array($this, 'quick_start') );
			add_theme_page( $this::$settings['menu-slug'], esc_html__( 'System Status', 'exponent' ), esc_html__( 'System Status', 'exponent' ), $this::$settings['capability'] , esc_url( admin_url('admin.php?page=be_registe#be-system-stat') ), array($this, 'quick_start') );
			add_theme_page( $this::$settings['menu-slug'], esc_html__( 'Install Plugins', 'exponent' ), esc_html__( 'Install Plugins', 'exponent' ), $this::$settings['capability'] , esc_url( admin_url('admin.php?page=be_registe#be-plugins') ), array($this, 'quick_start') );
			add_theme_page( $this::$settings['menu-slug'], esc_html__( 'Import Content', 'exponent' ), esc_html__( 'Import Content', 'exponent' ), $this::$settings['capability'] , esc_url( admin_url('admin.php?page=be_registe#be-import') ), array($this, 'quick_start') );	
		}
	}
}
?>