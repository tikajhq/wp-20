<?php
/**
 * Header main options.
 *
 * @package tik
 */

defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER MAIN ==========================================*/
if ( ! class_exists( 'Tik_Customize_Header_Main_Option' ) ) :

	/**
	 * Header main customizer options.
	 */
	class Tik_Customize_Header_Main_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Header > Header Main Area > Style.
				 */
				'tik_header_main_style'               => array(
					'setting' => array(
						'default'           => 'tg-site-header--left',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 10,
						'label'    => esc_html__( 'Style', 'tik' ),
						'section'  => 'tik_header_main',
						'choices'  => apply_filters(
							'tik_header_main_style_choices',
							array(
								'tg-site-header--left'   => TIK_PARENT_INC_ICON_URI . '/header-left.png',
								'tg-site-header--center' => TIK_PARENT_INC_ICON_URI . '/header-center.png',
								'tg-site-header--right'  => TIK_PARENT_INC_ICON_URI . '/header-right.png',
							)
						),
						'active_callback' => apply_filters(
							'tik_header_main_style_cb',
							array()
						),

					),
				),

				/**
				 * Header > Header Main Area > Enable Search Icon.
				 */
				'tg_header_menu_search_enabled'         => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 20,
						'label'    => esc_html__( 'Enable Search Icon', 'tik' ),
						'section'  => 'tik_header_main',
					),
				),

				/**
				 * Header > Header Main Area > Border Bottom.
				 */
				'tik_header_main_border_bottom_width' => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-header',
							'property' => 'border-bottom-width',
						),
					),
					'setting' => array(
						'default'           => array(
							'slider' => 1,
							'suffix' => 'px',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_slider' ),
					),
					'control' => array(
						'type'        => 'slider',
						'priority'    => 30,
						'label'       => esc_html__( 'Border Bottom', 'tik' ),
						'section'     => 'tik_header_main',
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 20,
							'step' => 1,
						),

					),
				),

				/**
				 * Header > Header Main Area > Border Bottom Color.
				 */
				'tik_header_main_border_bottom_color' => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-header',
							'property' => 'border-bottom-color',
						),
					),
					'setting' => array(
						'default'           => '#e9ecef',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'     => 'color',
						'priority' => 40,
						'label'    => esc_html__( 'Border Bottom Color', 'tik' ),
						'section'  => 'tik_header_main',
						'choices'  => array(
							'alpha' => true,
						),
					),
				),

				/**
				 * Header > Header Main Area > Background.
				 */
				'tik_header_main_bg'                  => array(
					'output'  => array(
						array(
							'selector' => '.tg-site-header, .tg-container--separate .tg-site-header',
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
						'type'     => 'background',
						'priority' => 50,
						'section'  => 'tik_header_main',
					),
				),

			);

		}

	}

	new Tik_Customize_Header_Main_Option();

endif;
