<?php

/**
 * Plugin Name: Plugin Name
 * Description: Elementor sample plugin.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Author Name
 * Author URI:  https://elementor.com/
 * Text Domain: text_domain
 */

if ( ! defined( 'ABSPATH' ) ) exit;

final class Plugin_Name {

	const VERSION = '1.0.0';

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {

		add_action( 'init', array( $this, 'i18n' ) );

		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function i18n() {
		load_plugin_textdomain( 'text_domain' );
	}

	public function init() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		require_once( 'plugin.php' );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(

			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'text_domain' ),
			'<strong>' . esc_html__( 'Plugin Name', 'text_domain' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'text_domain' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'text_domain' ),
			'<strong>' . esc_html__( 'Plugin Name', 'text_domain' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'text_domain' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'text_domain' ),
			'<strong>' . esc_html__( 'Plugin Name', 'text_domain' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'text_domain' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

new Plugin_Name();
