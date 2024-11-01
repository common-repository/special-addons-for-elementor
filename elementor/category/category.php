<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 9/8/2021
 * Time: 5:24 PM
 */

use Elementor\Utils;

class Oew_Widget_Category extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-category';
	}

	public function get_title() {
		return esc_html__( 'Category', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-product-categories oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'slick', 'oew-category' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'oew-category' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => esc_html__( 'content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'        => esc_html__( 'Layout', 'ocanus-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => [
					'default' => 'Default',
					'ziczac'  => 'Ziczac',
				],
				'prefix_class' => 'oew-category-layout-',
			]
		);

		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => false,
		], false );

		$this->add_control(
			'category_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'category_heading_content',
			[
				'label' => esc_html__( 'Category', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'category_tag',
			[
				'label'   => esc_html__( 'Category Tag', 'ocanus-elementor-widgets' ),
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

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 4,
			'column'         => true,
			'column_max'     => 8,
			'arrows_skin'    => true,
			'progress'       => true
		] );
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => true,
			'background_arrow' => true,
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_layout_default_style',
			[
				'label' => esc_html__( 'content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.inner-item .item-content .oew-title'
		], false, true );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'sub_category',
			'label'    => esc_html__( 'Sub Category', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.inner-item .sub-category li a'
		], false, true );

		$this->add_control(
			'ziczac_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'ziczac_heading_style',
			[
				'label' => esc_html__( 'Ziczac', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'color_line_image',
			[
				'label'     => esc_html__( 'Border Image Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-item .item-image a:before' => 'border-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'color_background_overlay',
			[
				'label'     => esc_html__( 'Background Overlay Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-item .item-count' => 'background-color: {{VALUE}};'
				]
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'count',
			'label'    => esc_html__( 'Count Items', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.inner-item .item-count span'
		], false, true );

		$this->add_control(
			'color_background_count',
			[
				'label'     => esc_html__( 'Background Count Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-item .item-count span' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'color_hover_background_count',
			[
				'label'     => esc_html__( 'Hover Background Count Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .inner-item .item-count span:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
		$this->add_style_slider_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$layout       = oew_get_value_in_array( $settings, 'layout' );
		$category_tag = oew_get_value_in_array( $settings, 'category_tag' );

		$args             = array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => 1
		);
		$categories       = get_categories( $args );
		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this ) . "}'";

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-category',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );

		if ( ! empty( $categories ) ) {
			$html[] = '<div class="oew-category-wrapper oew-slick-style">';
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			foreach ( $categories as $category ) {
				if ( $category->category_parent === 0 ) {
					$html[] = '<div class="column">';
					switch ( $layout ) {
						case 'default':
							$html[] = $this->render_layout_default( $category, $category_tag );
							break;
						case 'ziczac':
							$html[] = $this->render_layout_ziczac( $category, $category_tag );
							break;
					}
					$html[] = '</div>';
				}
			}
			$html[] = '</div>';
			$html[] = '</div>';
		}
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function render_layout_default( $data, $tag ) {
		$thumbnail_id = get_term_meta( $data->term_id, 'thumbnail_id', true );
		$thumb_url    = wp_get_attachment_url( $thumbnail_id );
		$thumb_url    = ! empty( $thumb_url ) ? $thumb_url : Utils::get_placeholder_image_src();

		$child       = array(
			'taxonomy'   => 'product_cat',
			'number'     => 4,
			'orderby'    => 'id',
			'parent'     => $data->term_id,
			'hide_empty' => false,
		);
		$terms_child = get_terms( $child );

		$default_html = '<div class="inner-item">';
		$default_html .= '<div class="item-image">';
		$default_html .= '<a href="' . get_term_link( $data->term_id ) . '" title="' . esc_attr( $data->name ) . '">';
		$default_html .= '<img src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( $data->name ) . '">';
		$default_html .= '</a>';
		$default_html .= '</div>';
		$default_html .= '<div class="item-content">';
		$default_html .= '<' . $tag . ' class="oew-title">' . $data->name . '</' . $tag . '>';
		if ( ! empty( $terms_child ) ) {
			$default_html .= '<ul class="sub-category">';
			foreach ( $terms_child as $t_child ) {
				$default_html .= '<li><a href="' . esc_url( get_term_link( $t_child, 'product_cat' ) ) . '">' . esc_html( $t_child->name ) . '</a></li>';
			}
			$default_html .= '</ul>';
		}
		$default_html .= '</div>';
		$default_html .= '</div>';

		return $default_html;
	}

	protected function render_layout_ziczac( $data, $tag ) {
		$item_txt     = $data->count > 1 ? esc_html__( 'items', 'ocanus-elementor-widgets' ) : esc_html__( 'item', 'ocanus-elementor-widgets' );
		$thumbnail_id = get_term_meta( $data->term_id, 'thumbnail_id', true );
		$thumb_url    = wp_get_attachment_url( $thumbnail_id );
		$thumb_url    = ! empty( $thumb_url ) ? $thumb_url : Utils::get_placeholder_image_src();

		$zic_html = '<div class="inner-item">';
		$zic_html .= '<div class="item-image">';
		$zic_html .= '<a href="' . get_term_link( $data->term_id ) . '" title="' . esc_attr( $data->name ) . '">';
		$zic_html .= '<img src="' . esc_url( $thumb_url ) . '" alt="' . esc_attr( $data->name ) . '">';
		$zic_html .= '<div class="item-count"><span>' . $data->count . ' ' . $item_txt . '</span></div>';
		$zic_html .= '</a>';
		$zic_html .= '</div>';
		$zic_html .= '<div class="item-content">';
		$zic_html .= '<' . $tag . ' class="oew-title"><a href="' . get_term_link( $data->term_id ) . '">' . $data->name . '</a></' . $tag . '>';
		$zic_html .= '</div>';
		$zic_html .= '</div>';

		return $zic_html;
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Category() );
}