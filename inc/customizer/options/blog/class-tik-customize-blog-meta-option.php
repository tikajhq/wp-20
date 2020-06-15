<?php
/**
 * Meta styles.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== LAYOUT > SINGLE BLOG POST ==========================================*/
if ( ! class_exists( 'Tik_Customize_Blog_Meta_Option' ) ) :

	/**
	 * Single Blog Post option.
	 */
	class Tik_Customize_Blog_Meta_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Post/Page/Blog > Meta > Meta Style.
				 */
				'tik_blog_archive_meta_style' => array(
					'setting' => array(
						'default'           => 'tg-meta-style-one',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 10,
						'label'    => esc_html__( 'Meta Style', 'tik' ),
						'section'  => 'tik_meta',
						'choices'  => array(
							'tg-meta-style-one' => TIK_PARENT_INC_ICON_URI . '/meta-style-one.png',
							'tg-meta-style-two' => TIK_PARENT_INC_ICON_URI . '/meta-style-two.png',
						),
					),
				),

			);

		}

	}

	new Tik_Customize_Blog_Meta_Option();

endif;
