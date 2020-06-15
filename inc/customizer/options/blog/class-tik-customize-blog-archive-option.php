<?php
/**
 * Archive/ blog layout.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== POST/PAGE/BLOG > ARCHIVE/ BLOG ==========================================*/
if ( ! class_exists( 'Tik_Customize_Blog_Archive_Option' ) ) :

	/**
	 * Archive/Blog option.
	 */
	class Tik_Customize_Blog_Archive_Option extends Tik_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(

				/**
				 * Post/Page/Blog > Blog/Archive > Post Content Order.
				 */
				'tik_structure_archive_blog'        => array(
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
						'type'            => 'sortable',
						'priority'        => 10,
						'label'           => esc_html__( 'Post Content Order', 'tik' ),
						'description'     => esc_html__( 'Drag & Drop items to re-arrange the order', 'tik' ),
						'section'         => 'tik_archive_blog',
						'choices'         => array(
							'featured_image' => esc_attr__( 'Featured Image', 'tik' ),
							'title'          => esc_attr__( 'Title', 'tik' ),
							'meta'           => esc_attr__( 'Meta Tags', 'tik' ),
							'content'        => esc_attr__( 'Content', 'tik' ),
						),
						'active_callback' => apply_filters( 'tik_structure_archive_blog_order', false ),
					),
				),

				/**
				 * Post/Page/Blog > Blog/Archive > Meta Tags Order.
				 */
				'tik_meta_structure_archive_blog'   => array(
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
						'section'     => 'tik_archive_blog',
						'choices'     => array(
							'comments'   => esc_attr__( 'Comments', 'tik' ),
							'categories' => esc_attr__( 'Categories', 'tik' ),
							'author'     => esc_attr__( 'Author', 'tik' ),
							'date'       => esc_attr__( 'Date', 'tik' ),
							'tags'       => esc_attr__( 'Tags', 'tik' ),
						),
					),
				),

				/**
				 * Post/Page/Blog > Blog/Archive > Post Content.
				 */
				'tik_post_content_archive_blog'     => array(
					'setting' => array(
						'default'           => 'excerpt',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio',
						'priority'        => 30,
						'is_default_type' => true,
						'label'           => esc_html__( 'Post Content', 'tik' ),
						'section'         => 'tik_archive_blog',
						'choices'         => array(
							'excerpt' => esc_html__( 'Excerpt', 'tik' ),
							'content' => esc_html__( 'Content', 'tik' ),
						),
					),
				),

				/**
				 * Post/Page/Blog > Blog/Archive > Enable Read More.
				 */
				'tik_enable_read_more_archive_blog' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'            => 'toggle',
						'priority'        => 40,
						'label'           => esc_html__( 'Enable Read More', 'tik' ),
						'section'         => 'tik_archive_blog',
						'active_callback' => array(
							array(
								'setting'  => 'tik_post_content_archive_blog',
								'operator' => '===',
								'value'    => 'excerpt',
							),
						),
					),
				),

				/**
				 * Post/Page/Blog > Blog/Archive > Read More Style.
				 */
				'tik_read_more_align_archive_blog'  => array(
					'setting' => array(
						'default'           => 'left',
						'sanitize_callback' => array( 'Tik_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio_image',
						'priority'        => 50,
						'label'           => esc_html__( 'Read More Style', 'tik' ),
						'section'         => 'tik_archive_blog',
						'choices'         => apply_filters( 'tik_read_more_style', array(
							'left'  => TIK_PARENT_INC_ICON_URI . '/read-more-left.png',
							'right' => TIK_PARENT_INC_ICON_URI . '/read-more-right.png',
						) ),
						'active_callback' => apply_filters(
							'tik_read_more_style_cb',
							array(
								array(
									'setting'  => 'tik_post_content_archive_blog',
									'operator' => '===',
									'value'    => 'excerpt',
								),
								array(
									'setting'  => 'tik_enable_read_more_archive_blog',
									'operator' => '===',
									'value'    => true,
								),
							)
						),
					),
				),

			);

		}

	}

	new Tik_Customize_Blog_Archive_Option();

endif;
