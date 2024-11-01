<?php
/*
Plugin Name: 		Special Addons for Elementor
Plugin URI:			https://wolfcoding.com/special-addons-for-elementor/
Description:		The Addons plugin have 20+ stunning free widget for Elementor including Banner Advanced, Gallery, Countdown, WooCommerce, and many more.
Version: 			1.0.0
Author: 			vagrant
Author URI:			https://wolfcoding.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! class_exists( 'Ocanus_Elementor_Widgets' ) ) {
	class Ocanus_Elementor_Widgets {
		public function __construct() {
			require_once 'define.php';

			$this->load_library();
			$this->load_helper();

			add_action( 'init', array( __CLASS__, 'load_config' ), 2 );

			add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ] );

			add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_frontend_styles' ] );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );

			//== [ Editor Elementor ]
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_styles' ] );

			if ( is_admin() ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 20 );
			}

			//== [ Quick View ]
			add_action( 'wp_ajax_oew_render_modal_quick_view', 'oew_render_modal_quick_view' );
			add_action( 'wp_ajax_nopriv_oew_render_modal_quick_view', 'oew_render_modal_quick_view' );
			if ( ! class_exists( 'woocommerce' ) ) {
				add_action( 'oew_quick_view_product_summary', 'woocommerce_template_single_excerpt', 5 );
				add_action( 'oew_quick_view_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
				add_action( 'oew_quick_view_product_summary', 'woocommerce_template_single_meta', 20 );
			}
		}

		// load library.
		public function load_library() {
			// Load core framework
			if ( ! class_exists( 'CSF' ) ) {
				require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/libs/codestar-framework/codestar-framework.php';
			}
		}

		// load config.
		public static function load_config() {

		}

		// load helper.
		public function load_helper() {
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/base.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/resize.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/post-type.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/helpers.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/hooks.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/filters.php';

			if ( ! class_exists( 'woocommerce' ) ) {
				require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/woocommerce.php';
			}

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/button/content.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/button/style.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/heading/content.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/heading/style.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/icon/content.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/image/content.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/image/style.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/query/content.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/slider/content.php';
			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/slider/style.php';

			require_once OEW_ELEMENTOR_WIDGET_DIR_PATH . '/func/elementor/base/typography/style.php';
		}

		public function elementor_widgets() {
			return [
				'hero-video-banner',
				'big-step',
				'step-grid',
				'step-list',
				'instagram',
				'card-list-item',
				'gallery-information',
				'gallery-masonry',
				'before-after-carousel',
				'featured-categories',
				'product-featured-tabs',
				'banner-grid',
				'banner-advanced',
				'category-product-counter',
				'product-information',
				'category',
				'gallery-content',
				'blogs',
                'collection-carousel',
				'banner-with-testimonials',
                'info-special',
                'item-infor-popup',
                'countdown-with-image',
			];
		}

		public function enqueue_admin_scripts() {
			wp_enqueue_style( 'oew-admin-style', OEW_ELEMENTOR_WIDGET_DIR_URL . 'assets/css/admin.css', array(), OEW_PLUGIN_VERSION );
			wp_enqueue_script( 'oew-admin-script', OEW_ELEMENTOR_WIDGET_DIR_URL . '/assets/js/admin.js', array( 'jquery' ), OEW_PLUGIN_VERSION, true );
			wp_localize_script( 'oew-admin-script', 'ocanus_script', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			) );
		}

		public function enqueue_frontend_scripts() {
			wp_enqueue_script( 'oew-slick-script' );
			wp_enqueue_script( 'oew-script' );
			wp_localize_script( 'oew-script', 'oew_script', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			) );
		}

		public function enqueue_frontend_styles() {
			wp_enqueue_style( 'oew-style', OEW_ELEMENTOR_WIDGET_DIR_URL . 'assets/css/style.css', array(), OEW_PLUGIN_VERSION );
			wp_enqueue_style( 'elementor-icons-fa-solid' );
			wp_enqueue_style( 'elementor-icons-fa-brands' );
		}

		public function register_frontend_styles() {
			wp_register_script( 'oew-slick-script', OEW_ELEMENTOR_WIDGET_DIR_URL . '/assets/js/vendor/slick.min.js', array(
				'jquery',
				'jquery-ui-core'
			), '1.9.0', true );
			wp_register_script( 'oew-script', OEW_ELEMENTOR_WIDGET_DIR_URL . 'assets/js/script.js', array(
				'jquery',
				'jquery-ui-core'
			), OEW_PLUGIN_VERSION, true );
			wp_register_style( 'oew-line-awesome', OEW_ELEMENTOR_WIDGET_DIR_URL . '/assets/fonts/line-awesome/css/line-awesome.min.css', array() );

			$widgets = $this->elementor_widgets();

			if ( ! empty( $widgets ) ) {
				foreach ( $widgets as $widget ) {
					wp_register_style( 'oew-' . $widget, OEW_ELEMENTOR_WIDGET_ELEMENTOR_URL . $widget . '/css/' . $widget . '.min.css', array(), OEW_PLUGIN_VERSION );
					wp_register_script( 'oew-' . $widget, OEW_ELEMENTOR_WIDGET_ELEMENTOR_URL . $widget . '/js/' . $widget . '.js', array( 'jquery' ), OEW_PLUGIN_VERSION, true );
				}
			}
		}

		public function enqueue_editor_styles() {
			wp_enqueue_style( 'oew-elementor-editor', OEW_ELEMENTOR_WIDGET_DIR_URL . 'assets/css/elementor-editor.css', array(), OEW_PLUGIN_VERSION );
		}
	}

	new Ocanus_Elementor_Widgets();
}