<?php
/**
 * Page Settings meta box class.
 *
 * @package tik
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Tik_Meta_Box_Page_Settings
 */
class Tik_Meta_Box_Page_Settings {

	/**
	 * Meta box render content callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public static function render( $post ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'tik_nonce_action', 'tik_meta_nonce' );

		$layout = get_post_meta( get_the_ID(), 'tik_layout' );
		$layout = isset( $layout[0] ) ? $layout[0] : 'tg-site-layout--customizer';

		$remove_content_margin = get_post_meta( get_the_ID(), 'tik_remove_content_margin' );
		$remove_content_margin = isset( $remove_content_margin[0] ) ? $remove_content_margin[0] : 0;

		$sidebar = get_post_meta( get_the_ID(), 'tik_sidebar' );
		$sidebar = isset( $sidebar[0] ) ? $sidebar[0] : 'default';

		$transparent_header = get_post_meta( get_the_ID(), 'tik_transparent_header' );
		$transparent_header = isset( $transparent_header[0] ) ? $transparent_header[0] : 'customizer';

		$page_header = get_post_meta( get_the_ID(), 'tik_page_header' );
		$page_header = isset( $page_header[0] ) ? $page_header[0] : 1;

		$header_style = get_post_meta( get_the_ID(), 'tik_header_style' );
		$header_style = isset( $header_style[0] ) ? $header_style[0] : 'default';

		$customize_menu_item_color        = get_theme_mod( 'tik_primary_menu_text_color', '#16181a' );
		$customize_menu_item_hover_color  = get_theme_mod( 'tik_primary_menu_text_hover_color', '#269bd1' );
		$customize_menu_item_active_color = get_theme_mod( 'tik_primary_menu_text_active_color', '#269bd1' );

		$menu_item_color = get_post_meta( get_the_ID(), 'tik_menu_item_color' );
		$menu_item_color = isset( $menu_item_color[0] ) ? $menu_item_color[0] : $customize_menu_item_color;

		$menu_item_hover_color = get_post_meta( get_the_ID(), 'tik_menu_item_hover_color' );
		$menu_item_hover_color = isset( $menu_item_hover_color[0] ) ? $menu_item_hover_color[0] : $customize_menu_item_hover_color;

		$menu_item_active_color = get_post_meta( get_the_ID(), 'tik_menu_item_active_color' );
		$menu_item_active_color = isset( $menu_item_active_color[0] ) ? $menu_item_active_color[0] : $customize_menu_item_active_color;

		$menu_item_active_style = get_post_meta( get_the_ID(), 'tik_menu_item_active_style' );
		$menu_item_active_style = isset( $menu_item_active_style[0] ) ? $menu_item_active_style[0] : '';

		/**
		 * Logo.
		 */
		global $post;

		// Get WordPress' media upload URL.
		$upload_link = get_upload_iframe_src( 'image', $post->ID );

		$logo = get_post_meta( $post->ID, 'tik_logo', true );

		$img_src = wp_get_attachment_image_src( $logo, 'full' );

		$has_img = is_array( $img_src );
		?>
		<div id="page-settings-tabs-wrapper">
			<ul class="tik-ui-nav">
				<?php
				$page_setting = apply_filters( 'tik_page_setting', array(
					'general'      => array(
						'label'  => __( 'General', 'tik' ),
						'target' => 'page-settings-general',
						'class'  => array(),
					),
					'header'       => array(
						'label'  => __( 'Header', 'tik' ),
						'target' => 'page-settings-header',
						'class'  => array(),
					),
					'primary_menu' => array(
						'label'  => __( 'Primary Menu', 'tik' ),
						'target' => 'page-settings-primary-menu',
						'class'  => array(),
					),
					'page-header'  => array(
						'label'  => __( 'Page Header', 'tik' ),
						'target' => 'page-settings-page-header',
						'class'  => array(),
					),
				) );

				foreach ( $page_setting as $key => $tab ) {
					?>
					<li>
						<a href="#<?php echo esc_html( $tab['target'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
					</li>
					<?php
				}

				?>
			</ul><!-- /.tik-ui-nav -->
			<div class="tik-ui-content">
				<!-- GENERAL -->
				<div id="page-settings-general">

					<!-- LAYOUT -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label><?php esc_html_e( 'Layout', 'tik' ); ?></label>
						</div>

