<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package tik
 */

if ( ! function_exists( 'tik_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function tik_pingback_header() {

		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}

	}
endif;

add_action( 'wp_head', 'tik_pingback_header' );

if ( ! function_exists( 'tik_header_class' ) ) :
	/**
	 * Adds css classes into header
	 *
	 * @param string $class css classname.
	 */
	function tik_header_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_header_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_header_top_class' ) ) :
	/**
	 * Adds css classes into header
	 *
	 * @param string $class css classname.
	 */
	function tik_header_top_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_header_top_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_css_class' ) ) :
	/**
	 * Adds css classes to elements dynamically.
	 *
	 * @param string $tag Filter tag name.
	 */
	function tik_css_class( $tag ) {

		// Get list of css classes in array for the `$tag` aka element.

		$classes = Tik_Dynamic_Filter::filter_via_tag( $tag );

		// Filter for the element classes.
		$classes = apply_filters( $tag, $classes );

		// Remove duplicate classes if any.
		$classes = array_unique( $classes );

		// Output in string format.
		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_primary_menu_class' ) ) :
	/**
	 * Adds css classes into primary menu
	 *
	 * @param string $class css classname.
	 */
	function tik_primary_menu_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_primary_menu_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_footer_class' ) ) :
	/**
	 * Adds css classes into the footer
	 *
	 * @param string $class css classname.
	 */
	function tik_footer_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_footer_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_footer_widget_container_class' ) ) :
	/**
	 * Adds css classes into the footer widget area
	 *
	 * @param string $class css classname.
	 */
	function tik_footer_widget_container_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_footer_widget_container_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_footer_bar_classes' ) ) :
	/**
	 * Adds css classes into the footer bar
	 *
	 * @param string $class css classname.
	 */
	function tik_footer_bar_classes( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$classes = apply_filters( 'tik_footer_bar_class', $classes, $class );
		$classes = array_unique( $classes );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_sidebar_class' ) ) :
	/**
	 * Adds css classes into the sidebar
	 *
	 * @param string $class css classname.
	 */
	function tik_sidebar_class( $class = '' ) {

		$classes = array();

		$classes = array_map( 'esc_attr', $classes );

		$clasess = apply_filters( 'tik_sidebar_class', $classes, $class );
		$classes = array_unique( $clasess );

		echo join( ' ', $classes ); // WPCS: XSS ok.

	}
endif;

if ( ! function_exists( 'tik_get_title' ) ) :
	/**
	 * Returns page title.
	 *
	 * @return string
	 */
	function tik_get_title() {

		if ( is_archive() ) {
			if ( is_category() ) :
				$page_title = single_cat_title( '', false );

			elseif ( is_tag() ) :
				$page_title = single_tag_title( '', false );

			elseif ( is_author() ) :
				/**
				 * Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 */
				the_post();
				/* translators: %s: author. */
				$page_title = sprintf( esc_html__( 'Author: %s', 'tik' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/**
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				/* translators: %s: day */
				$page_title = sprintf( esc_html__( 'Day: %s', 'tik' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				/* translators: %s: month */
				$page_title = sprintf( esc_html__( 'Month: %s', 'tik' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				/* translators: %s: year. */
				$page_title = sprintf( esc_html__( 'Year: %s', 'tik' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( tik_is_woocommerce_active() && function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
				$page_title = woocommerce_page_title( false );

			else :
				$page_title = esc_html__( 'Archives', 'tik' );

			endif;
		} elseif ( is_404() ) {
			$page_title = esc_html__( 'Page Not Found', 'tik' );
		} elseif ( is_search() ) {
			$page_title = esc_html__( 'Search Results', 'tik' );
		} elseif ( is_page() ) {
			$page_title = get_the_title();
		} elseif ( is_single() ) {
			$page_title = get_the_title();
		} elseif ( is_home() ) {
			$queried_id = get_option( 'page_for_posts' );
			$page_title = get_the_title( $queried_id );
		} else {
			$page_title = '';
		}

		return apply_filters( 'tik_title', $page_title );
	}
endif;

if ( ! function_exists( 'tik_get_current_layout' ) ) :
	/**
	 * Get the current layout of the page
	 *
	 * @return string layout.
	 */
	function tik_get_current_layout() {
		$layout            = '';
		$individual_layout = get_post_meta( tik_get_post_id(), 'tik_layout', true );

		if ( isset( $individual_layout ) && ! empty( $individual_layout ) && 'tg-site-layout--customizer' !== $individual_layout ) {
			$layout = $individual_layout;
		} elseif ( apply_filters( 'tik_pro_current_layout', '' ) ) {
			$layout = apply_filters( 'tik_pro_current_layout', '' );
		} else {
			switch ( true ) {

				case ( is_singular( 'page' ) || is_404() ):
					if ( tik_is_woocommerce_active() && ( is_checkout() || is_cart() || is_account_page() ) ) {
						$layout = get_theme_mod( 'tik_structure_wc', 'tg-site-layout--right' );
					} else {
						$layout = get_theme_mod( 'tik_structure_page', 'tg-site-layout--right' );
					}

					break;

				case ( is_singular() ):
					if ( tik_is_woocommerce_active() && is_product() ) { // WC single product.
						$layout = get_theme_mod( 'tik_structure_wc_product', 'tg-site-layout--right' );
					} else {
						$layout = get_theme_mod( 'tik_structure_post', 'tg-site-layout--right' );
					}

					break;

				case ( is_archive() || is_home() ):
					if ( tik_is_woocommerce_active() && is_woocommerce() ) {
						$layout = get_theme_mod( 'tik_structure_wc', 'tg-site-layout--right' );
					} else {
						$layout = get_theme_mod( 'tik_structure_archive', 'tg-site-layout--right' );
					}

					break;

				default:
					$layout = get_theme_mod( 'tik_structure_default', 'tg-site-layout--right' );
			}
		}

		return apply_filters( 'tik_current_layout', $layout );
	}
endif;

if ( ! function_exists( 'tik_insert_mod_hatom_data' ) ) :

	/**
	 * Adding the support for the entry-title tag for Google Rich Snippets.
	 *
	 * @param  string $content The post content.
	 *
	 * @return string hatom data.
	 */
	function tik_insert_mod_hatom_data( $content ) {

		$title = get_the_title();

		if ( is_single() && 'page-header' === tik_is_page_title_enabled() ) {
			$content .= '<div class="extra-hatom"><span class="entry-title">' . $title . '</span></div>';
		}

		return $content;

	}

	add_filter( 'the_content', 'tik_insert_mod_hatom_data' );

endif;

if ( ! function_exists( 'tik_entry_title' ) ) :

	/**
	 * Generate title for page, post, archive.
	 */
	function tik_entry_title() {

		if ( 'page-header' !== tik_is_page_title_enabled() || is_front_page() ) {

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title tg-page-content__title">', '</h1>' );
			elseif ( is_archive() ) :
				the_archive_title( '<h1 class="page-title tg-page-content__title">', '</h1>' );
			elseif ( is_404() ) :
				?>
				<h1 class="page-title tg-page-content__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tik' ); ?></h1>
			<?php
			else :
				the_title( '<h2 class="entry-title tg-page-content__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

		}

	}

endif;

if ( ! function_exists( 'tik_get_image_by_id' ) ) :

	/**
	 * Get image HTML by id.
	 *
	 * @param int $id          ID of the logo image attachment.
	 * @param int $attr        HTML alt for image.
	 * @param int $default_alt Default alt value.
	 */
	function tik_get_image_by_id( $id, $attr, $default_alt = '' ) {

		// Get image alt.
		$image_alt = get_post_meta( tik_get_post_id(), '_wp_attachment_image_alt', true );

		if ( empty( $image_alt ) && ! empty( $default_alt ) ) {
			$attr['alt'] = $default_alt;
		}

		$image_html = wp_get_attachment_image( $id, 'full', false, $attr );

		return $image_html;

	}

endif;

if ( ! function_exists( 'tik_insert_primary_menu_item' ) ) :

	/**
	 * Get search icon in primary menu list.
	 *
	 * @param  string $items Menu html.
	 * @param  object $args  Menu arguments.
	 *
	 * @return string Menu HTML.
	 */
	function tik_insert_primary_menu_item( $items, $args ) {

		if ( apply_filters( 'tik_header_action_menu_location', 'menu-primary' ) === $args->theme_location ) {
			$items .= tik_search_icon_menu_item();

			if ( class_exists( 'WooCommerce' ) ) {
				$items .= apply_filters( 'tik_woocommerce_header_cart', '' );
			}
		}

		return $items;

	}


endif;
add_filter( 'wp_nav_menu_items', 'tik_insert_primary_menu_item', 10, 2 );

if ( ! function_exists( 'tik_menu_fallback' ) ) :

	/**
	 * Menu fallback for primary menu.
	 *
	 * Contains wp_list_pages to display pages created,
	 * search icons and WooCommerce cart icon.
	 */
	function tik_menu_fallback() {
		$output = '';
		$output .= '<div id="primary-menu" class="menu-primary">';
		$output .= '<ul>';

		$output .= wp_list_pages(
			array(
				'echo'     => false,
				'title_li' => false,
			)
		);

		$output .= tik_search_icon_menu_item();

		if ( class_exists( 'WooCommerce' ) ) {
			$output .= tik_woocommerce_header_cart();
		}

		$output .= '</ul>';
		$output .= '</div>';

		// @codingStandardsIgnoreStart
		echo $output;
		// @codingStandardsIgnoreEnd
	}

endif;

if ( ! function_exists( 'tik_shift_extra_menu' ) ) :
	/**
	 * Keep menu items on one line.
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 *
	 * @return string HTML for more button.
	 */
	function tik_shift_extra_menu( $items, $args ) {

		if ( 'menu-primary' === $args->theme_location && get_theme_mod( 'tik_primary_menu_extra', false ) ) :

			$items .= '<li class="menu-item menu-item-has-children tg-menu-extras-wrap">';
			$items .= '<span class="submenu-expand">';
			$items .= '<i class="fa fa-ellipsis-v"></i>';
			$items .= '</span>';
			$items .= '<ul class="sub-menu" id="tg-menu-extras">';
			$items .= '</ul>';
			$items .= '</li>';

		endif;

		return $items;
	}
endif;
add_filter( 'wp_nav_menu_items', 'tik_shift_extra_menu', 9, 2 );

if ( ! function_exists( 'tik_header_button_append' ) ) :
	/**
	 * Header button.
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 *
	 * @return string HTML for header button item.
	 */
	function tik_header_button_append( $items, $args ) {

		$button_text   = get_theme_mod( 'tik_header_button_text' );
		$button_link   = get_theme_mod( 'tik_header_button_link' );
		$button_target = get_theme_mod( 'tik_header_button_target' );
		$button_target = $button_target ? ' target="_blank"' : '';

		if ( 'menu-primary' === $args->theme_location && $button_text ) {

			$items .= '<li class="menu-item tg-header-button-wrap">';
			$items .= '<a href="' . esc_url( $button_link ) . '"' . esc_attr( $button_target ) . '>';
			$items .= $button_text;
			$items .= '</a>';
			$items .= '</li>';

		}

		return $items;
	}
endif;
add_filter( 'wp_nav_menu_items', 'tik_header_button_append', 8, 2 );
