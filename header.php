<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tik
 */

/**
 * Functions hooked into tik_action_doctype action
 *
 * @hooked tik_doctype - 10
 */
do_action( 'tik_action_doctype' );
?>

	<head>

		<?php
		/**
		 * Hook - tik_action_head
		 *
		 * Functions hooked into tik_action_head action
		 *
		 * @hooked tik_head - 10
		 */
		do_action( 'tik_action_head' );
		?>

		<?php wp_head(); ?>

	</head>

<body <?php body_class(); ?>>

<?php
/**
 * WordPress function to load custom scripts after body.
 *
 * Introduced in WordPress 5.2.0
 *
 * @since Tik 1.2.3
 */
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php
/**
 * Hook - tik_action_before
 *
 * @hooked tik_page_start - 10
 * @hooked tik_skip_to_content - 15
 */
do_action( 'tik_action_before' );
?>

<?php
/**
 * Hook - tik_action_before_header
 *
 * @hooked tik_header_start - 10
 */
do_action( 'tik_action_before_header' );
?>

<?php
/**
 * Hook - tik_action_header_top
 *
 * @hooked tik_header_top - 10
 */
do_action( 'tik_action_header_top' );
?>

<?php
/**
 * Hook - tik_action_before_header_main
 *
 * @hooked tik_before_header_main - 10
 */
do_action( 'tik_action_before_header_main' );
?>

<?php
/**
 * Hook - tik_action_header_main
 *
 * @hooked tik_header_main_site_branding - 10
 * @hooked tik_header_main_site_navigation - 15
 * @hooked tik_header_main_action- 20
 */
do_action( 'tik_action_header_main' );
?>

<?php
/**
 * Hook - tik_action_after_header_main
 *
 * @hooked tik_header - 10
 */
do_action( 'tik_action_after_header_main' );
?>

<?php
/**
 * Hook - tik_action_after_header
 *
 * @hooked tik_header_end - 10
 */
do_action( 'tik_action_after_header' );
?>

<?php
/**
 * Hook - tik_action_before_content.
 *
 * @hooked tik_main_start - 10
 * @hooked tik_page_header - 15
 * @hooked tik_content_start - 20
 */
do_action( 'tik_action_before_content' );
