<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Tik_Dashboard {
	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function create_menu() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'tik' ), $theme->Name );

		add_theme_page( $theme_page_name, $theme_page_name, 'edit_theme_options', 'tik-options', array(
			$this,
			'option_page'
		) );
	}

	public function option_page() {
		$theme        = wp_get_theme();
		$support_link = ( tik_is_tik_pro_active() ) ? 'https://tiktheme.com/support-ticket/' : 'https://wordpress.org/support/theme/tik/';
		?>
        <div class="wrap">
            <div class="tik-header">
                <h1>
                    <?php
                    /* translators: %s: Theme version. */
                    echo sprintf( esc_html__( 'Tik %s', 'tik' ), TIK_THEME_VERSION );
                    ?>
                </h1>
            </div> <!-- /.tik-header -->

            <div class="welcome-panel">
                <div class="welcome-panel-content">
                    <h2>
                        <?php
                        /* translators: %s: Theme Name. */
                        echo sprintf( esc_html__( 'Welcome to %s!', 'tik' ), $theme->Name );
                        ?>
                    </h2>

                    <p class="about-description"><?php esc_html_e( 'Important links to get you started with Tik', 'tik' ); ?></p>

                    <div class="welcome-panel-column-container">
                        <div class="welcome-panel-column">
                            <h3><?php esc_html_e( 'Get Started', 'tik' ); ?></h3>
                            <a class="button button-primary button-hero"
                               href="<?php echo esc_url( 'https://docs.tiktheme.com/en/category/getting-started-1470csx/' ); ?>"
                               target="_blank"><?php esc_html_e( 'Learn Basics', 'tik' ); ?>
                            </a>
                        </div>

                        <div class="welcome-panel-column">
                            <h3><?php esc_html_e( 'Next Steps', 'tik' ); ?></h3>
                            <ul>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-media-text">' . esc_html__( 'Documentation', 'tik' ) . '</a>', esc_url( 'https://docs.tiktheme.com/en/' ) ); ?></li>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-layout">' . esc_html__( 'Starter Demos', 'tik' ) . '</a>', esc_url( 'https://tiktheme.com/demos/' ) ); ?></li>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-migrate">' . esc_html__( 'Premium Version', 'tik' ) . '</a>', esc_url( 'https://tiktheme.com/pro/' ) ); ?></li>
                            </ul>
                        </div>

                        <div class="welcome-panel-column">
                            <h3><?php esc_html_e( 'Further Actions', 'tik' ); ?></h3>
                            <ul>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-businesswoman">' . esc_html__( 'Got theme support question?', 'tik' ) . '</a>', esc_url( $support_link ) ); ?></li>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-groups">' . esc_html__( 'Join Tik Facebook Community', 'tik' ) . '</a>', esc_url( 'https://www.facebook.com/groups/tiktheme/' ) ); ?></li>
                                <li><?php printf( '<a target="_blank" href="%s" class="welcome-icon dashicons-thumbs-up">' . esc_html__( 'Leave a review', 'tik' ) . '</a>', esc_url( 'https://wordpress.org/support/theme/tik/reviews/' ) ); ?></li>
                            </ul>
                        </div>
                    </div> <!-- /.welcome-panel-column-container -->
                </div> <!-- /.welcome-panel-content -->
            </div> <!-- /.welcome-panel -->
		<?php
	}
}

Tik_Dashboard::instance();
