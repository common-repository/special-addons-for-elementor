<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 01/09/2021
 * Time: 8:33 CH
 */

use Elementor\Group_Control_Image_Size;

class Oew_Widget_Product_Featured_Tabs extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-product-featured-tabs';
	}

	public function get_title() {
		return esc_html__( 'Product Featured Tabs', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-product-tabs oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'slick', 'oew-product-featured-tabs' ];
	}

	public function get_style_depends() {
		return [ 'oew-product-featured-tabs', 'oew-line-awesome' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_heading_content',
			[
				'label' => __( 'Heading', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_divider',
			[
				'label'     => esc_html__( 'Enable Divider', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'enable_underline',
			[
				'label'     => esc_html__( 'Enable Underline', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => esc_html__( 'Heading Tag', 'ocanus-elementor-widgets' ),
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

		$this->end_controls_section();
	}

	protected function add_layout_query_controls() {
		$this->start_controls_section(
			'section_query_content',
			[
				'label' => __( 'Query', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_category',
			[
				'label'       => esc_html__( 'Product Category', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'object_type' => 'product_cat',
				'options'     => wp_list_pluck( get_terms( 'product_cat' ), 'name', 'term_id' ),
			]
		);

		$this->add_control( 'query_default_value', [
			'label'   => esc_html__( 'Default Value', 'ocanus-elementor-widgets' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => 'new',
			'options' => [
				'new'       => esc_html__( 'New', 'ocanus-elementor-widgets' ),
				'featured'  => esc_html__( 'Featured', 'ocanus-elementor-widgets' ),
				'best_sell' => esc_html__( 'Best sellers', 'ocanus-elementor-widgets' ),
			]
		] );

		$this->add_control( 'query_order', [
			'label'   => __( 'Order', 'ocanus-elementor-widgets' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'ASC'  => 'Ascending',
				'DESC' => 'Descending',
			],
			'default' => 'DESC',
		] );

		$this->add_control( 'query_number_product', [
			'label'   => __( 'Number Of Product', 'ocanus-elementor-widgets' ),
			'type'    => \Elementor\Controls_Manager::NUMBER,
			'default' => 8,
			'min'     => 1,
			'max'     => 100,
			'step'    => 1,
		] );

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
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'      => esc_html__( 'Margin', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .oew-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'heading_padding',
			[
				'label'      => esc_html__( 'Padding', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .oew-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'color_divider',
			[
				'label'     => esc_html__( 'Divider Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title' => 'border-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'color_underline',
			[
				'label'     => esc_html__( 'Underline Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title:after' => 'background-color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'color_heading',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title .oew-heading-title' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'color_active_heading',
			[
				'label'     => esc_html__( 'Active Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title .oew-heading-title span.active' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => false,
		] );
	}

	protected function add_style_product_controls() {
		$this->start_controls_section(
			'section_product_style_content',
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
			'label'    => esc_html__( 'Color Price', 'ocanus-elementor-widgets' ),
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

		oew_elementor_option_typo_style( $this, [
			'name'     => 'product_author',
			'label'    => esc_html__( 'Color Author', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-product-content .oew-product-author a'
		], false );

		$this->add_control(
			'color_product_author_by',
			[
				'label'     => esc_html__( 'Color Author By', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-product-content .oew-product-author span' => 'color: {{VALUE}}'
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

		$this->add_control(
			'addtocart_heading_style',
			[
				'label' => esc_html__( 'Add To Cart', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'color_addtocart',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product:hover .oew-action-addtocart a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'background_addtocart_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product:hover .oew-action-addtocart a' => 'background-color: {{VALUE}};',
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
				'label' => esc_html__( 'Add To Cart', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'addtocart_hover_color',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-action-addtocart a:hover' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'addtocart_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-inner-product .oew-action-addtocart a:hover' => 'background-color: {{VALUE}};',
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
		$this->add_layout_query_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
		$this->add_style_slider_controls();
		$this->add_style_product_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$enable_divider       = oew_get_value_in_array( $settings, 'enable_divider' );
		$enable_underline     = oew_get_value_in_array( $settings, 'enable_underline' );
		$heading_tag          = oew_get_value_in_array( $settings, 'heading_tag' );
		$product_title_tag    = oew_get_value_in_array( $settings, 'product_title_tag' );
		$query_default_value  = oew_get_value_in_array( $settings, 'query_default_value' );
		$query_number_product = oew_get_value_in_array( $settings, 'query_number_product' );
		$product_image_size   = oew_get_value_in_array( $settings, 'product_image_size' );

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-product-featured-tabs',
			$enable_divider === 'yes' ? 'oew-heading-divider' : '',
			$enable_underline === 'yes' ? 'oew-heading-underline' : '',
		);

		$active_new       = $query_default_value === 'new' ? ' active' : '';
		$active_featured  = $query_default_value === 'featured' ? ' active' : '';
		$active_best_sell = $query_default_value === 'best_sell' ? ' active' : '';
		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this, true ) . "}'";
		$args             = $this->product_query_render();
		$query            = new \WP_Query( $args );

		$json_param = json_encode( $settings );

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = '<div class="tabs-title-top">';
		$html[] = '<div class="oew-section-title">';
		$html[] = '<' . $heading_tag . ' class="oew-heading-title">';
		$html[] = '<span class="action-filter' . $active_new . '" data-filter="new">' . esc_html__( 'New Arrivals', 'ocanus-elementor-widgets' ) . '</span>';
		$html[] = '<span class="action-filter' . $active_featured . '" data-filter="featured">' . esc_html__( 'Featured Products', 'ocanus-elementor-widgets' ) . '</span>';
		$html[] = '<span class="action-filter' . $active_best_sell . '" data-filter="best_sell">' . esc_html__( 'Best Sellers', 'ocanus-elementor-widgets' ) . '</span>';
		$html[] = '</' . $heading_tag . '>';
		$html[] = '</div>';
		$html[] = oew_render_slider_ui_control( [
			'layout'         => 'navigation',
			'navi_icon_prev' => '<i class="la la-long-arrow-left"></i>',
			'navi_icon_next' => '<i class="la la-long-arrow-right"></i>',
			'navigation'     => oew_get_value_in_array( $settings, 'show_arrows' ),
		] );
		$html[] = '</div>';

		$html[] = '<div class="tab-product-content oew-slick-style">';

		$html[] = '<input type="hidden" class="oew-params" data-params="' . base64_encode( $json_param ) . '"data-page="' . $query_number_product . '" data-type="new"/>';

		$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';

		if ( $query->have_posts() ):
			while ( $query->have_posts() ) :
				$query->the_post();
				//== [ Item ]
				$html[] = '<div class="column oew-col-12">';
				$html[] = '<div class="oew-inner-product">';

				$html[] = '<div class="oew-product-image-wrapper">';
				$html[] = oew_render_ui_component_product( 'image', [
					'image_size'  => $product_image_size,
					'image_hover' => true,
				] );
				$html[] = '<div class="oew-actions">';
				//				$html[] = oew_render_ui_component_product( 'compare' );
				$html[] = oew_render_ui_component_product( 'wishlist' );
				$html[] = oew_render_ui_component_product( 'quickview', [ 'icon' => '<i class="las la-expand-arrows-alt"></i>' ] );
				$html[] = '</div>';
				$html[] = '</div>';

				$html[] = '<div class="oew-product-content">';
				$html[] = '<div class="oew-group-price-atc">';
				$html[] = oew_render_ui_component_product( 'price' );
				$html[] = oew_render_ui_component_product( 'addtocart', [ 'icon' => '<i class="nav-icon la la-cart-arrow-down"></i>' ] );
				$html[] = '</div>';
//				$html[] = oew_render_ui_component_product( 'category' );
				$html[] = oew_render_ui_component_product( 'title', [ 'tag' => $product_title_tag ] );
//				$html[] = oew_render_ui_component_product( 'rating' );
				$html[] = oew_render_ui_component_product( 'author' );
				$html[] = '</div>';

				$html[] = '</div>';
				$html[] = '</div>';
			endwhile;
			$html[] = wp_reset_postdata();
		endif;

		$html[] = '</div>';
		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function product_query_render() {
		$settings = $this->get_settings_for_display();

		$product_category     = oew_get_value_in_array( $settings, 'product_category' );
		$query_default_value  = oew_get_value_in_array( $settings, 'query_default_value' );
		$query_order          = oew_get_value_in_array( $settings, 'query_order' );
		$query_number_product = oew_get_value_in_array( $settings, 'query_number_product' );

		$tax_query  = array();
		$meta_query = array();

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => $query_number_product,
			'order'          => $query_order,
			'tax_query'      => $tax_query,
			'meta_query'     => $meta_query,
		);

		if ( $product_category ) {
			$cat_query   = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $product_category,
			);
			$tax_query[] = $cat_query;
		}

		switch ( $query_default_value ) {
			case 'new':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_stock';
				break;
			case 'featured':
				$tax_query[] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				);
				break;
			case 'best_sell':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'total_sales';
				break;
			case 'sale':
				$meta_query[] = array(
					array(
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric'
					),
				);
				break;
			case 'hight_rate':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_wc_average_rating';
				break;
		}
//		$args['tax_query']  = $tax_query;
//		$args['meta_query'] = $meta_query;

		return $args;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Product_Featured_Tabs() );