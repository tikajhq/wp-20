<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tik
 */

?>

	<?php
	/**
	 * Hook - tik_action_after_content.
	 *
	 * @hooked tik_content_end - 10
	 * @hooked tik_main_end - 15
	 */
	do_action( 'tik_action_after_content' );
	?>

	<?php
	/**
	 * Hook - tik_action_before_footer
	 *
	 * @hooked tik_footer_start - 10
	 */
	do_action( 'tik_action_before_footer' );
	?>

		<?php
		/**
		 * Hook - tik_action_footer_widgets
		 *
		 * @hooked tik_footer_widgets - 10
		 */
		do_action( 'tik_action_footer_widgets' );
		?>

		<?php
		/**
		 * Hook - tik_action_footer_bottom_bar
		 *
		 * @hooked tik_footer_bottom_bar - 10
		 */
		do_action( 'tik_action_footer_bottom_bar' );
		?>

	<?php
		/**
		 * Hook - tik_action_after_footer
		 *
		 * @hooked tik_footer_end - 10
		 * @hooked tik_mobile_navigation - 15
		 * @hooked tik_scroll_to_top - 20
		 */
		do_action( 'tik_action_after_footer' );
	?>

<?php
/**
 * Hook - tik_action_after
 *
 * @hooked tik_page_end- 10
 */
do_action( 'tik_action_after' );
?>
<script>
	// Adding skelton loading to all megamenu.
	jQuery( document ).ready(function() {
		jQuery("#primary-menu > li.menu-item-has-children").addClass("skeleton-loading");
	});

	// Removing skelton loading on hover, after some time.
	jQuery("#primary-menu > li.menu-item-has-children").hover(function(){
		var thisVar = jQuery(this);
		setTimeout(function(){ 
			thisVar.removeClass("skeleton-loading");
		}, 700);
    });
</script>
<?php wp_footer(); ?>

</body>
</html>
