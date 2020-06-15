<?php
/**
 * Tik footer functions to be hooked
 *
 * @package tik
 */

if ( ! function_exists( 'tik_content_end' ) ) :
	/**
	 * Container ends
	 */
	function tik_content_end() {
		?>
		</div>
		<!-- /.tg-container-->
		</div>
		<!-- /#content-->
		<?php
	}
endif;


if ( ! function_exists( 'tik_main_end' ) ) :
	/**
	 * Main ends
	 */
	function tik_main_end() {
		?>
		</main><!-- /#main -->
		<?php
	}
endif;

if ( ! function_exists( 'tik_footer_start' ) ) :
	/**
	 * Footer starts
	 */
	function tik_footer_start() {
		?>
		<footer id="colophon" class="site-footer tg-site-footer <?php tik_footer_class(); ?>">
		<?php
	}
endif;

if ( ! function_exists( 'tik_footer_widgets' ) ) :
	/**
	 * Footer widgets
	 */
	function tik_footer_widgets() {
		if ( ! tik_is_footer_widgets_enabled() ) {
			return;
		}
		?>

		<div class="tg-site-footer-widgets">
			<div class="<?php tik_css_class( 'tik_footer_widgets_container_class' ); ?>">
				<?php get_sidebar( 'footer' ); ?>
			</div><!-- /.tg-container-->
		</div><!-- /.tg-site-footer-widgets -->

		<?php
	}
endif;

if ( ! function_exists( 'tik_footer_bottom_bar' ) ) :
	/**
	 * Footer bar
	 */
	function tik_footer_bottom_bar() {

		if ( ! tik_is_footer_bar_enabled() ) {
			return;
		}
		?>

		<div class="tg-site-footer-bar <?php tik_footer_bar_classes(); ?>">
			<div class="<?php tik_css_class( 'tik_footer_bottom_bar_container_class' ); ?>">
				<div class="tg-site-footer-section-1">

					<?php
					/**
					 * Hook - tik_action_footer_bottom_bar
					 *
					 * @hooked tik_footer_bottom_bar_one - 10
					 */
					do_action( 'tik_action_footer_bottom_bar_one' );
					?>

				</div>
				<!-- /.tg-site-footer-section-1 -->

				<div class="tg-site-footer-section-2">

					<?php
					/**
					 * Hook - tik_action_footer_bottom_bar_two
					 *
					 * @hooked tik_footer_bottom_bar_two - 10
					 */
					do_action( 'tik_action_footer_bottom_bar_two' );
					?>

				</div>
				<!-- /.tg-site-footer-section-2 -->
			</div>
			<!-- /.tg-container-->
		</div>
		<!-- /.tg-site-footer-bar -->

		<?php
	}
endif;

if ( ! function_exists( 'tik_footer_bottom_bar_one' ) ) :
	/**
	 * Footer bar section one.
	 */
	function tik_footer_bottom_bar_one() {

		$footer_bar_one = get_theme_mod( 'tik_footer_bar_section_one', 'text_html' );

		switch ( $footer_bar_one ) :

			case 'none':
				break;

			case 'text_html':
				$text_html = get_theme_mod( 'tik_footer_bar_section_one_html', tik_footer_copyright() );
				echo wp_kses_post( $text_html );
				break;

			case 'menu':
				$menu = get_theme_mod( 'tik_footer_bar_section_one_menu', 'none' );
				if ( 'none' === $menu ) {
					return;
				}

				wp_nav_menu(
					array(
						'menu'        => $menu,
						'menu_id'     => 'footer-bar-one-menu',
						'container'   => '',
						'depth'       => -1,
						'fallback_cb' => false,
					)
				);
				break;

			case 'widget':
				if ( is_active_sidebar( 'footer-bar-left-sidebar' ) ) {
					dynamic_sidebar( 'footer-bar-left-sidebar' );
				}

				break;

			default:
				echo tik_footer_copyright(); // WPCS: XSS OK.

		endswitch;

	}
endif;

if ( ! function_exists( 'tik_footer_bottom_bar_two' ) ) :
	/**
	 * Footer bar section two.
	 */
	function tik_footer_bottom_bar_two() {

		$footer_bar_two = get_theme_mod( 'tik_footer_bar_section_two', 'none' );

		switch ( $footer_bar_two ) :

			case 'text_html':
				$text_html = get_theme_mod( 'tik_footer_bar_section_two_html', '' );
				echo wp_kses_post( $text_html );
				break;

			case 'menu':
				$menu = get_theme_mod( 'tik_footer_bar_section_two_menu', 'none' );
				if ( 'none' === $menu ) {
					return;
				}

				wp_nav_menu(
					array(
						'menu'        => $menu,
						'menu_id'     => 'footer-bar-two-menu',
						'container'   => '',
						'depth'       => -1,
						'fallback_cb' => false,
					)
				);
				break;

			case 'widget':
				if ( is_active_sidebar( 'footer-bar-right-sidebar' ) ) {
					dynamic_sidebar( 'footer-bar-right-sidebar' );
				}

				break;

			default:
				do_action( 'tik_footer_bar_section_two_option_case', $footer_bar_two );

		endswitch;

	}
endif;

if ( ! function_exists( 'tik_footer_end' ) ) :
	/**
	 * Footer ends
	 */
	function tik_footer_end() {
		?>
		</footer><!-- #colophon -->
		<?php
	}
endif;

if ( ! function_exists( 'tik_mobile_navigation' ) ) :
	/**
	 * Adds mobile navigation.
	 */
	function tik_mobile_navigation() {
		?>
		<nav id="mobile-navigation" class="<?php tik_css_class( 'tik_mobile_nav_class' ); ?>"
			<?php echo wp_kses_post( apply_filters( 'tik_nav_data_attrs', '' ) ); ?>>

			<?php wp_nav_menu(
				array(
					'theme_location' => 'menu-primary',
					'menu_id'        => 'mobile-primary-menu',
				)
			);
			?>

		</nav><!-- /#mobile-navigation-->
		<?php
	}
endif;

if ( ! function_exists( 'tik_scroll_to_top' ) ) :
	/**
	 * Shows scroll to top
	 */
	function tik_scroll_to_top() {
		// If scroll to top is disabled.
		if ( false === get_theme_mod( 'tik_scroll_to_top_enabled', true ) ) {
			return;
		}
		?>

		<a href="#" id="tg-scroll-to-top" class="<?php tik_css_class( 'tik_scroll_to_top_class' ); ?>">
			<i class="<?php echo esc_attr( apply_filters( 'tik_scroll_to_top_icon_class', 'tg-icon' ) ); ?> <?php
			echo esc_attr( apply_filters( 'tik_scroll_to_top_icon', 'tg-icon-arrow-up' ) ); ?>"><span
						class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'tik' ); ?></span></i>
		</a>

		<div class="tg-overlay-wrapper"></div>
		<?php
	}
endif;


if ( ! function_exists( 'tik_page_end' ) ) :
	/**
	 * Page ends
	 */
	function tik_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
