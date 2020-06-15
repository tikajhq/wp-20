<?php
/**
 * Regulating fonts.
 *
 * @package tik
 */

if ( ! class_exists( 'Tik_Fonts' ) ) :

	/**
	 * The Tik_Fonts object.
	 */
	final class Tik_Fonts {

		/**
		 * Holds a single instance of this object.
		 *
		 * @static
		 * @access private
		 * @var null|object
		 */
		private static $instance = null;

		/**
		 * An array of google fonts.
		 *
		 * @static
		 * @access public
		 * @var null|object
		 */
		public static $google_fonts = null;

		/**
		 * The class constructor.
		 */
		private function __construct() {
		}

		/**
		 * Get the one, true instance of this class.
		 *
		 * @return object Tik_Fonts
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Return an array of standard websafe fonts.
		 *
		 * @return array    Standard websafe fonts.
		 */
		public static function get_standard_fonts() {

			$standard_fonts = array(
				'websafe'    => array(
					'label' => 'Web Safe',
					'stack' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
				),
				'serif'      => array(
					'label' => 'Serif',
					'stack' => 'Georgia, Times, Times New Roman, serif',
				),
				'sans-serif' => array(
					'label' => 'Sans Serif',
					'stack' => '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen-Sans, Ubuntu, Cantarell, Helvetica Neue, sans-serif',
				),
				'monospace'  => array(
					'label' => 'Monospace',
					'stack' => 'Monaco, Lucida Sans Typewriter, Lucida Typewriter, Courier New, Courier, monospace',
				),
			);

			return $standard_fonts;

		}

		/**
		 * Return an array of Google fonts.
		 *
		 * @return array    Google fonts.
		 */
		public static function get_google_fonts() {

			if ( null === self::$google_fonts || empty( self::$google_fonts ) ) {

				$fonts = include_once wp_normalize_path( dirname( __FILE__ ) . '/webfonts.php' );

				$google_fonts = array();
				if ( is_array( $fonts ) ) {
					// Reformat fonts.
					foreach ( $fonts['items'] as $font ) {
						$google_fonts[ $font['family'] ] = array(
							'label'    => $font['family'],
							'variants' => $font['variants'],
							'subsets'  => $font['subsets'],
							'category' => $font['category'],
						);
					}
				}

				self::$google_fonts = $google_fonts;

			}

			return self::$google_fonts;

		}

		/**
		 * Returns an array of all available variants.
		 *
		 * @static
		 * @access public
		 * @return array
		 */
		public static function get_all_variants() {
			return array(
				'100'       => esc_attr__( 'Ultra-Light 100', 'tik' ),
				'100light'  => esc_attr__( 'Ultra-Light 100', 'tik' ),
				'100italic' => esc_attr__( 'Ultra-Light 100 Italic', 'tik' ),
				'200'       => esc_attr__( 'Light 200', 'tik' ),
				'200italic' => esc_attr__( 'Light 200 Italic', 'tik' ),
				'300'       => esc_attr__( 'Book 300', 'tik' ),
				'300italic' => esc_attr__( 'Book 300 Italic', 'tik' ),
				'400'       => esc_attr__( 'Normal 400', 'tik' ),
				'italic'    => esc_attr__( 'Normal 400 Italic', 'tik' ),
				'500'       => esc_attr__( 'Medium 500', 'tik' ),
				'500italic' => esc_attr__( 'Medium 500 Italic', 'tik' ),
				'600'       => esc_attr__( 'Semi-Bold 600', 'tik' ),
				'600bold'   => esc_attr__( 'Semi-Bold 600', 'tik' ),
				'600italic' => esc_attr__( 'Semi-Bold 600 Italic', 'tik' ),
				'700'       => esc_attr__( 'Bold 700', 'tik' ),
				'700italic' => esc_attr__( 'Bold 700 Italic', 'tik' ),
				'800'       => esc_attr__( 'Extra-Bold 800', 'tik' ),
				'800bold'   => esc_attr__( 'Extra-Bold 800', 'tik' ),
				'800italic' => esc_attr__( 'Extra-Bold 800 Italic', 'tik' ),
				'900'       => esc_attr__( 'Ultra-Bold 900', 'tik' ),
				'900bold'   => esc_attr__( 'Ultra-Bold 900', 'tik' ),
				'900italic' => esc_attr__( 'Ultra-Bold 900 Italic', 'tik' ),
			);
		}

		/**
		 * Returns an array of all available subsets.
		 *
		 * @static
		 * @access public
		 * @return array
		 */
		public static function get_google_font_subsets() {
			return array(
				'cyrillic'     => 'Cyrillic',
				'cyrillic-ext' => 'Cyrillic Extended',
				'devanagari'   => 'Devanagari',
				'greek'        => 'Greek',
				'greek-ext'    => 'Greek Extended',
				'khmer'        => 'Khmer',
				'latin'        => 'Latin',
				'latin-ext'    => 'Latin Extended',
				'vietnamese'   => 'Vietnamese',
				'hebrew'       => 'Hebrew',
				'arabic'       => 'Arabic',
				'bengali'      => 'Bengali',
				'gujarati'     => 'Gujarati',
				'tamil'        => 'Tamil',
				'telugu'       => 'Telugu',
				'thai'         => 'Thai',
			);
		}

	}

endif;
