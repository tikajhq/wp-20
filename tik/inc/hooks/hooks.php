<?php
/**
 * Tik hooks.
 *
 * @package tik
 */

/* ------------------------------ HEADER ------------------------------ */
/**
 * Header doctype.
 *
 * @see tik_doctype()
 */
add_action( 'tik_action_doctype', 'tik_doctype', 10 );

/**
 * HTML head.
 *
 * @see tik_head()
 */
add_action( 'tik_action_head', 'tik_head', 10 );

/**
 * Before page.
 *
 * @see tik_page_start()
 * @see tik_skip_content_link()
 */
add_action( 'tik_action_before', 'tik_page_start', 10 );
add_action( 'tik_action_before', 'tik_skip_content_link', 15 );

/**
 * Before header.
 *
 * @see tik_transparent_header_start()
 * @see tik_header_start()
 */
add_action( 'tik_action_before_header', 'tik_transparent_header_start', 10 );
add_action( 'tik_action_before_header', 'tik_header_start', 15 );

/**
 * Header top.
 *
 * @see tik_header_top()
 */
add_action( 'tik_action_header_top', 'tik_header_top', 10 );

/**
 * Header top left content.
 *
 * @see tik_header_top_left_content()
 */
add_action( 'tik_action_header_top_left_content', 'tik_header_top_left_content', 10 );

/**
 * Header top right content.
 *
 * @see tik_header_top_right_content()
 */
add_action( 'tik_action_header_top_right_content', 'tik_header_top_right_content', 10 );

/**
 * Before header main.
 *
 * @see tik_before_header_main()
 */
add_action( 'tik_action_before_header_main', 'tik_before_header_main', 10 );

/**
 * Header main.
 *
 * @see tik_header_main_site_branding()
 * @see tik_header_main_site_navigation()
 * @see tik_header_main_action()
 */
add_action( 'tik_action_header_main', 'tik_header_main_site_branding', 10 );
add_action( 'tik_action_header_main', 'tik_header_main_site_navigation', 15 );
add_action( 'tik_action_header_main', 'tik_header_main_action', 20 );

/**
 * Header: Site navigation.
 *
 * @see tik_site_navigation()
 */
add_action( 'tik_action_site_navigation', 'tik_site_navigation', 10 );

/**
 * Header: Header action.
 *
 * @see tik_header_action()
 */
add_action( 'tik_action_header_main_action', 'tik_header_action', 10 );

/**
 * After header main.
 *
 * @see tik_after_header_main()
 */
add_action( 'tik_action_after_header_main', 'tik_after_header_main', 10 );

/**
 * After header.
 *
 * @see tik_header_end()
 * @see tik_transparent_header_end()
 * @see tik_header_media_markup()
 */
add_action( 'tik_action_after_header', 'tik_header_end', 10 );
add_action( 'tik_action_after_header', 'tik_transparent_header_end', 15 );
add_action( 'tik_action_after_header', 'tik_header_media_markup', 20 );

/* ------------------------------ CONTENT ------------------------------ */
/**
 * Header Breadcrumbs.
 *
 * @see tik_breadcrumbs()
 */
add_action( 'tik_action_breadcrumbs', 'tik_breadcrumbs', 10 );

/**
 * Before content.
 *
 * @see tik_main_start()
 * @see tik_page_header()
 * @see tik_content_start()
 */
add_action( 'tik_action_before_content', 'tik_main_start', 10 );
add_action( 'tik_action_before_content', 'tik_page_header', 15 );
add_action( 'tik_action_before_content', 'tik_content_start', 20 );

/* ------------------------------ FOOTER ------------------------------ */
/**
 * After content.
 *
 * @see tik_content_end()
 * @see tik_main_end()
 */
add_action( 'tik_action_after_content', 'tik_content_end', 10 );
add_action( 'tik_action_after_content', 'tik_main_end', 15 );

/**
 * Before footer.
 *
 * @see tik_footer_start()
 */
add_action( 'tik_action_before_footer', 'tik_footer_start', 10 );

/**
 * Footer widgets.
 *
 * @see tik_footer_widgets()
 */
add_action( 'tik_action_footer_widgets', 'tik_footer_widgets', 10 );

/**
 * Footer bar.
 *
 * @see tik_footer_bottom_bar()
 */
add_action( 'tik_action_footer_bottom_bar', 'tik_footer_bottom_bar', 10 );

/**
 * Footer bar section one.
 *
 * @see tik_footer_bottom_bar_one()
 */
add_action( 'tik_action_footer_bottom_bar_one', 'tik_footer_bottom_bar_one', 10 );

/**
 * Footer bar section two.
 *
 * @see tik_footer_bottom_bar_two()
 */
add_action( 'tik_action_footer_bottom_bar_two', 'tik_footer_bottom_bar_two', 10 );

/**
 * After footer.
 *
 * @see tik_footer_end()
 */
add_action( 'tik_action_after_footer', 'tik_footer_end', 10 );

/**
 * After page.
 *
 * @see tik_page_end()
 */
add_action( 'tik_action_after', 'tik_page_end', 10 );

/**
 * Mobile navigation.
 *
 * @see tik_mobile_navigation()
 */
add_action( 'tik_action_after', 'tik_mobile_navigation', 15 );

/**
 * Scroll to top.
 *
 * @see tik_scroll_to_top()
 */
add_action( 'tik_action_after', 'tik_scroll_to_top', 20 );

/**
 * Archive posts navigation.
 *
 * @see tik_posts_navigation()
 */
add_action( 'tik_after_posts_the_loop', 'tik_posts_navigation', 10 );

/**
 * Single post navigation.
 *
 * @see tik_post_navigation()
 */
add_action( 'tik_after_single_post_content', 'tik_post_navigation', 10 );

/**
 * Post content.
 *
 * @see tik_entry_content()
 */
add_action( 'tik_action_entry_content', 'tik_entry_content', 10 );

/**
 * Post read more.
 *
 * @see tik_entry_content()
 */
add_action( 'tik_post_readmore', 'tik_post_readmore', 10 );
