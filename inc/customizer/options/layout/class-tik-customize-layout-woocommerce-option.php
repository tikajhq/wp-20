<?php
/**
 * Layout WooCommerce layout.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Return if WooCommerce plugin is not activated.
if ( ! tik_is_woocommerce_active() ) {
	return;
}

/*========================================== LAYOUT > WooCommerce ==========================================*/
if ( ! class_exists( 'Tik_Customize_Layout_WooCommerce_Option' ) ) :

	/**
	 * Layout WooCommerce option.
	 */
	class Tik_Customize_Layout_WooCommerce_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			$sidebar_layout_choices = apply_filters( 'tik_site_layout_choices', array(
				'tg-site-layout--default'    => TIK_PARENT_INC_ICON_URI . '/layout-default.png',
				'tg-site-layout--left'       => TIK_PARENT_INC_ICON_URI . '/left-sidebar.png',
				'tg-site-layout--right'      => TIK_PARENT_INC_ICON_URI . '/right-sidebar.png',
				'tg-site-layout--no-sidebar' => TIK_PARENT_INC_ICON_URI . '/full-width.png',
				'tg-site-layout--stretched'  => TIK_PARENT_INC_ICON_URI . '/stretched.png',
			) );

			return array(

				/**
				 * Layout > WooCommerce > WooCommerce
				 */
				'tik_structure_wc'         => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 10,
						'label'    => esc_html__( 'WooCommerce', 'tik' ),
						'section'  => 'tik_layout_woocommerce_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

				/**
				 * Layout > WooCommerce > Single Product.
				 */
				'tik_structure_wc_product' => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 20,
						'label'    => esc_html__( 'Single Product', 'tik' ),
						'section'  => 'tik_layout_woocommerce_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

			);

		}

	}

	new Tik_Customize_Layout_WooCommerce_Option();

endif;
