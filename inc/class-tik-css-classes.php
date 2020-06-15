<?php
/**
 * Adds classes to appropriate places.
 *
 * @package tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Tik_Css_Classes' ) ) :
	/**
	 * Adds css classes
	 */
	class Tik_Css_Classes {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_filter( 'body_class', array( $this, 'tik_add_body_classes' ) );
			add_filter( 'post_class', array( $this, 'tik_add_post_classes' ) );
			add_filter( 'tik_header_class', array( $this, 'tik_add_header_classes' ) );
			add_filter( 'tik_footer_widget_container_class', array(
				$this,
				'tik_add_footer_widget_container_classes',
			) );
			add_filter( 'tik_footer_bar_class', array( $this, 'tik_add_footer_bar_classes' ) );
			add_filter( 'tik_primary_menu_class', array( $this, 'tik_add_primary_menu_classes' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'tik_add_metabox_styles' ), 12 );
		}

		/**
		 * Adds css classes on body
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function tik_add_body_classes( $classes ) {

			if ( ! is_home() ) {
				$content_margin = get_post_meta( tik_get_post_id(), 'tik_remove_content_margin' );

				if ( isset( $content_margin[0] ) && $content_margin[0] ) {
					$classes[] = 'tg-no-content-margin';
				}
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			/**
			 * Layout.
			 */

			// Layout.
			$classes[] = tik_get_current_layout();

			// Container style.
			$classes[] = get_theme_mod( 'tik_general_container_style', 'tg-container--wide' );

			// Add transparent header class.
			if ( tik_is_header_transparent_enabled() ) {
				$classes[] = 'has-transparent-header';
			}

			// Add if page header is enabled.
			if ( 'page-header' === tik_is_page_title_enabled() ) {
				$classes[] = 'has-page-header';
			}

			// Add class if breadcrumbs is enabled.
			if ( tik_is_breadcrumbs_enabled() ) {
				$classes[] = 'has-breadcrumbs';
			}
			return $classes;
		}

		/**
		 * Adds css classes into the post.
		 *
		 * @param array $classes old classes.
		 *
		 * @return array new classes
		 */
		public function tik_add_post_classes( $classes ) {

			if ( is_archive() || is_home() || is_search() ) {
				$classes[] = 'tik-article';
			}
			if ( is_single() ) {
				$classes[] = 'tik-single-article';
			}

			if ( is_singular( 'post' ) ) {
				$classes[] = 'tik-article-post';
			}

			if ( is_singular( 'page' ) ) {
				$classes[] = 'tik-article-page';
			}

			return $classes;
		}

		/**
		 * Adds css classes into header
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function tik_add_header_classes( $classes ) {

			// TODO: check tik pro header_top_class method.
			if ( ! is_home() ) {
				$header_style = get_post_meta( tik_get_post_id(), 'tik_header_style', true );
			}

			if ( ! empty( $header_style ) ) {
				$classes[] = $header_style;
			} else {
				$classes[] = get_theme_mod( 'tik_header_main_style', 'tg-site-header--left' );
			}

			// Add transparent header class.
			if ( tik_is_header_transparent_enabled() ) {
				$classes[] = 'tg-site-header--transparent';
			}

			return $classes;
		}

		/**
		 * Adds css classes into primary menu
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function tik_add_primary_menu_classes( $classes ) {
			$tik_menu_item_active_style = get_post_meta( tik_get_post_id(), 'tik_menu_item_active_style', true );
			$tik_menu_extra             = get_theme_mod( 'tik_primary_menu_extra', false );

			if ( ! empty( $tik_menu_item_active_style ) ) {
				$classes[] = $tik_menu_item_active_style;
			} else {
				$classes[] = get_theme_mod( 'tik_primary_menu_text_active_effect', 'tg-primary-menu--style-underline' );
			}

			if ( ! empty( $tik_menu_extra ) ) {
				$classes[] = 'tg-extra-menus';
			}

			return $classes;
		}

		/**
		 * Adds css classes into the footer widget area
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function tik_add_footer_widget_container_classes( $classes ) {
			$classes[] = get_theme_mod( 'tik_footer_widgets_style', 'tg-footer-widget-col--four' );

			// Add hide class if the widget title is disabled.
			if ( get_theme_mod( 'tik_footer_widgets_hide_title', false ) ) {
				$classes[] = 'tg-footer-widget--title-hidden';
			}

			return $classes;
		}

		/**
		 * Adds css classes into the footer bar area
		 *
		 * @param array $classes list of old classes.
		 *
		 * @return array
		 */
		public function tik_add_footer_bar_classes( $classes ) {
			$footer_style = get_post_meta( tik_get_post_id(), 'tik_footer_style', true );
			if ( ! empty( $footer_style ) ) {
				$classes[] = $footer_style;
			} else {
				$classes[] = get_theme_mod( 'tik_footer_bar_style', 'tg-site-footer-bar--center' );
			}

			return $classes;
		}

		/**
		 * Adds styles from metabox.
		 *
		 * @return void
		 */
		public function tik_add_metabox_styles() {
			$customize_tik_menu_item_color        = get_theme_mod( 'tik_primary_menu_text_color', '#16181a' );
			$customize_tik_menu_item_hover_color  = get_theme_mod( 'tik_primary_menu_text_hover_color', '#269bd1' );
			$customize_tik_menu_item_active_color = get_theme_mod( 'tik_primary_menu_text_active_color', '#269bd1' );

			$tik_menu_item_color        = get_post_meta( tik_get_post_id(), 'tik_menu_item_color', true );
			$tik_menu_item_hover_color  = get_post_meta( tik_get_post_id(), 'tik_menu_item_hover_color', true );
			$tik_menu_item_active_color = get_post_meta( tik_get_post_id(), 'tik_menu_item_active_color', true );

			$meta_css = '';
			if ( $customize_tik_menu_item_color !== $tik_menu_item_color && ! empty( $tik_menu_item_color ) ) {
				$meta_css .= '.main-navigation.tg-primary-menu > div > ul > li > a { color: ' . $tik_menu_item_color . ' }';
			}
			if ( $customize_tik_menu_item_hover_color !== $tik_menu_item_hover_color && ! empty( $tik_menu_item_hover_color ) ) {
				$meta_css .= '.main-navigation.tg-primary-menu > div > ul > li:hover > a { color: ' . $tik_menu_item_hover_color . ' }';
			}
			if ( $customize_tik_menu_item_active_color !== $tik_menu_item_active_color && ! empty( $tik_menu_item_active_color ) ) {
				$meta_css .= '.main-navigation.tg-primary-menu > div > ul li:active > a, .main-navigation.tg-primary-menu > div > ul > li.current_page_item > a, .main-navigation.tg-primary-menu > div > ul > li.current-menu-item > a { color: ' . $tik_menu_item_active_color . ' }';
				$meta_css .= '.main-navigation.tg-primary-menu.tg-primary-menu--style-underline > div > ul > li.current_page_item > a::before, .main-navigation.tg-primary-menu.tg-primary-menu--style-underline > div > ul > li.current-menu-item > a::before, .main-navigation.tg-primary-menu.tg-primary-menu--style-left-border > div > ul > li.current_page_item > a::before, .main-navigation.tg-primary-menu.tg-primary-menu--style-left-border > div > ul > li.current-menu-item > a::before, .main-navigation.tg-primary-menu.tg-primary-menu--style-right-border > div > ul > li.current_page_item > a::before, .main-navigation.tg-primary-menu.tg-primary-menu--style-right-border > div > ul > li.current-menu-item > a::before { background-color: ' . $tik_menu_item_active_color . ' }';
			}

			$meta_css .= apply_filters( 'tik_meta_box_style', false );

			wp_add_inline_style( 'tik-style', $meta_css );
		}

	}
endif;
new Tik_Css_Classes();
