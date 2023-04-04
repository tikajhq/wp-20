<?php
/**
 * Template part for displaying posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tik
 */

$meta_style = get_theme_mod( 'tik_blog_archive_meta_style', 'tg-meta-style-one' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $meta_style ); ?>>

	<?php
	/**
	 * Hook - tik_action_entry_content
	 *
	 * Functions hooked into tik_action_entry_content action
	 *
	 * @hooked tik_entry_content - 10
	 */
	do_action( 'tik_action_entry_content' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