						<div class="tik-ui-field">
							<?php
							$sidebar_layout_choices = apply_filters( 'tik_site_layout_choices', array(
								'tg-site-layout--default'    => TIK_PARENT_INC_ICON_URI . '/layout-default.png',
								'tg-site-layout--left'       => TIK_PARENT_INC_ICON_URI . '/left-sidebar.png',
								'tg-site-layout--right'      => TIK_PARENT_INC_ICON_URI . '/right-sidebar.png',
								'tg-site-layout--no-sidebar' => TIK_PARENT_INC_ICON_URI . '/full-width.png',
								'tg-site-layout--stretched'  => TIK_PARENT_INC_ICON_URI . '/stretched.png',
							) );

							$sidebar_layout_choices = array( 'tg-site-layout--customizer' => TIK_PARENT_URI . '/assets/img/icons/customizer.png' ) + $sidebar_layout_choices;

							foreach ( $sidebar_layout_choices as $layout_id => $image ) :
								?>
                                <label class="tg-label">
                                    <input type="radio" name="tik_layout" value="<?php echo esc_attr( $layout_id ); ?>>" <?php checked( $layout, $layout_id ); ?> />
                                    <img src="<?php echo esc_url( $image ); ?>"/>
                                </label>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- CONTENT MARGIN -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tik-content-margin"><?php esc_html_e( 'Remove content margin', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<input type="checkbox" id="tik-content-margin" name="tik_remove_content_margin" value="1" <?php checked( $remove_content_margin, 1 ); ?>>
						</div>
					</div>

					<!-- SIDEBAR -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tik-sidebar"><?php esc_html_e( 'Sidebar', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<select name="tik_sidebar" id="tik-sidebar">
                                <?php
                                $sidebars = array(
	                                'default'          => __( 'Default', 'tik' ),
	                                'sidebar-right'    => __( 'Sidebar Right', 'tik' ),
	                                'sidebar-left'     => __( 'Sidebar Left', 'tik' ),
	                                'footer-sidebar-1' => __( 'Footer One', 'tik' ),
	                                'footer-sidebar-2' => __( 'Footer Two', 'tik' ),
	                                'footer-sidebar-3' => __( 'Footer Three', 'tik' ),
	                                'footer-sidebar-4' => __( 'Footer Four', 'tik' ),
                                );

                                foreach ( $sidebars as $sidebar_id => $sidebar_label ) :
                                ?>
                                    <option value="<?php echo esc_attr( $sidebar_id ); ?>" <?php selected( $sidebar, $sidebar_id ); ?>><?php echo esc_html( $sidebar_label ); ?></option>
                                <?php endforeach; ?>
							</select>
						</div>
					</div>

					<?php
					/**
					 * Hook for general meta box display.
					 */
					do_action( 'tik_general_page_setting' );
					?>
				</div>

				<!-- HEADER -->
				<div id="page-settings-header">
					<!-- TRANSPARENT HEADER -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tik-transparent-header"><?php esc_html_e( 'Enable Transparent Header', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
                            <label class="tg-buttonset">
                                <input type="radio" name="tik_transparent_header"
                                       value="customizer" <?php checked( $transparent_header, 'customizer' );
								?> />
								<?php esc_html_e( 'Default', 'tik' ); ?>
                            </label>
                            <label class="tg-buttonset">
                                <input type="radio" name="tik_transparent_header"
                                       value="1" <?php checked( $transparent_header, '1' ); ?> />
								<?php esc_html_e( 'Enable', 'tik' ); ?>
                            </label>
                            <label class="tg-buttonset">
                                <input type="radio" name="tik_transparent_header"
                                       value="0" <?php checked( $transparent_header, '0' ); ?> />
								<?php esc_html_e( 'Disable', 'tik' ); ?>
                            </label>
                        </div>
					</div>

					<?php
						/**
						 * Hook for transparent header meta box display.
						 */
						do_action( 'tik_transparent_header_page_setting' );
					?>

                    <!-- LOGO -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tg-logo"><?php esc_html_e( 'Logo', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field" id="tg-logo-wrapper">

							<div class="tg-upload-img">
								<?php if ( $has_img ) : ?>
									<img src="<?php echo esc_url( $img_src[0] ); ?>" style="max-width:100%;"/>
								<?php endif; ?>
							</div>

