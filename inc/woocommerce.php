<?php
/**
 * WooCommerce Compatibility.
 *
 * @package tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function tik_woocommerce_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'tik_woocommerce_setup' );

/**
 * WooCommerce scripts and styles.
 *
 * @since  1.1.6
 * @return void
 */
function tik_woocommerce_scripts() {

	wp_enqueue_style( 'tik-woocommerce-style', TIK_PARENT_URI . '/assets/css/woocommerce.css', '', TIK_THEME_VERSION );

}

add_action( 'wp_enqueue_scripts', 'tik_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 *
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function tik_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', 'tik_woocommerce_active_body_class' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'tik_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function tik_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'tik_woocommerce_wrapper_before' );

if ( ! function_exists( 'tik_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function tik_woocommerce_wrapper_after() {
		?>
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'tik_woocommerce_wrapper_after' );

if ( ! function_exists( 'tik_woocommerce_header_add_to_cart_fragment' ) ) {
	/**
	 * After Content.
	 *
	 * @param array $fragments Section to refresh via AJAX.
	 *
	 * WooCommerce shopping cart.
	 *
	 * @return array
	 */
	function tik_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>

		<a class="cart-page-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>"
		   title="<?php esc_attr_e( 'View your shopping cart', 'tik' ); ?>">
			<i class="tg-icon tg-icon-shopping-cart"></i>
			<span class="count">
		<?php
		printf(
		/* translators: number of items in the mini cart. */
			'%d',
			// @codingStandardsIgnoreStart
			WC()->cart->get_cart_contents_count()
		// @codingStandardsIgnoreEnd
		);
		?>
		</span>
		</a>

		<?php
		$fragments['.cart-page-link'] = ob_get_clean();

		return $fragments; // WPCS: CSRF ok.
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'tik_woocommerce_header_add_to_cart_fragment' );

if ( ! function_exists( 'tik_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return string
	 */
	function tik_woocommerce_cart_link() {

		$output          = '';
		$output          .= '<a class="cart-page-link" href="' . esc_url( wc_get_cart_url() ) . '" title="' . __( 'View your shopping cart', 'tik' ) . '">';
		$item_count_text = sprintf(
		/* translators: number of items in the mini cart. */
			'%d',
			WC()->cart->get_cart_contents_count()
		);
		$output          .= '<i class="tg-icon tg-icon-shopping-cart"></i>';
		$output          .= '<span class="count">' . esc_html( $item_count_text ) . '</span>';
		$output          .= '</a>';

		return $output;

	}
}

if ( ! function_exists( 'tik_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return string
	 */
	function tik_woocommerce_header_cart() {

		$output = '';

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}

		$output .= '<li class="menu-item tg-menu-item tg-menu-item-cart ' . $class . '">';
		$output .= tik_woocommerce_cart_link();
		$output .= '</li>';

		return $output;

	}
}
add_filter( 'tik_woocommerce_header_cart', 'tik_woocommerce_header_cart' );

if ( ! function_exists( 'tik_woocommerce_page_title' ) ) :

	/**
	 * Manage WooCommerce page title.
	 *
	 * @return string
	 */
	function tik_woocommerce_page_title() {

		if ( 'page-header' === get_theme_mod( 'tik_page_title_enabled' ) ) {
			return false;
		}

		return true;

	}
endif;
add_filter( 'woocommerce_show_page_title', 'tik_woocommerce_page_title' );

if ( ! function_exists( 'tik_woocommerce_remove_product_title' ) ) :

	/**
	 * Remove product title if it's shown in page header.
	 */
	function tik_woocommerce_remove_product_title() {

		if ( 'page-header' === get_theme_mod( 'tik_page_title_enabled', 'page-header' ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		}

	}
endif;
add_action( 'wp_loaded', 'tik_woocommerce_remove_product_title' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

if ( ! function_exists( 'tik_woocommerce_get_sidebar' ) ) :

	/**
	 * Get WooCommerce Sidebar.
	 */
	function tik_woocommerce_get_sidebar() {

		// Hide sidebar when sidebar is not present.
		if ( in_array( tik_get_current_layout(), array(
			'tg-site-layout--no-sidebar',
			'tg-site-layout--default',
			'tg-site-layout--stretched'
		), true ) ) {
			return;
		}

		// Get site layout from customizer and page setting.
		$current_sidebar = tik_get_current_layout();

		$sidebar = '';
		if ( 'tg-site-layout--left' === $current_sidebar ) {
			$sidebar = 'wc-left-sidebar';
		} elseif ( 'tg-site-layout--right' === $current_sidebar ) {
			$sidebar = 'wc-right-sidebar';
		}

		if ( ! is_active_sidebar( $sidebar ) ) {
			return;
		}
		?>

		<aside id="secondary" class="widget-area <?php tik_sidebar_class(); ?>">
			<?php
			if ( ! empty( $sidebar ) ) {
				dynamic_sidebar( $sidebar );
			}
			?>
		</aside><!-- #secondary -->

		<?php
	}
endif;
add_action( 'woocommerce_sidebar', 'tik_woocommerce_get_sidebar', 10 );

