<?php
/**
 * General options.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== GENERAL ==========================================*/
if ( ! class_exists( 'Tik_Customize_General_Option' ) ) :

	/**
	 * General option.
	 */
	class Tik_Customize_General_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			$elements = array(

				/**
				 * General > Container Style.
				 */
				'tik_general_container_style' => array(
					'setting' => array(
						'default'           => 'tg-container--wide',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 10,
						'label'    => esc_html__( 'Container Style', 'tik' ),
						'section'  => 'tik_general',
						'choices'  => array(
							'tg-container--wide'     => TIK_PARENT_INC_ICON_URI . '/wide.png',
							'tg-container--boxed'    => TIK_PARENT_INC_ICON_URI . '/boxed.png',
							'tg-container--separate' => TIK_PARENT_INC_ICON_URI . '/separate.png',
						),

					),
				),

				/**
				 * General > Container Width.
				 */
				'tik_general_container_width' => array(
					'output'  => array(
						array(
							'selector'    => '.tg-container',
							'property'    => 'max-width',
							'media_query' => '@media (min-width: 1200px)',
						),
					),
					'setting' => array(
						'default'           => array(
							'slider' => 1160,
							'suffix' => 'px',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_slider' ),
					),
					'control' => array(
						'type'        => 'slider',
						'priority'    => 20,
						'label'       => esc_html__( 'Container Width', 'tik' ),
						'section'     => 'tik_general',
						'input_attrs' => array(
							'min'  => 768,
							'max'  => 1920,
							'step' => 1,
						),
					),
				),

				/**
				 * General > Content Width.
				 */
				'tik_general_content_width'   => array(
					'output'  => array(
						array(
							'selector' => '#primary',
							'property' => 'width',
						),
					),
					'setting' => array(
						'default'           => array(
							'slider' => 70,
							'suffix' => '%',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_slider' ),
					),
					'control' => array(
						'type'        => 'slider',
						'priority'    => 30,
						'label'       => esc_html__( 'Content Width', 'tik' ),
						'description' => esc_html__( 'Only works for left/ right sidebar layout', 'tik' ),
						'section'     => 'tik_general',
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
				),

				/**
				 * General > Sidebar Width.
				 */
				'tik_general_sidebar_width'   => array(
					'output'  => array(
						array(
							'selector' => '#secondary',
							'property' => 'width',
						),
					),
					'setting' => array(
						'default'           => array(
							'slider' => 30,
							'suffix' => '%',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_slider' ),
					),
					'control' => array(
						'type'        => 'slider',
						'priority'    => 40,
						'label'       => esc_html__( 'Sidebar Width', 'tik' ),
						'description' => esc_html__( 'Only works for left/ right sidebar layout', 'tik' ),
						'section'     => 'tik_general',
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
				),

			);

			return $elements;

		}

	}

	new Tik_Customize_General_Option();

endif;
