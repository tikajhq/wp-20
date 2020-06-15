<?php
/**
 * Footer bottom bar options.
 *
 * @package     tik
 */

defined( 'ABSPATH' ) || exit;

/*========================================== FOOTER > FOOTER  BAR ==========================================*/
if ( ! class_exists( 'Tik_Customize_Footer_Bottom_Bar_Option' ) ) :

	/**
	 * Footer option.
	 */
	class Tik_Customize_Footer_Bottom_Bar_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Footer > Footer Bottom Bar > Style.
				 */
				'tik_footer_bar_style'            => array(
					'setting' => array(
						'default'           => 'tg-site-footer-bar--center',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio_image',
						'priority'        => 10,
						'label'           => esc_html__( 'Style', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => apply_filters(
							'tik_footer_bar_style_choices',
							array(
								'tg-site-footer-bar--left'   => TIK_PARENT_INC_ICON_URI . '/footer-left.png',
								'tg-site-footer-bar--center' => TIK_PARENT_INC_ICON_URI . '/footer-center.png',
							)
						),
						'active_callback' => apply_filters( 'tik_footer_bar_style_cb', false ),
					),
				),

				/* ============================== Left Content ============================== */

				/**
				 * Footer > Footer Bottom Bar > Left Content.
				 */
				'tik_footer_bar_section_one'      => array(
					'setting' => array(
						'default'           => 'text_html',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'select',
						'priority'        => 12,
						'is_default_type' => true,
						'label'           => esc_html__( 'Left Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => apply_filters(
							'tik_footer_bar_section_one_choices',
							array(
								'none'      => esc_html__( 'None', 'tik' ),
								'text_html' => esc_html__( 'Text/HTML', 'tik' ),
								'menu'      => esc_html__( 'Menu', 'tik' ),
								'widget'    => esc_html__( 'Widget', 'tik' ),
							)
						),
						'active_callback' => apply_filters( 'tik_footer_bar_section_one_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Left content > Text/HTML for Left Content.
				 */
				'tik_footer_bar_section_one_html' => array(
					'setting' => array(
						'default'           => tik_footer_copyright(),
						'sanitize_callback' => 'wp_kses_post',
					),
					'control' => array(
						'type'            => 'editor',
						'priority'        => 14,
						'label'           => esc_html__( 'Text/HTML for Left Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'active_callback' => apply_filters(
							'tik_footer_bar_section_one_html_cb',
							array(
								array(
									'setting'  => 'tik_footer_bar_section_one',
									'operator' => '==',
									'value'    => 'text_html',
								),
							)
						),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Left content > Menu for Left Content.
				 */
				'tik_footer_bar_section_one_menu' => array(
					'setting' => array(
						'default'           => 'none',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'select',
						'priority'        => 16,
						'is_default_type' => true,
						'label'           => esc_html__( 'Select a Menu for Left Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => $this->get_menu_options(),
						'active_callback' => apply_filters(
							'tik_footer_bar_section_one_menu_cb',
							array(
								array(
									'setting'  => 'tik_footer_bar_section_one',
									'operator' => '==',
									'value'    => 'menu',
								),
							)
						),

					),
				),

				/* ============================== Right Content ============================== */

				/**
				 * Footer > Footer Bottom Bar > Right Content.
				 */
				'tik_footer_bar_section_two'      => array(
					'setting' => array(
						'default'           => 'none',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'select',
						'priority'        => 20,
						'is_default_type' => true,
						'label'           => esc_html__( 'Right Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => apply_filters(
							'tik_footer_bar_section_two_choices',
							array(
								'none'      => esc_html__( 'None', 'tik' ),
								'text_html' => esc_html__( 'Text/HTML', 'tik' ),
								'menu'      => esc_html__( 'Menu', 'tik' ),
								'widget'    => esc_html__( 'Widget', 'tik' ),
							)
						),
						'active_callback' => apply_filters( 'tik_footer_bar_section_two_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Right content > Text/HTML for Right Content.
				 */
				'tik_footer_bar_section_two_html' => array(
					'setting' => array(
						'default'           => '',
						'sanitize_callback' => 'wp_kses_post',
					),
					'control' => array(
						'type'            => 'editor',
						'priority'        => 22,
						'label'           => esc_html__( 'Text/HTML for Right Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'active_callback' => apply_filters(
							'tik_footer_bar_section_two_html_cb',
							array(
								array(
									'setting'  => 'tik_footer_bar_section_two',
									'operator' => '==',
									'value'    => 'text_html',
								),
							)
						),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Section Two Content > Menu Content.
				 */
				'tik_footer_bar_section_two_menu' => array(
					'setting' => array(
						'default'           => 'none',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'select',
						'priority'        => 30,
						'is_default_type' => true,
						'label'           => esc_html__( 'Select a Menu for Right Content', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => $this->get_menu_options(),
						'active_callback' => apply_filters(
							'tik_footer_bar_section_two_menu_cb',
							array(
								array(
									'setting'  => 'tik_footer_bar_section_two',
									'operator' => '==',
									'value'    => 'menu',
								),
							)
						),
					),
				),

				/*========================================== FOOTER > FOOTER BAR:STYLING ==========================================*/
				/**
				 * Footer > Footer Bottom Bar > Text Color.
				 */
				'tik_footer_bar_text_color'       => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#51585f',
						'capability'        => 'edit_theme_options',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 40,
						'label'           => esc_html__( 'Text Color', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => apply_filters( 'tik_footer_bar_text_color_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Link Color.
				 */
				'tik_footer_bar_link_color'       => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar a',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#16181a',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 50,
						'label'           => esc_html__( 'Link Color', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => apply_filters( 'tik_footer_bar_link_color_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Link Hover Color.
				 */
				'tik_footer_bar_link_hover_color' => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar a:hover, .tg-site-footer .tg-site-footer-bar a:focus',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#269bd1',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 60,
						'label'           => esc_html__( 'Link Hover Color', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => apply_filters( 'tik_footer_bar_link_hover_color_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Border Top.
				 */
				'tik_footer_bar_border_top_width' => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar',
							'property' => 'border-top-width',
						),
					),
					'setting' => array(
						'default'           => array(
							'slider' => 0,
							'suffix' => 'px',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_slider' ),
					),
					'control' => array(
						'type'            => 'slider',
						'priority'        => 70,
						'label'           => esc_html__( 'Border Top', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 20,
							'step' => 1,
						),
						'active_callback' => apply_filters( 'tik_footer_bar_border_top_width_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Border Top Color.
				 */
				'tik_footer_bar_border_top_color' => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar',
							'property' => 'border-top-color',
						),
					),
					'setting' => array(
						'default'           => '#e9ecef',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 80,
						'label'           => esc_html__( 'Border Top Color', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => apply_filters( 'tik_footer_bar_border_top_color_cb', false ),
					),
				),

				/**
				 * Footer > Footer Bottom Bar > Background.
				 */
				'tik_footer_bar_bg'               => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-footer .tg-site-footer-bar',
						),
					),
					'setting' => array(
						'default'           => array(
							'background-color'      => '#ffffff',
							'background-image'      => '',
							'background-repeat'     => 'repeat',
							'background-position'   => 'center center',
							'background-size'       => 'contain',
							'background-attachment' => 'scroll',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_background' ),
					),
					'control' => array(
						'type'            => 'background',
						'priority'        => 90,
						'label'           => esc_html__( 'Background', 'tik' ),
						'section'         => 'tik_footer_bottom_bar',
						'active_callback' => apply_filters( 'tik_footer_bar_bg_cb', false ),
					),
				),

			);

		}

	}

	new Tik_Customize_Footer_Bottom_Bar_Option();

endif;
