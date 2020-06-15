<?php
/**
 * Scroll to top styling.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== STYLING >  SCROLL TO TOP  ==========================================*/
if ( ! class_exists( 'Tik_Customize_Scroll_To_Top_Option' ) ) :

	/**
	 * Scroll_To_Top option.
	 */
	class Tik_Customize_Scroll_To_Top_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Footer > Scroll to Top > Enable Scroll to Top.
				 */
				'tik_scroll_to_top_enabled'        => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 10,
						'label'    => esc_html__( 'Enable Scroll to Top', 'tik' ),
						'section'  => 'tik_footer_scroll_to_top',
						'choices'  => array(
							'alpha' => true,
						),
					),
				),

				/**
				 * Footer > Scroll to Top > Color.
				 */
				'tik_scroll_to_top_color'          => array(
					'output'  => array(
						array(
							'selector' => '.tg-scroll-to-top',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#ffffff',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 20,
						'label'           => esc_html__( 'Color', 'tik' ),
						'section'         => 'tik_footer_scroll_to_top',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => array(
							array(
								'setting'  => 'tik_scroll_to_top_enabled',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				),

				/**
				 * Footer > Scroll to Top > Hover Color.
				 */
				'tik_scroll_to_top_hover_color'    => array(
					'output'  => array(
						array(
							'selector' => '.tg-scroll-to-top:hover',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#ffffff',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 30,
						'label'           => esc_html__( 'Hover Color', 'tik' ),
						'section'         => 'tik_footer_scroll_to_top',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => array(
							array(
								'setting'  => 'tik_scroll_to_top_enabled',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				),

				/**
				 * Footer > Scroll to Top > Background Color.
				 */
				'tik_scroll_to_top_bg_color'       => array(
					'output'  => array(
						array(
							'selector' => '.tg-scroll-to-top',
							'property' => 'background-color',
						),
					),
					'setting' => array(
						'default'           => '#16181a',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 40,
						'label'           => esc_html__( 'Background Color', 'tik' ),
						'section'         => 'tik_footer_scroll_to_top',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => array(
							array(
								'setting'  => 'tik_scroll_to_top_enabled',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				),

				/**
				 * Footer > Scroll to Top > Background Hover Color.
				 */
				'tik_scroll_to_top_bg_hover_color' => array(
					'output'  => array(
						array(
							'selector' => '.tg-scroll-to-top.tg-scroll-to-top--show:hover',
							'property' => 'background-color',
						),
					),
					'setting' => array(
						'default'           => '#1e7ba6',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 50,
						'label'           => esc_html__( 'Background Hover Color', 'tik' ),
						'section'         => 'tik_footer_scroll_to_top',
						'choices'         => array(
							'alpha' => true,
						),
						'active_callback' => array(
							array(
								'setting'  => 'tik_scroll_to_top_enabled',
								'value'    => true,
								'operator' => '==',
							),
						),
					),
				),

			);

		}

	}

	new Tik_Customize_Scroll_To_Top_Option();

endif;
