<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tik
 */

get_header();
?>

	<div id="primary" class="content-area">
		<?php echo apply_filters( 'tik_after_primary_start_filter', false ); // WPCS: XSS OK. ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-single', get_post_type() );

			do_action( 'tik_after_single_post_content' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<?php echo apply_filters( 'tik_after_primary_end_filter', false ); // // WPCS: XSS OK. ?>
     	<?php if ( is_active_sidebar( 'footer-post' ) ) : ?>
			<?php dynamic_sidebar( 'footer-post' ); ?>
		<?php endif; ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
