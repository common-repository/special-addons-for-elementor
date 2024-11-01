<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 9/5/2021
 * Time: 8:52 PM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Category_Product_Counter extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-category-product-counter';
	}

	public function get_title() {
		return esc_html__( 'Category Product Counter', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-product-categories oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-category-product-counter' ];
	}

	public function get_style_depends() {
		return [ 'oew-category-product-counter' ];
	}

	protected function add_layout_heading_controls() {
		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => false,
		] );
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
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => 'Grid',
					'list' => 'List',
				],
			]
		);

		$column = range( 1, 6 );
		$column = array_combine( $column, $column );
		$this->add_responsive_control(
			'column',
			[
				'type'               => \Elementor\Controls_Manager::SELECT,
				'label'              => esc_html__( 'Column', 'ocanus-elementor-widgets' ),
				'options'            => $column,
				'desktop_default'    => 4,
				'tablet_default'     => 3,
				'mobile_default'     => 2,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'enable_min_price',
			[
				'label'     => esc_html__( 'Enable Min Price', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => 'yes'
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

		$this->add_control(
			'number_of_item',
			[
				'label'   => __( 'Number Of Item', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'max'     => 12,
				'step'    => 1,
			]
		);

		$this->add_control(
			'banner_heading_content',
			[
				'label' => esc_html__( 'Banner', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'content_position',
			[
				'label'   => esc_html__( 'Content Position', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => [
					'top-left'      => 'Top Left',
					'top-center'    => 'Top Center',
					'top-right'     => 'Top Right',
					'middle-left'   => 'Middle Left',
					'middle-center' => 'Middle Center',
					'middle-right'  => 'Middle Right',
					'bottom-left'   => 'Bottom Left',
					'bottom-center' => 'Bottom Center',
					'bottom-right'  => 'Bottom Right',
				],
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label'     => esc_html__( 'Alignment', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .oew-banner-content .oew-inner-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'ocanus-elementor-widgets' ),
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

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
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

	protected function add_style_heading_controls() {
		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => false,
		], false );

		$this->add_control(
			'color_divider',
			[
				'label'     => esc_html__( 'Divider Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title:before, {{WRAPPER}} .oew-section-title:after' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_banner_controls() {
		$this->start_controls_section(
			'section_banner_style',
			[
				'label' => __( 'Banner Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'banner_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .oew-banner-content .oew-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_control(
			'banner_content_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-banner-content .oew-inner-content' => 'background-color: {{VALUE}};',
				],
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'banner_title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-inner-content .oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'banner_Content',
			'label'    => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-inner-content .content'
		], false );

		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => true,
			'selector'        => ''
		], false );

		$this->end_controls_section();
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
			'name'     => 'content_title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-category-item-wrapper .item-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'content_count',
			'label'    => esc_html__( 'Count', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-category-item-wrapper .item-count'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'content_price',
			'label'    => esc_html__( 'Price', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-category-item-wrapper .item-price'
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_heading_controls();
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_banner_controls();
		$this->add_style_content_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout           = oew_get_value_in_array( $settings, 'layout' );
		$column           = oew_get_value_in_array( $settings, 'column' );
		$column_tablet    = oew_get_value_in_array( $settings, 'column_tablet' );
		$column_mobile    = oew_get_value_in_array( $settings, 'column_mobile' );
		$product_category = oew_get_value_in_array( $settings, 'product_category' );
		$number_of_item   = oew_get_value_in_array( $settings, 'number_of_item' );
		$title_tag        = oew_get_value_in_array( $settings, 'title_tag' );
		$title            = oew_get_value_in_array( $settings, 'title' );
		$content          = oew_get_value_in_array( $settings, 'content' );
		$enable_min_price = oew_get_value_in_array( $settings, 'enable_min_price' );
		$content_position = oew_get_value_in_array( $settings, 'content_position' );

		$args = array(
			'taxonomy' => 'product_cat',
			'parent'   => $product_category,
			'number'   => $number_of_item,
		);

		$terms = get_terms( $args );

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-category-product-counter',
			'oew-layout-' . $layout
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );
		$html[] = '<div class="oew-category-wrapper">';
		$html[] = '<div class="oew-row">';

		$html[] = '<div class="oew-col-12 oew-col-xl-3 col-left">';
		$html[] = '<div class="oew-banner-wrapper">';
		$html[] = '<div class="oew-banner-image">' . Group_Control_Image_Size::get_attachment_image_html( $settings ) . '</div>';
		$html[] = '<div class="oew-banner-content position-' . $content_position . '"><div class="oew-inner-content">';
		$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
		$html[] = $content ? '<div class="content">' . $content . '</div>' : '';
		$html[] = oew_render_button( $settings );
		$html[] = '</div></div>';
		$html[] = '</div>';
		$html[] = '</div>';

		if ( ! empty( $terms ) ) {
			$html[] = '<div class="oew-col-12 oew-col-xl-9 col-right"><div class="oew-row oew-category-item-wrapper">';
			foreach ( $terms as $term ) {
				$id           = $term->term_id;
				$title        = $term->name;
				$link         = get_term_link( $id, 'product_cat' );
				$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );
				$image        = wp_get_attachment_url( $thumbnail_id );
				$image_url    = ! $image ? Utils::get_placeholder_image_src() : $image;
				$product      = $term->count > 1 ? esc_html__( 'products', 'ocanus-elementor-widgets' ) : esc_html__( 'product', 'ocanus-elementor-widgets' );

				$classes = array(
					'column',
					'oew-col-' . ( 12 / (int) $column_mobile ),
					'oew-col-md-' . ( 12 / (int) $column_tablet ),
					'oew-col-xl-' . ( 12 / (int) $column )
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="item-inner">';

				$html[] = '<div class="item-image">';
				$html[] = '<a href="' . esc_url( $link ) . '">';
				$html[] = '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $title ) . '">';
				$html[] = '</a>';
				$html[] = '</div>';

				$html[] = '<div class="item-content">';
				$html[] = '<div class="item-title"><a href="' . esc_url( $link ) . '">' . esc_attr( $title ) . '</a></div>';
				$html[] = '<p class="item-count">' . $term->count . ' ' . esc_attr( $product ) . '</p>';
				$html[] = $enable_min_price === 'yes' ? '<div class="item-price">' . esc_html__( 'Form', 'ocanus-elementor-widgets' ) . ' ' . $this->render_product_min_price( $id ) . '</div>' : '';
				$html[] = '</div>';

				$html[] = '</div></div>';
			}
			$html[] = '</div></div>';
		}

		$html[] = '</div>';
		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function render_product_min_price( $cat_id ) {
		global $wpdb;

		$sql = "SELECT  MIN(meta_value+0) as minprice
				FROM {$wpdb->posts} 
				INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)
				INNER JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id) 
				WHERE  ({$wpdb->term_relationships}.term_taxonomy_id IN (%d))
				AND {$wpdb->posts}.post_type = 'product'
				AND {$wpdb->posts}.post_status = 'publish' 
				AND {$wpdb->postmeta}.meta_key = '_price'";

		$price = $wpdb->get_var( $wpdb->prepare( $sql, $cat_id ) );

		return wc_price( $price );
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Category_Product_Counter() );
}