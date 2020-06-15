<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tik
 */

// Hide sidebar when sidebar is not present.
if ( in_array( tik_get_current_layout(), array( 'tg-site-layout--no-sidebar', 'tg-site-layout--default', 'tg-site-layout--stretched' ), true ) ) {
	return;
}

// Get site layout from customizer and page setting.
$current_sidebar = tik_get_current_layout();

// Get which sidebar content to show in Sidebar.
$sidebar_meta = get_post_meta( tik_get_post_id(), 'tik_sidebar', true );

$sidebar = '';

if ( $sidebar_meta ) {
	$sidebar = $sidebar_meta;
} else {
	if ( 'tg-site-layout--left' === $current_sidebar ) {
		$sidebar = 'sidebar-left';
	} else {
	    $sidebar = 'sidebar-right';
    }
}

if ( ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<aside id="secondary" class="tg-site-sidebar widget-area <?php tik_sidebar_class(); ?>">
	<?php
	if ( ! empty( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	}
	?>
</aside><!-- #secondary -->
