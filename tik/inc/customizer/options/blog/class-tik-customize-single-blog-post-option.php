<?php
/**
 * Single blog post layout.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== LAYOUT > SINGLE BLOG POST ==========================================*/
if ( ! class_exists( 'Tik_Customize_Single_Blog_Post_Option' ) ) :

	/**
	 * Single Blog Post option.
	 */
	class Tik_Customize_Single_Blog_Post_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Post/Page/Blog > Single Post > Single Post Content Order.
				 */
				'tik_single_post_content_structure'   => array(
					'setting' => array(
						'default'           => array(
							'featured_image',
							'title',
							'meta',
							'content',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_sortable' ),
					),
					'control' => array(
						'type'        => 'sortable',
						'priority'    => 10,
						'label'       => esc_html__( 'Single Post Content Order', 'tik' ),
						'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'tik' ),
						'section'     => 'tik_single_blog_post',
						'choices'     => array(
							'featured_image' => esc_attr__( 'Featured Image', 'tik' ),
							'title'          => esc_attr__( 'Title', 'tik' ),
							'meta'           => esc_attr__( 'Meta Tags', 'tik' ),
							'content'        => esc_attr__( 'Content', 'tik' ),
						),
					),
				),

				/**
				 * Post/Page/Blog > Single Post > Meta Tags Order.
				 */
				'tik_single_blog_post_meta_structure' => array(
					'setting' => array(
						'default'           => array(
							'author',
							'date',
							'categories',
							'tags',
							'comments',
						),
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_sortable' ),
					),
					'control' => array(
						'type'        => 'sortable',
						'priority'    => 20,
						'label'       => esc_html__( 'Meta Tags Order', 'tik' ),
						'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'tik' ),
						'section'     => 'tik_single_blog_post',
						'choices'     => array(
							'comments'   => esc_attr__( 'Comments', 'tik' ),
							'categories' => esc_attr__( 'Categories', 'tik' ),
							'author'     => esc_attr__( 'Author', 'tik' ),
							'date'       => esc_attr__( 'Date', 'tik' ),
							'tags'       => esc_attr__( 'Tags', 'tik' ),
						),
					),
				),

			);

		}

	}

	new Tik_Customize_Single_Blog_Post_Option();

endif;
