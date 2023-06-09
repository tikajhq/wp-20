<?php
/**
 * TIKAJ functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 * @package tik
 */

if ( ! function_exists( 'tik_setup' ) ) :
	// Sets up theme defaults and registers support for various WordPress features.
	function tik_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'tik', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register menu.
		register_nav_menus( array(
			'menu-primary' => esc_html__( 'Primary', 'tik' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 170,
			'height'      => 60,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Custom background support.
		add_theme_support( 'custom-background' );

		// Gutenberg Wide/fullwidth support.
		add_theme_support( 'align-wide' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Responsive embeds support.
		add_theme_support( 'responsive-embeds' );

		// AMP support.
		if ( defined( 'AMP__VERSION' ) && ( ! version_compare( AMP__VERSION, '1.0.0', '<' ) ) ) {
			add_theme_support( 'amp',
				apply_filters(
					'tik_amp_support_filter',
					array(
						'paired' => true,
					)
				)
			);
		}
	}
endif;
add_action( 'after_setup_theme', 'tik_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tik_widgets_init() {
	$sidebars = apply_filters( 'tik_sidebars_args', array(
		'sidebar-right'            => esc_html__( 'Sidebar Right', 'tik' ),
		'sidebar-left'             => esc_html__( 'Sidebar Left', 'tik' ),
		'header-top-left-sidebar'  => esc_html__( 'Header Top Bar Left Sidebar', 'tik' ),
		'header-top-right-sidebar' => esc_html__( 'Header Top Bar Right Sidebar', 'tik' ),
		'footer-sidebar-1'         => esc_html__( 'Footer One', 'tik' ),
		'footer-sidebar-2'         => esc_html__( 'Footer Two', 'tik' ),
		'footer-sidebar-3'         => esc_html__( 'Footer Three', 'tik' ),
		'footer-sidebar-4'         => esc_html__( 'Footer Four', 'tik' ),
		'footer-post'              => esc_html__( 'Footer of Post', 'tik' ),
	) );


	foreach ( $sidebars as $id => $name ) {
		register_sidebar( array(
			'id'            => $id,
			'name'          => $name,
			'description'   => esc_html__( 'Add widgets here.', 'tik' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}

add_action( 'widgets_init', 'tik_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tik_scripts() {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/**
	 * Styles.
	 */
	// Font Awesome 4.
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/lib/font-awesome/css/font-awesome' . $suffix . '.css', false, '4.7.0' );
	wp_enqueue_style( 'font-awesome' );

	// Theme style.
	wp_register_style( 'tik-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tik-style' );

	// Support RTL.
	wp_style_add_data( 'tik-style', 'rtl', 'replace' );

	// Do not load scripts if AMP.
	if ( tik_is_amp() ) {
		return;
	}

	/**
	 * Scripts.
	 */
	wp_enqueue_script( 'tik-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(), '20151215', true );
	wp_enqueue_script( 'tik-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20151215', true );

	// Theme JavaScript.
	wp_enqueue_script( 'tik-custom', get_template_directory_uri() . '/assets/js/tik-custom' . $suffix . '.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tik_scripts' );

/**
 * Enqueue block editor styles.
 *
 * @since Tik 1.4.3
 */
// function tik_block_editor_styles() {
// 	wp_enqueue_style( 'tik-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css' );
// }
// add_action( 'enqueue_block_editor_assets', 'tik_block_editor_styles', 1, 1 );

/**
 * Define constants.
 */
define( 'TIK_PARENT_DIR', get_template_directory() );
define( 'TIK_PARENT_URI', get_template_directory_uri() );
define( 'TIK_PARENT_INC_DIR', TIK_PARENT_DIR . '/inc' );
define( 'TIK_PARENT_INC_URI', TIK_PARENT_URI . '/inc' );
define( 'TIK_PARENT_INC_ICON_URI', TIK_PARENT_URI . '/assets/img/icons' );
define( 'TIK_PARENT_CUSTOMIZER_DIR', TIK_PARENT_INC_DIR . '/customizer' );

// Theme version.
$tik_theme = wp_get_theme( 'tik' );
define( 'TIK_THEME_VERSION', $tik_theme->get( 'Version' ) );

// AMP support files.
if ( defined( 'AMP__VERSION' ) && ( ! version_compare( AMP__VERSION, '1.0.0', '<' ) ) ) {
	require_once TIK_PARENT_INC_DIR . '/compatibility/amp/amp.php';
}

/**
 * Include files.
 */
require TIK_PARENT_INC_DIR . '/helpers.php';
require TIK_PARENT_INC_DIR . '/custom-header.php';
require TIK_PARENT_INC_DIR . '/class-tik-dynamic-filter.php';
require TIK_PARENT_INC_DIR . '/template-tags.php';
require TIK_PARENT_INC_DIR . '/template-functions.php';
require TIK_PARENT_INC_DIR . '/customizer/class-tik-customizer.php';
require TIK_PARENT_INC_DIR . '/class-tik-css-classes.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require TIK_PARENT_INC_DIR . '/jetpack.php';
}
// Load hooks.
require TIK_PARENT_INC_DIR . '/hooks/hooks.php';
require TIK_PARENT_INC_DIR . '/hooks/header.php';
require TIK_PARENT_INC_DIR . '/hooks/footer.php';
require TIK_PARENT_INC_DIR . '/hooks/content.php';
require TIK_PARENT_INC_DIR . '/migration.php';

// Breadcrumbs class.
// require_once TIK_PARENT_INC_DIR . '/class-breadcrumb-trail.php';

// Admin screen.
if ( is_admin() ) {
	// Meta boxes.
	require TIK_PARENT_INC_DIR . '/meta-boxes/class-tik-meta-box-page-settings.php';
	require TIK_PARENT_INC_DIR . '/meta-boxes/class-tik-meta-box.php';

	// Theme options page.
	require TIK_PARENT_INC_DIR . '/admin/class-tik-admin.php';
	require TIK_PARENT_INC_DIR . '/admin/class-tik-notice.php';
	// require TIK_PARENT_INC_DIR . '/admin/class-tik-welcome-notice.php';`
	// require TIK_PARENT_INC_DIR . '/admin/class-tik-upgrade-notice.php';
	require TIK_PARENT_INC_DIR . '/admin/class-tik-dashboard.php';
	// require TIK_PARENT_INC_DIR . '/admin/class-tik-theme-review-notice.php';
	// require TIK_PARENT_INC_DIR . '/admin/class-tik-tdi-notice.php';
}

// Set default content width.
if ( ! isset( $content_width ) ) {
	$content_width = 812;
}

// Calculate $content_width value according to layout options from Customizer and meta boxes.
function tik_content_width_rdr() {
	global $content_width;

	// Get layout type.
	$layout_type     = tik_get_layout_type();
	$layouts_sidebar = array( 'tg-site-layout--left', 'tg-site-layout--right' );

	/**
	 * Calculate content width.
	 */
	// Get required values from Customizer.
	$container_width_arr = get_theme_mod( 'tik_general_container_width', array(
		'slider' => 1160,
		'suffix' => 'px',
	) );

	$content_width_arr   = get_theme_mod( 'tik_general_content_width', array(
		'slider' => 70,
		'suffix' => '%',
	) );

	// Calculate Padding to reduce.
	$container_style = get_theme_mod( 'tik_general_container_style', 'tg-container--wide' );
	$content_padding = ( 'tg-container--separate' === $container_style ) ? 120 : 60;

	if ( in_array( $layout_type, $layouts_sidebar, true ) ) {
		$content_width = ( ( (int) $container_width_arr['slider'] * (int) $content_width_arr['slider'] ) / 100 ) - $content_padding;
	} else {
		$content_width = (int) $container_width_arr['slider'] - $content_padding;
	}

}
add_action( 'template_redirect', 'tik_content_width_rdr' );

if ( ! function_exists( 'tik_stretched_style_migrate' ) ) :
	/**
	 * Migrate `Stretched` container style to `Layout`.
	 */
	function tik_stretched_style_migrate() {

		$container_style = get_theme_mod( 'tik_general_container_style', 'tg-container--wide' );

		$layout_arr = array( 'tg-site-layout--left', 'tg-site-layout--right' );

		$page_types = array( 'default', 'archive', 'post', 'page' );

		// Lets bail out if container style is not stretched.
		if ( 'tg-container--stretched' != $container_style ) {
			return;
		}

		// Lets bail out if 'tik_stretched_style_transfer' option found.
		if ( get_option( 'tik_stretched_style_transfer' ) ) {
			return;
		}

		set_theme_mod( 'tik_general_container_style', 'tg-container--wide' );

		foreach ( $page_types as $page_type ) {
			$layout = get_theme_mod( 'tik_structure_' . $page_type, 'tg-site-layout--right' );

			// Do nothing if left or right sidebar enabled.
			if ( ! in_array( $layout, $layout_arr ) ) {
				set_theme_mod( 'tik_structure_' . $page_type, 'tg-site-layout--stretched' );
			}
		}

		// Set transfer as complete.
		update_option( 'tik_stretched_style_transfer', 1 );
	}
endif;
add_action( 'after_setup_theme', 'tik_stretched_style_migrate' );

/*=============================================
                BREADCRUMBS
=============================================*/
function the_breadcrumb()
{
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '<span class="delimiter"> &rsaquo; </span>'; // delimiter between crumbs
    $home = 'Home'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo '<div id="header-breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
        }
    } else {
        echo '<div id="header-breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                if ($showCurrent == 1) {
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) {
                    echo ' ' . $delimiter . ' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ' (';
            }
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ')';
            }
        }
        echo '</div>';
    }
} // end the_breadcrumb()

// Shortcode to output Breadcrumb in Elementor
function wpc_elementor_breadcrumb_shortcode( $atts ) {
	if (function_exists('the_breadcrumb')) the_breadcrumb();
}
add_shortcode( 'show_breadcrumb', 'wpc_elementor_breadcrumb_shortcode');


// Description in Menu
function add_description_to_menu($item_output, $item, $depth, $args) {
    if (strlen($item->description) > 0 ) {
        // append description after link
//         $item_output .= sprintf('<span class="description">%s</span>', esc_html($item->description));
		$item_output = str_replace( $args->link_after . '</a>', '<br/><div class="description">' . esc_html($item->description) . '</div>' . $args->link_after . '</a>', $item_output );

        // insert description as last item *in* link ($input_output ends with "</a>{$args->after}")
        //$item_output = substr($item_output, 0, -strlen("</a>{$args->after}")) . sprintf('<span class="description">%s</span >', esc_html($item->description)) . "</a>{$args->after}";
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_description_to_menu', 10, 4);

// Get top parent page id
function get_top_parent_page_id() { 
	$post = get_post( $post );
 
    if ( ! $post || empty( $post->post_parent ) || $post->post_parent == $post->ID ) {
        return array();
    }
 
    $ancestors = array();
 
    $id = $post->post_parent;
    $ancestors[] = $id;
 
    while ( $ancestor = get_post( $id ) ) {
        // Loop detection: If the ancestor has been seen before, break.
        if ( empty( $ancestor->post_parent ) || ( $ancestor->post_parent == $post->ID ) || in_array( $ancestor->post_parent, $ancestors ) ) {
            break;
        }
 
        $id = $ancestor->post_parent;
        $ancestors[] = $id;
    }
 
    return $ancestors;
}


// Shortcode to output Breadcrumb in Elementor
function wpc_elementor_parentID_shortcode( $atts ) {
	if (function_exists('get_top_parent_page_id')) {
		$parent_page_id = (get_top_parent_page_id()[0]);
		wp_list_pages( array(
			'title_li' => "Related pages",
			'exclude' => get_the_ID(),
			'child_of' => $parent_page_id,
		) );
	}
}
add_shortcode( 'show_related_pages', 'wpc_elementor_parentID_shortcode');


function tikaj_enqueue_fonts() {
	wp_enqueue_style( 'Josefin Sans', 'https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500;600;700&display=swap' ); 
	wp_enqueue_style( 'Lato', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap' ); 
}
add_action( 'wp_enqueue_scripts', 'tikaj_enqueue_fonts' );
