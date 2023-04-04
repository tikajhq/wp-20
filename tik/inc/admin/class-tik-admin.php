<?php
/**
 * Tik main admin class.
 *
 * @package Tik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Tik_Admin
 */
class Tik_Admin {

	/**
	 * Tik_Admin constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Localize array for import button AJAX request.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'tik-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), TIK_THEME_VERSION );

		wp_enqueue_script( 'tik-plugin-install-helper', TIK_PARENT_INC_URI . '/admin/js/plugin-handle.js', array( 'jquery' ), TIK_THEME_VERSION, true );

		$welcome_data = array(
			'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&tik-hide-notice=welcome' ) ),
			'btn_text' => esc_html__( 'Processing...', 'tik' ),
			'nonce'    => wp_create_nonce( 'tik_demo_import_nonce' ),
		);

		wp_localize_script( 'tik-plugin-install-helper', 'tikRedirectDemoPage', $welcome_data );
	}
}

new Tik_Admin();
