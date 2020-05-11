<?php

namespace PluginNamespace;

class Plugin {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function widget_scripts() {
		wp_register_script( 'plugin_name_js', plugins_url( '/assets/js/plugin-name.js', __FILE__ ), [ 'jquery' ], false, true );
  }
  
  public function widget_styles() {

		wp_register_style( 'plugin_name_css', plugins_url( '/assets/css/plugin-name.css', __FILE__ ) );

	}

	private function include_widgets_files() {

		require_once( __DIR__ . '/widgets/widget-name.php' );
    
	}

	public function register_widgets() {

		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Widget_Name() );
    
	}

	public function __construct() {

    // Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
