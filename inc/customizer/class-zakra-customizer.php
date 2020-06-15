<?php
/**
 * Tik Customizer Class
 *
 * @package tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Tik_Customizer' ) ) :

	/**
	 * Tik Customizer class
	 */
	class Tik_Customizer {
		/**
		 * Constructor - Setup customizer
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'tik_register_panel' ) );
			add_action( 'customize_register', array( $this, 'tik_customize_register' ) );
			add_action( 'customize_register', array( $this, 'tik_customize_helpers' ) );
			add_action( 'customize_preview_init', array( $this, 'tik_customize_preview_js' ) );
			add_action( 'after_setup_theme', array( $this, 'tik_customize_options' ) );

			require TIK_PARENT_INC_DIR . '/customizer/controls/php/class-tik-fonts.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/controls/php/webfonts/class-tik-google-fonts.php';

		}

		/**
		 * Register custom controls
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function tik_register_panel( $wp_customize ) {

			// Controls path.
			$control_dir = TIK_PARENT_INC_DIR . '/customizer/controls';
			$setting_dir = TIK_PARENT_INC_DIR . '/customizer/settings';

			// Load customizer options extending classes.
			require TIK_PARENT_CUSTOMIZER_DIR . '/extend-customizer/class-tik-customize-panel.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/extend-customizer/class-tik-customize-section.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/extend-customizer/class-tik-customize-upsell-section.php';

			// Register extended classes.
			$wp_customize->register_panel_type( 'Tik_Customize_Panel' );
			$wp_customize->register_section_type( 'Tik_Customize_Section' );

			// Load base class for controls.
			require_once $control_dir . '/php/class-tik-customize-base-control.php';
			// Load custom control classes.
            require_once $control_dir . '/php/class-tik-customize-background-control.php';
            require_once $control_dir . '/php/class-tik-customize-upsell-control.php';
			require_once $control_dir . '/php/class-tik-customize-color-control.php';
			require_once $control_dir . '/php/class-tik-customize-dimensions-control.php';
			require_once $control_dir . '/php/class-tik-customize-fontawesome-control.php';
			require_once $control_dir . '/php/class-tik-customize-heading-control.php';
			require_once $control_dir . '/php/class-tik-customize-editor-control.php';
			require_once $control_dir . '/php/class-tik-customize-radio-image-control.php';
			require_once $control_dir . '/php/class-tik-customize-radio-buttonset-control.php';
			require_once $control_dir . '/php/class-tik-customize-slider-control.php';
			require_once $control_dir . '/php/class-tik-customize-sortable-control.php';
			require_once $control_dir . '/php/class-tik-customize-text-control.php';
			require_once $control_dir . '/php/class-tik-customize-toggle-control.php';
			require_once $control_dir . '/php/class-tik-customize-typography-control.php';

            // Register JS-rendered control types.
            $wp_customize->register_control_type( 'Tik_Customize_Upsell_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Background_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Color_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Fontawesome_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Heading_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Editor_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Dimensions_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Radio_Image_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Radio_Buttonset_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Slider_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Sortable_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Text_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Toggle_Control' );
            $wp_customize->register_control_type( 'Tik_Customize_Typography_Control' );

		}

		/**
		 * Include customizer helpers.
		 */
		public function tik_customize_helpers() {

			require_once TIK_PARENT_INC_DIR . '/customizer/class-tik-customizer-sanitize.php';
			require_once TIK_PARENT_INC_DIR . '/customizer/class-tik-customizer-partials.php';

		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function tik_customize_register( $wp_customize ) {

			// Override defaults.
			require TIK_PARENT_CUSTOMIZER_DIR . '/override-defaults.php';

			// Register panels and sections.
			require TIK_PARENT_CUSTOMIZER_DIR . '/register-panels-and-sections.php';

		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function tik_customize_preview_js() {

			wp_enqueue_script( 'tik-customizer', TIK_PARENT_INC_URI . '/customizer/assets/js/customizer.js', array( 'customize-preview' ), TIK_THEME_VERSION, true );

		}

		/**
		 * Include customizer options.
		 */
		public function tik_customize_options() {
			/**
			 * Base class.
			 */
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/class-tik-customize-base-option.php';

			/**
			 * Child option classes.
			 */
			// Header.
            require TIK_PARENT_CUSTOMIZER_DIR . '/options/class-tik-customize-upsell-option.php';
            require TIK_PARENT_CUSTOMIZER_DIR . '/options/header/class-tik-customize-header-top-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/header/class-tik-customize-header-main-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/header/class-tik-customize-header-button-option.php';

			// Menu.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/menu/class-tik-customize-primary-menu-option.php';

			// General.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/general/class-tik-customize-general-option.php';

			// Blog.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/blog/class-tik-customize-blog-general-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/blog/class-tik-customize-blog-archive-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/blog/class-tik-customize-single-blog-post-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/blog/class-tik-customize-blog-meta-option.php';

			// Layout.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/layout/class-tik-customize-layout-general-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/layout/class-tik-customize-layout-woocommerce-option.php';

			// Styling.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/styling/class-tik-customize-base-colors-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/styling/class-tik-customize-button-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/styling/class-tik-customize-link-option.php';

			// Footer.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/footer/class-tik-customize-footer-bottom-bar-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/footer/class-tik-customize-footer-widget-option.php';
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/footer/class-tik-customize-scroll-to-top-option.php';

			// Typography.
			require TIK_PARENT_CUSTOMIZER_DIR . '/options/typography/class-tik-customize-typography-option.php';

		}

	}
endif;

new Tik_Customizer();
