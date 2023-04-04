<?php
/**
 * Layout general layout.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== LAYOUT > General ==========================================*/
if ( ! class_exists( 'Tik_Customize_Layout_General_Option' ) ) :

	/**
	 * Layout general option.
	 */
	class Tik_Customize_Layout_General_Option extends Tik_Customize_Base_Option {

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
				 * Layout > General > Default.
				 */
				'tik_structure_default'    => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 10,
						'label'    => esc_html__( 'Default', 'tik' ),
						'section'  => 'tik_layout_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

				/**
				 * Layout > General > Blog/Archive.
				 */
				'tik_structure_archive'    => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 20,
						'label'    => esc_html__( 'Blog/Archive', 'tik' ),
						'section'  => 'tik_layout_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

				/**
				 * Layout > General > Blog post.
				 */
				'tik_structure_post'       => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 30,
						'label'    => esc_html__( 'Single Post', 'tik' ),
						'section'  => 'tik_layout_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

				/**
				 * Layout > General > Page.
				 */
				'tik_structure_page'       => array(
					'setting' => array(
						'default'           => 'tg-site-layout--right',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 40,
						'label'    => esc_html__( 'Page', 'tik' ),
						'section'  => 'tik_layout_structure',
						'choices'  => $sidebar_layout_choices,
					),
				),

			);

		}

	}

	new Tik_Customize_Layout_General_Option();

endif;
