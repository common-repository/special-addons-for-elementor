<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 31/08/2021
 * Time: 10:16 SA
 */

class Oew_Widget_Featured_Categories extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_featured_category';
	}

	public function get_title() {
		return esc_html__( 'Featured Category', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-table oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-featured-categories' ];
	}

	public function get_style_depends() {
		return [ 'oew-featured-categories' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => '',
			'divider'     => false,
			'description' => true,
		], false );

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
			'category_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'enable_slider',
			[
				'label'     => esc_html__( 'Enable Slider', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => ''
			]
		);

		$this->add_control(
			'enable_view_all',
			[
				'label'     => esc_html__( 'Enable View All', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'view_all',
			[
				'label'     => esc_html__( 'View All Text', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 'View All',
				'condition' => [
					'enable_view_all' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_cat_ids',
			[
				'label'       => esc_html__( 'Product Category', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'object_type' => 'product_cat',
				'options'     => wp_list_pluck( get_terms( 'product_cat' ), 'name', 'term_id' ),
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 4,
			'column'         => true,
			'arrows_skin'    => true,
			'progress'       => true
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => true,
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-title, .oew-title a'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'content',
			'label'    => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.content, .content .list-child a'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'view_all',
			'label'    => esc_html__( 'View All', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.content > .view-all'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => true,
			'background_arrow' => true,
		] );
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

		$enable_divider   = oew_get_value_in_array( $settings, 'enable_divider' );
		$enable_underline = oew_get_value_in_array( $settings, 'enable_underline' );
		$enable_slider    = oew_get_value_in_array( $settings, 'enable_slider' );
		$enable_view_all  = oew_get_value_in_array( $settings, 'enable_view_all' );
		$view_all         = oew_get_value_in_array( $settings, 'view_all' );
		$product_cat_ids  = oew_get_value_in_array( $settings, 'product_cat_ids' );

		$terms = array();
		foreach ( $product_cat_ids as $product_cat_id ) {
			$terms[] = get_term( $product_cat_id, 'product_cat' );
		}
		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this ) . "}'";

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-featured-category',
			$enable_divider === 'yes' ? 'oew-heading-divider' : '',
			$enable_underline === 'yes' ? 'oew-heading-underline' : '',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';
		$html[] = oew_render_heading_title( $settings );

		if ( ! empty( $terms ) ) {
			$html[] = '<div class="content-category-wrapper">';
			$html[] = $enable_slider === 'yes' ? '<div class="oew-row oew-slick" ' . $slide_attributes . '>' : '<div class="oew-row">';
			foreach ( $terms as $term ) {
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$thumb_url    = wp_get_attachment_url( $thumbnail_id );
				$image        = oew_image_resize( $thumb_url, 250, 250, true );
				$link         = get_term_link( $term->term_id, 'product_cat' );
				$title        = $term->name;

				$classes = array(
					'column ',
					$enable_slider === 'yes' ? '' : 'oew-col-12 oew-col-sm-6 oew-col-lg-4 oew-col-xl-3'
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';
				$html[] = '<div class="inner-item">';
				if ( $thumb_url ) {
					$html[] = '<div class="item-image">';
					$html[] = '<a href="' . esc_attr( $link ) . '" title="' . esc_attr( $title ) . '">';
					$html[] = '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $title ) . '">';
					$html[] = '</a>';
					$html[] = '</div>';
				}
				$html[] = '<div class="item-content">';
				$html[] = '<h5 class="oew-title">';
				$html[] = '<a href="' . esc_attr( $link ) . '" title="' . esc_attr( $title ) . '">' . esc_attr( $title ) . '</a>';
				$html[] = '</h5>';
				$html[] = '<div class="content">';

				$terms_child = get_terms(
					array(
						'taxonomy' => 'product_cat',
						'parent'   => $term->term_id,
						'number'   => $enable_view_all === 'yes' ? 3 : 4
					)
				);
				if ( ! empty( $terms_child ) ) {
					$html[] = '<ul class="list-child">';
					foreach ( $terms_child as $child ) {
						$html[] = '<li><a href="' . esc_attr( $link ) . '" title="' . esc_attr( $child->name ) . '">' . esc_attr( $child->name ) . '</a></li>';
					}
					$html[] = '</ul>';
				}
				if ( $enable_view_all === 'yes' ) {
					$html[] = '<a class="view-all" href="' . esc_attr( $link ) . '" title="' . esc_attr( $view_all ) . '">' . esc_attr( $view_all ) . '</a>';
				}
				$html[] = '</div>';
				$html[] = '</div>'; //== [ End item content ]

				$html[] = '</div>';
				$html[] = '</div>'; //== [ End Column ]
			}
			$html[] = '</div>';
			$html[] = '</div>';
		}
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));

	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Featured_Categories() );