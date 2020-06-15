<?php
/**
 * Archive/ blog layout.
 *
 * @package     tik
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== POST/PAGE/BLOG > ARCHIVE/ BLOG ==========================================*/
if ( ! class_exists( 'Tik_Customize_Upsell_Option' ) ) :

    /**
     * Archive/Blog option.
     */
    class Tik_Customize_Upsell_Option extends Tik_Customize_Base_Option {

        /**
         * Arguments for options.
         *
         * @return array
         */
        public function elements() {

            return array(

                'tik_upsell'        => array(
                    'setting' => array(),
                    'control' => array(
                        'type'     => 'upsell',
                        'priority' => 10,
                        'section'  => 'tik_customize_upsell_section',
                    ),
                )


            );

        }

    }

    new Tik_Customize_Upsell_Option();

endif;
