<?php

if ( ! class_exists( 'Oew_Elementor' ) ) {
    class Oew_Elementor {
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', array(
                __CLASS__,
                'create_elementor_categories'
            ), 99 );

            add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'init_widgets' ) );
        }

        public static function create_elementor_categories( $elements_manager ) {
            $elements_manager->add_category(
                'oew-widgets',
                array('title' => esc_html__( 'Ocanus Widgets', 'ocanus-elementor-widgets' )),
                0 // 0 to TOP
            );
        }

        public static function init_widgets() {
            $main = new Ocanus_Elementor_Widgets();
            $widgets = $main->elementor_widgets();

            if (!empty($widgets)) {
                foreach ($widgets as $widget) {
                    require_once OEW_ELEMENTOR_WIDGET_ELEMENTOR_PATH . $widget . '/' . $widget . '.php';
                }
            }
        }
    }

    new Oew_Elementor();
}