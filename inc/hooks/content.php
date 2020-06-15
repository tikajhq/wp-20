<?php
/**
 * Tik content area functions to be hooked.
 *
 * @package tik
 */

if ( ! function_exists( 'tik_posts_navigation' ) ) :
	/**
	 * Archive navigation.
	 */
	function tik_posts_navigation() {
		the_posts_navigation();
	}
endif;

if ( ! function_exists( 'tik_post_navigation' ) ) :
	/**
	 * Archive navigation.
	 */
	function tik_post_navigation() {
		the_post_navigation();
	}
endif;

if ( ! function_exists( 'tik_entry_content' ) ) :
	/**
	 * Archive navigation.
	 */
	function tik_entry_content() {
		get_template_part( 'template-parts/blog/blog', 'post-layout' );
	}
endif;

if ( ! function_exists( 'tik_post_readmore' ) ) :
	/**
	 * Post read more HTML.
	 *
	 * @param string $readmore_alignment CSS class.
	 */
	function tik_post_readmore( $readmore_alignment ) {
		?>
		<div class="<?php tik_css_class( 'tik_read_more_wrapper_class' ); ?> tg-text-align--<?php echo esc_attr(
			$readmore_alignment ); ?>">
			<a href="<?php the_permalink(); ?>" class="tg-read-more">
				<?php echo apply_filters( 'tik_read_more_text', esc_html__( 'Read More', 'tik' ) ); // WPCS: XSS OK. ?></a>
		</div>
		<?php
	}
endif;
