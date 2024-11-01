<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 9/6/2021
 * Time: 11:11 AM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Product_Information extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-product-information';
	}

	public function get_title() {
		return esc_html__( 'Product Information', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-table oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-product-information' ];
	}

	public function get_style_depends() {
		return [ 'oew-product-information' ];
	}

	protected function oew_get_product_orderby_options() {
		return [
			'ID'         => esc_html__( 'Product ID', 'ocanus-elementor-widgets' ),
			'title'      => esc_html__( 'Product Title', 'ocanus-elementor-widgets' ),
			'_price'     => esc_html__( 'Price', 'ocanus-elementor-widgets' ),
			'_sku'       => esc_html__( 'SKU', 'ocanus-elementor-widgets' ),
			'date'       => esc_html__( 'Date', 'ocanus-elementor-widgets' ),
			'modified'   => esc_html__( 'Last Modified Date', 'ocanus-elementor-widgets' ),
			'parent'     => esc_html__( 'Parent Id', 'ocanus-elementor-widgets' ),
			'rand'       => esc_html__( 'Random', 'ocanus-elementor-widgets' ),
			'menu_order' => esc_html__( 'Menu Order', 'ocanus-elementor-widgets' ),
		];
	}

	protected function oew_get_product_filterby_options() {
		return [
			'recent-products'       => esc_html__( 'Recent Products', 'ocanus-elementor-widgets' ),
			'featured-products'     => esc_html__( 'Featured Products', 'ocanus-elementor-widgets' ),
			'best-selling-products' => esc_html__( 'Best Selling Products', 'ocanus-elementor-widgets' ),
			'sale-products'         => esc_html__( 'Sale Products', 'ocanus-elementor-widgets' ),
			'top-products'          => esc_html__( 'Top Rated Products', 'ocanus-elementor-widgets' ),
		];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'phone',
			[
				'label' => esc_html__( 'Phone', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'address',
			[
				'label' => esc_html__( 'Address', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		oew_elementor_option_button_content( $this, [
			'indent_position' => '',
			'divider'         => true,
			'align'           => false,
			'icon'            => true,
		], false );

		$this->end_controls_section();
	}

	protected function add_layout_product_controls() {
		$this->start_controls_section(
			'section_product_content',
			[
				'label' => __( 'Product', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_query_content( $this, [
			'filter_value'     => $this->oew_get_product_filterby_options(),
			'filter_default'   => 'recent-products',
			'order_by_value'   => $this->oew_get_product_orderby_options(),
			'order_by_default' => 'date',
			'order'            => true,
			'per_page_default' => 8,
			'multiple'         => true,
		], false );

		$this->add_control(
			'product_title_tag',
			[
				'label'   => esc_html__( 'Product Title Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'        => 'product_image',
				'exclude'     => [ 'custom' ],
				'default'     => 'medium',
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 4,
			'column'         => true,
			'arrows_skin'    => false,
			'progress'       => false
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.information .oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'phone',
			'label'    => esc_html__( 'Phone', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.information .phone'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'address',
			'label'    => esc_html__( 'Address', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.information .address'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'content',
			'label'    => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.information .desc'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_button_controls() {
		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => false,
			'selector'        => '.product-information'
		] );
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => false,
		] );
	}

	protected function add_style_Product_controls() {
		$this->start_controls_section(
			'section_product_style',
			[
				'label' => __( 'Product', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'product_title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-product-content .oew-product-title a'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'product_price',
			'label'    => esc_html__( 'Price', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-product-price .woocommerce-Price-amount'
		], false );

		$this->add_control(
			'color_product_price_sale',
			[
				'label'     => esc_html__( 'Color Sale Price', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-product-price del .woocommerce-Price-amount' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'actions_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'actions_heading_style',
			[
				'label' => esc_html__( 'Actions', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs( 'tabs_actions_style' );

		$this->start_controls_tab(
			'tab_actions_normal',
			[
				'label' => esc_html__( 'Normal', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'color_actions',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-actions > div a, {{WRAPPER}} .oew-inner-product .oew-action-addtocart a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'actions_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-actions > div a, {{WRAPPER}} .oew-inner-product .oew-action-addtocart a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_actions_hover',
			[
				'label' => esc_html__( 'Hover', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'color_hover_actions',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-actions > div a:hover,
					{{WRAPPER}} .oew-inner-product .oew-action-wishlist .yith-wcwl-wishlistexistsbrowse>a:hover,
					{{WRAPPER}} .oew-inner-product .oew-action-wishlist .yith-wcwl-wishlistaddedbrowse>a:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'actions_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-actions > div a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-inner-product .oew-action-wishlist .yith-wcwl-wishlistexistsbrowse>a, 
					{{WRAPPER}} .oew-inner-product .oew-action-wishlist .yith-wcwl-wishlistaddedbrowse>a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'addtocart_heading_style_hover',
			[
				'label'     => esc_html__( 'Add To Cart', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'addtocart_hover_color',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product oew-actions > .oew-action-addtocart a:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'addtocart_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product oew-actions > .oew-action-addtocart a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_product_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
		$this->add_style_button_controls();
		$this->add_style_slider_controls();
		$this->add_style_Product_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title_tag          = oew_get_value_in_array( $settings, 'title_tag' );
		$title              = oew_get_value_in_array( $settings, 'title' );
		$phone              = oew_get_value_in_array( $settings, 'phone' );
		$address            = oew_get_value_in_array( $settings, 'address' );
		$content            = oew_get_value_in_array( $settings, 'content' );
		$product_title_tag  = oew_get_value_in_array( $settings, 'product_title_tag' );
		$product_image_size = oew_get_value_in_array( $settings, 'product_image_size' );

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this, true ) . "}'";
		$args             = oew_product_query_control( $this );
		$query            = new \WP_Query( $args );

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-product-information',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = '<div class="oew-row">';

		$html[] = '<div class="product-information oew-col-12 oew-col-sm-6 oew-col-md-4 oew-col-lg-4 oew-col-xl-3">';
		$html[] = '<div class="information">';
		$html[] = '<div class="image">' . Group_Control_Image_Size::get_attachment_image_html( $settings ) . '</div>';
		$html[] = '<div class="detail">';
		$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
		$html[] = $phone ? '<div class="phone"><i class="la la-phone"></i>' . $phone . '</div>' : '';
		$html[] = $address ? '<div class="address">' . $address . '</div>' : '';
		$html[] = '</div>';
		$html[] = '</div>';
		$html[] = '<div class="content">';
		$html[] = $content ? '<div class="desc">' . $content . '</div>' : '';
		$html[] = oew_render_button( $settings );
		$html[] = '</div>';

		$html[] = '</div>';

		$html[] = '<div class="oew-slick-style oew-col-12 oew-col-sm-6 oew-col-md-8 oew-col-lg-8 oew-col-xl-9">';
		if ( $query->have_posts() ):
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			while ( $query->have_posts() ) :
				$query->the_post();
				$html[] = '<div class="column">';
				$html[] = '<div class="oew-inner-product">';
				$html[] = '<div class="oew-product-image-wrapper">';
				$html[] = oew_render_ui_component_product( 'image', [
					'image_size'  => $product_image_size,
					'image_hover' => false,
				] );
				$html[] = '</div>';
				$html[] = '<div class="oew-product-content">';
				$html[] = oew_render_ui_component_product( 'title', [ 'tag' => $product_title_tag ] );
				$html[] = oew_render_ui_component_product( 'price' );
				$html[] = '<div class="oew-actions">';
				$html[] = oew_render_ui_component_product( 'quickview', [ 'icon' => '<i class="las la-expand-arrows-alt"></i>' ] );
				$html[] = oew_render_ui_component_product( 'wishlist' );
				$html[] = oew_render_ui_component_product( 'compare' );
				$html[] = oew_render_ui_component_product( 'addtocart', [ 'icon' => '<i class="nav-icon la la-cart-arrow-down"></i>' ] );
				$html[] = '</div>';
				$html[] = '</div>';

				$html[] = '</div>';
				$html[] = '</div>';
			endwhile;
			$html[] = wp_reset_postdata();
			$html[] = '</div>';
		endif;
		$html[] = '</div>';

		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Product_Information() );
}