							<p class="hide-if-no-js">
								<a class="upload-custom-img <?php echo ( $has_img ) ? 'hidden' : ''; ?>"
										href="<?php echo esc_url( $upload_link ); ?>">
									<?php esc_html_e( 'Upload Logo', 'tik' ); ?>
								</a>
								<a class="delete-custom-img <?php echo ( ! $has_img ) ? 'hidden' : ''; ?>"
										href="#">
									<?php esc_html_e( 'Remove Logo', 'tik' ); ?>
								</a>
							</p>

							<input id="tg-logo" name="tik_logo" class="tg-upload-input" type="hidden" value="<?php
							echo esc_attr( $logo ); ?>"/>
						</div>
					</div>

					<!-- STYLE -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tik-header-style"><?php esc_html_e( 'Style', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<?php
							$header_style_html  = '';
							$header_style_html .= '<label class="tg-label">';
							$header_style_html .= '<input type="radio" name="tik_header_style" value="default" ' . checked( $header_style, 'default', false ) . '/>';
							$header_style_html .= '<img src="' . esc_url( TIK_PARENT_URI . '/assets/img/icons/customizer.png' ) . '" title="From Customizer"/>';
							$header_style_html .= '</label>';
							$header_style_html .= '<label class="tg-label">';
							$header_style_html .= '<input type="radio" name="tik_header_style" value="tg-site-header--left" ' . checked( $header_style, 'tg-site-header--left', false ) . ' />';
							$header_style_html .= '<img src="' . esc_url( TIK_PARENT_URI . '/assets/img/icons/header-left.png' ) . '" title="Header Left"/>';
							$header_style_html .= '</label>';
							$header_style_html .= '<label class="tg-label">';
							$header_style_html .= '<input type="radio" name="tik_header_style" value="tg-site-header--center" ' . checked( $header_style, 'tg-site-header--center', false ) . '/>';
							$header_style_html .= '<img src=" ' . esc_url( TIK_PARENT_URI . '/assets/img/icons/header-center.png' ) . '" title="Header Center"/>';
							$header_style_html .= '</label>';

							$header_style_html .= '<label class="tg-label">';
							$header_style_html .= '<input type="radio" name="tik_header_style" value="tg-site-header--right" ' . checked( $header_style, 'tg-site-header--right', false ) . ' />';
							$header_style_html .= '<img src=" ' . esc_url( TIK_PARENT_URI . '/assets/img/icons/header-right.png' ) . '" title="Header Right" />';
							$header_style_html .= '</label>';
							?>

							<?php echo apply_filters( 'tik_page_header_style_filter', $header_style_html,
								$header_style ); ?>
						</div>
					</div>

					<?php
					/**
					 * Hook for header meta box display.
					 */
					do_action( 'tik_header_page_setting' );
					?>
				</div>

				<!-- PRIMARY MENU -->
				<div id="page-settings-primary-menu">

					<?php
					/**
					 * Hook : Page Settings > Primary Menu > Before.
					 */
					do_action( 'tik_primary_menu_page_settings_before' );
					?>

