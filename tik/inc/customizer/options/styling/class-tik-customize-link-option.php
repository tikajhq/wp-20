<?php
/**
 * Link styling.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== STYLING > LINK ==========================================*/
if ( ! class_exists( 'Tik_Customize_Link_Option' ) ) :

	/**
	 * Link option.
	 */
	class Tik_Customize_Link_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Styling > Link Colors > Link Color.
				 */
				'tik_link_color'       => array(
					'output'  => array(
						array(
							'selector' => '.entry-content a',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#269bd1',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'     => 'color',
						'priority' => 10,
						'label'    => esc_html__( 'Link Color', 'tik' ),
						'section'  => 'tik_styling_link',
						'choices'  => array(
							'alpha' => true,
						),
					),
				),

				/**
				 * Styling > Link Colors > Link Hover Color.
				 */
				'tik_link_hover_color' => array(
					'output'  => array(
						array(
							'selector' => '.entry-content a:hover, .entry-content a:focus',
							'property' => 'color',
						),
					),
					'setting' => array(
						'default'           => '#1e7ba6',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'     => 'color',
						'priority' => 20,
						'label'    => esc_html__( 'Link Hover Color', 'tik' ),
						'section'  => 'tik_styling_link',
						'choices'  => array(
							'alpha' => true,
						),
					),
				),

			);

		}

	}

	new Tik_Customize_Link_Option();

endif;
