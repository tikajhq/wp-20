<?php
/**
 * Filter array values.
 *
 * @package    ThemeGrill
 * @subpackage Tik
 * @since      Tik 1.1.7
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER TOP BAR ==========================================*/
if ( ! class_exists( 'Tik_Dynamic_Filter' ) ) :

	/**
	 * Filter array values.
	 */
	class Tik_Dynamic_Filter {

		/**
		 * Array of filter name and css classes.
		 *
		 * @since    1.1.7
		 * @access   private
		 * @var      array $css_class_arr Filter tag and class list.
		 */
		private static $css_class_arr = array();

		/**
		 * Get filter tag and class list in Array.
		 *
		 * @since    1.1.7
		 * @access   public
		 *
		 * @return array Filter tag and class list.
		 */
		public static function css_class_list() {

			self::$css_class_arr = array(
				'tik_header_class'                      => array(
					'site-header',
					'tg-site-header',
				),
				'tik_header_main_container_class'       => array(
					'tg-header-container',
					'tg-container',
					'tg-container--flex',
					'tg-container--flex-center',
					'tg-container--flex-space-between',
				),
				'tik_header_top_class'                  => array(
					'tg-site-header-top',
				),
				'tik_header_top_container_class'        => array(
					'tg-header-container',
					'tg-container',
					'tg-container--flex',
					'tg-container--flex-center',
				),
				'tik_page_header_container_class'       => array(
					'tg-container',
					'tg-container--flex',
					'tg-container--flex-center',
					'tg-container--flex-space-between',
				),
				'tik_nav_class'                         => array(
					'main-navigation',
					'tg-primary-menu',
				),
				'tik_header_action_class'               => array(
					'tg-header-action',
				),
				'tik_read_more_wrapper_class'           => array(
					'tg-read-more-wrapper',
					'clearfix',
				),
				'tik_footer_widgets_container_class'    => array(
					'tg-container',
				),
				'tik_footer_bottom_bar_container_class' => array(
					'tg-container',
					'tg-container--flex',
					'tg-container--flex-top',
				),
				'tik_scroll_to_top_class'               => array(
					'tg-scroll-to-top',
				),
				'tik_mobile_nav_class'                  => array(
					'tg-mobile-navigation',
				),
			);

			return apply_filters( 'tik_css_class_list', self::$css_class_arr );

		}

		/**
		 * Filter the array according to key.
		 *
		 * @since    1.1.7
		 * @access   public
		 *
		 * @param string $tag Filter tag.
		 *
		 * @return array Filter tag and class list.
		 */
		public static function filter_via_tag( $tag ) {

			$css_class = self::css_class_list();

			$filtered = array();

			if ( isset( $css_class[ $tag ] ) ) {
				$filtered = $css_class[ $tag ];
			}

			return $filtered;

		}

	}

endif;