					<!-- MENU ITEM COLOR -->
					<div class="options-group show-default">
						<div class="tik-ui-desc">
							<label for="tik-menu-item-color"><?php esc_html_e( 'Menu Item Color', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<input class="tg-color-picker" type="text" name="tik_menu_item_color"
									id="tik-menu-item-color"
									value="<?php echo esc_attr( $menu_item_color ); ?>" data-default-color="<?php echo esc_attr( $customize_menu_item_color ); ?>"/>
						</div>
					</div>

					<!-- MENU ITEM HOVER COLOR -->
					<div class="options-group show-default">
						<div class="tik-ui-desc">
							<label for="tik-menu-item-hover-color"><?php esc_html_e( 'Menu Item Hover Color', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<input class="tg-color-picker" type="text" name="tik_menu_item_hover_color"
									id="tik-menu-item-hover-color"
									value="<?php echo esc_attr( $menu_item_hover_color ); ?>"
                                   data-default-color="<?php echo esc_attr( $customize_menu_item_hover_color ); ?>"/>
						</div>
					</div>

					<!-- MENU ITEM ACTIVE COLOR -->
					<div class="options-group show-default">
						<div class="tik-ui-desc">
							<label for="tik-menu-item-active-color"><?php esc_html_e( 'Menu Item Active Color', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<input class="tg-color-picker" type="text" name="tik_menu_item_active_color"
							       id="tik-menu-item-active-color" value="<?php echo esc_attr( $menu_item_active_color ); ?>" data-default-color="<?php echo esc_attr( $customize_menu_item_active_color ); ?>" />
						</div>
					</div>

					<!-- ACTIVE MENU ITEM STYLE -->
					<div class="options-group show-default">
						<div class="tik-ui-desc">
							<label for="tik_menu_item_active_style"><?php esc_html_e( 'Active Menu Item Style', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<select name="tik_menu_item_active_style" id="tik-menu-item-active-style">
								<option value="" <?php selected( $menu_item_active_style, '' ); ?>><?php esc_html_e( 'Default', 'tik' ); ?></option>
								<option value="tg-primary-menu--style-none" <?php selected( $menu_item_active_style, 'tg-primary-menu--style-none' ); ?>><?php esc_html_e( 'None', 'tik' ); ?></option>
								<option value="tg-primary-menu--style-underline" <?php selected(
										$menu_item_active_style, 'tg-primary-menu--style-underline' ); ?>><?php esc_html_e( 'Underline Border', 'tik' ); ?></option>
								<option value="tg-primary-menu--style-left-border" <?php selected(
										$menu_item_active_style, 'tg-primary-menu--style-left-border' ); ?>><?php esc_html_e( 'Left Border', 'tik' ); ?></option>
								<option value="tg-primary-menu--style-right-border" <?php selected(
										$menu_item_active_style, 'tg-primary-menu--style-right-border' ); ?>><?php esc_html_e( 'Right Border', 'tik' ); ?></option>
							</select>
						</div>
					</div>

					<?php
					/**
					 * Hook : Page Settings > Primary Menu > After.
					 */
					do_action( 'tik_primary_menu_page_settings_after' );
					?>

				</div>

				<!-- PAGE HEADER -->
				<div id="page-settings-page-header">

					<!-- ENABLE PAGE HEADER -->
					<div class="options-group">
						<div class="tik-ui-desc">
							<label for="tik-page-header"><?php esc_html_e( 'Enable Page Header', 'tik' ); ?></label>
						</div>
						<div class="tik-ui-field">
							<input type="checkbox"
									id="tik-page-header"
									name="tik_page_header"
									value="1" <?php checked( $page_header, 1 ); ?>>
						</div>
					</div>

					<?php
					/**
					 * Hook for page header meta box display.
					 */
					do_action( 'tik_page_header_page_setting' );
					?>

				</div>

				<?php
				/**
				 * Hook for page settings tab.
				 */
				do_action( 'tik_page_settings' );
				?>

			</div>
			<!-- /.tik-content -->
			<div class="clear"></div>
		</div>

		<?php
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID.
	 */
	public static function save( $post_id ) {
		$layout                           = isset( $_POST['tik_layout'] ) ? sanitize_key( $_POST['tik_layout'] ) : 'default'; // WPCS: CSRF ok.
		$remove_content_margin            = ( isset( $_POST['tik_remove_content_margin'] ) && '1' === $_POST['tik_remove_content_margin'] ) ? 1 : 0; // WPCS: CSRF ok.
		$sidebar                          = isset( $_POST['tik_sidebar'] ) ? sanitize_key( $_POST['tik_sidebar'] ) : 'default'; // WPCS: CSRF ok.
		$transparent_header               = isset( $_POST['tik_transparent_header'] ) ? sanitize_key( $_POST['tik_transparent_header'] ) : 'customizer'; // WPCS: CSRF ok.
		$customize_menu_item_color        = get_theme_mod( 'tik_primary_menu_text_color', '#16181a' );
		$menu_item_color                  = isset( $_POST['tik_menu_item_color'] ) ? sanitize_hex_color( wp_unslash( $_POST['tik_menu_item_color'] ) ) : $customize_menu_item_color; // WPCS: CSRF ok.
		$customize_menu_item_hover_color  = get_theme_mod( 'tik_primary_menu_text_hover_color', '#269bd1' );
		$menu_item_hover_color            = isset( $_POST['tik_menu_item_hover_color'] ) ? sanitize_hex_color( wp_unslash( $_POST['tik_menu_item_hover_color'] ) ) : $customize_menu_item_hover_color; // WPCS: CSRF ok.
		$customize_menu_item_active_color = get_theme_mod( 'tik_primary_menu_text_active_color', '#269bd1' );
		$menu_item_active_color           = isset( $_POST['tik_menu_item_active_color'] ) ? sanitize_hex_color( wp_unslash( $_POST['tik_menu_item_active_color'] ) ) : $customize_menu_item_active_color; // WPCS: CSRF ok.
		$menu_item_active_style           = isset( $_POST['tik_menu_item_active_style'] ) ? sanitize_key( $_POST['tik_menu_item_active_style'] ) : ''; // WPCS: CSRF ok.

		$page_header  = ( isset( $_POST['tik_page_header'] ) && '1' === $_POST['tik_page_header'] ) ? 1 : 0; // WPCS: CSRF ok.
		$logo         = ( isset( $_POST['tik_logo'] ) ) ? intval( $_POST['tik_logo'] ) : ''; // WPCS: CSRF ok.
		$header_style = isset( $_POST['tik_header_style'] ) ? sanitize_key( $_POST['tik_header_style'] ) : 'default'; // WPCS: CSRF ok.

		// TODO: Refactor this array. Create a member variable for $sidebar_layout_choices and manipulate it here.
		// LAYOUT.
		if ( in_array( $layout, array(
			'tg-site-layout--customizer',
			'tg-site-layout--default',
			'tg-site-layout--left',
			'tg-site-layout--right',
			'tg-site-layout--no-sidebar',
			'tg-site-layout--stretched',
			'tg-site-layout--2-sidebars',
		), true ) ) {
			update_post_meta( $post_id, 'tik_layout', $layout );
		} else {
			delete_post_meta( $post_id, 'tik_layout' );
		}

		// CONTENT MARGIN.
		update_post_meta( $post_id, 'tik_remove_content_margin', $remove_content_margin );

		// SIDEBAR.
		if ( in_array( $sidebar,
			array(
				'sidebar-right',
				'sidebar-left',
				'footer-sidebar-1',
				'footer-sidebar-2',
				'footer-sidebar-3',
				'footer-sidebar-4',
			), true ) ) {
			update_post_meta( $post_id, 'tik_sidebar', $sidebar );
		} else {
			delete_post_meta( $post_id, 'tik_sidebar' );
		}

		// TRANSPARENT HEADER.
		if ( in_array( $transparent_header,
			array(
				'customizer',
				'1',
				'0',
			), true ) ) {
			update_post_meta( $post_id, 'tik_transparent_header', $transparent_header );
		}

		// MENU ITEM COLOR.
		if ( $customize_menu_item_color !== $menu_item_color ) {
			update_post_meta( $post_id, 'tik_menu_item_color', $menu_item_color );
		} else {
			delete_post_meta( $post_id, 'tik_menu_item_color' );
		}

		// MENU ITEM HOVER COLOR.
		if ( $customize_menu_item_hover_color !== $menu_item_hover_color ) {
			update_post_meta( $post_id, 'tik_menu_item_hover_color', $menu_item_hover_color );
		} else {
			delete_post_meta( $post_id, 'tik_menu_item_hover_color' );
		}

		// MENU ITEM ACTIVE COLOR.
		if ( $customize_menu_item_active_color !== $menu_item_active_color ) {
			update_post_meta( $post_id, 'tik_menu_item_active_color', $menu_item_active_color );
		} else {
			delete_post_meta( $post_id, 'tik_menu_item_active_color' );
		}

		// ACTIVE MENU ITEM STYLE.
		if ( in_array( $menu_item_active_style, array(
			'tg-primary-menu--style-none',
			'tg-primary-menu--style-underline',
			'tg-primary-menu--style-left-border',
			'tg-primary-menu--style-right-border',
		), true ) ) {
			update_post_meta( $post_id, 'tik_menu_item_active_style', $menu_item_active_style );
		} else {
			delete_post_meta( $post_id, 'tik_menu_item_active_style' );
		}

		// PAGE HEADER.
		update_post_meta( $post_id, 'tik_page_header', $page_header );

		// LOGO.
		update_post_meta( $post_id, 'tik_logo', $logo );

		$header_style_arr = apply_filters( 'tik_header_style_meta_save',
			array(
				'tg-site-header--left',
				'tg-site-header--center',
				'tg-site-header--right',
			)
		);

		// HEADER STYLE.
		if ( in_array( $header_style, $header_style_arr, true ) ) {
			update_post_meta( $post_id, 'tik_header_style', $header_style );
		} else {
			delete_post_meta( $post_id, 'tik_header_style' );
		}

		/**
		 * Hook for page settings data save.
		 */
		do_action( 'tik_page_settings_save', $post_id );
	}
}
