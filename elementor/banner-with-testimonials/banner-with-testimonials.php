<?php

use Elementor\Group_Control_Image_Size;

class Oew_Widget_Banner_With_Testimonials extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-banner-with-testimonials';
	}

	public function get_title() {
		return esc_html__( 'Banner With Testimonials', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-slider-album oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-admin-script', 'oew-banner-with-testimonials' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'oew-banner-with-testimonials' ];
	}

	protected function add_layout_banner_controls() {
		$this->start_controls_section(
			'section_banner_content',
			[
				'label' => esc_html__( 'Banner', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gallery_warning_text',
			[
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Display up to 5 images', 'ocanus-elementor-widgets' ),
				'content_classes' => 'oew-warning',
			]
		);

		$repeater = new \Elementor\Repeater();

		oew_elementor_option_image_content( $repeater, false, false );

		$repeater->add_control(
			'banner_effect',
			[
				'label'   => esc_html__( 'Effect', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'border',
				'options' => [
					'border'      => 'Border',
					'zoom'        => 'Zoom',
					'zoom-border' => 'Zoom Border',
				],
			]
		);

		$this->add_control(
			'banners',
			[
				'label'  => __( 'Banners', 'ocanus-elementor-widgets' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_testimonials_controls() {
		$this->start_controls_section(
			'section_testimonials_content',
			[
				'label' => esc_html__( 'Testimonials', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'review',
			[
				'label' => esc_html__( 'Review', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$repeater->add_control(
			'author',
			[
				'label' => esc_html__( 'Author', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'  => __( 'Testimonials', 'ocanus-elementor-widgets' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 1,
			'column_max'     => 2,
			'column'         => true,
			'arrows_skin'    => false,
			'progress'       => false
		] );
	}

	protected function add_style_testimonials_controls() {
		$this->start_controls_section(
			'section_style_testimonials',
			[
				'label' => esc_html__( 'Testimonials', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'quote',
			'label'    => esc_html__( 'Quote Icon', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-testimonial-wrapper .oew-quote'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'reviews',
			'label'    => esc_html__( 'Reviews', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-testimonial-wrapper .oew-review'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'author',
			'label'    => esc_html__( 'Author', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-testimonial-wrapper .oew-author'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_slider_controls() {
		$this->start_controls_section(
			'section_style_slider',
			[
				'label' => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_arrow',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow i' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'background_arrow',
			[
				'label'     => esc_html__( 'Background', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow i' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'color_arrow_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow i:hover' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'background_arrow_hover',
			[
				'label'     => esc_html__( 'Background Hover', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow i:hover' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_banner_controls();
		$this->add_layout_testimonials_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_testimonials_controls();
		$this->add_style_slider_controls();
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$banners      = $settings['banners'];
		$testimonials = $settings['testimonials'];

		$banner_list        = array_slice( $banners, 0, 5 );
		$banner_top_left    = array_slice( $banners, 0, 2 );
		$banner_bottom_left = array_slice( $banners, 2, 2 );
		$banner_last        = array_pop( $banner_list );

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this, true ) . "}'";

		$html = array();

		$class_attrs = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-banner-with-testimonials',
		);

		$html[] = '<div class="' . implode( ' ', $class_attrs ) . '"><div class="oew-elementor-inner">';
		$html[] = '<div class="oew-row">';

		$html[] = '<div class="oew-col-xs-12 oew-col-md-6">'; //== [ Left ]
		$html[] = $this->banners_render( $banner_top_left );

		if ( ! empty( $testimonials ) ) {
			$html[] = '<div class="oew-testimonial-wrapper oew-slick-style">';
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			foreach ( $testimonials as $item ) {
				$review = oew_get_value_in_array( $item, 'review' );
				$author = oew_get_value_in_array( $item, 'author' );

				$html[] = '<div class="oew-testimonial-item">';
				$html[] = '<div class="oew-testimonial-content">';
				$html[] = '<div class="oew-quote"><i class="fas fa-quote-left"></i></div>';
				$html[] = $review ? '<p class="oew-review">' . esc_attr( $review ) . '</p>' : '';
				$html[] = $author ? '<h4 class="oew-author">' . esc_attr( $author ) . '</h4>' : '';
				$html[] = '</div>';
				$html[] = '</div>';

			}
			$html[] = '</div>';

			$html[] = oew_render_slider_ui_control( [
				'layout'         => 'navigation',
				'navigation'     => oew_get_value_in_array( $settings, 'show_arrows' ),
				'navi_icon_prev' => '<i class="fas fa-chevron-left"></i>',
				'navi_icon_next' => '<i class="fas fa-chevron-right"></i>',
			] );
			$html[] = '</div>';
		}

		$html[] = $this->banners_render( $banner_bottom_left );
		$html[] = '</div>';

		$html[] = '<div class="oew-col-xs-12 oew-col-md-6">'; //== [ Right ]
		$html[] = $this->banners_render( $banner_last, 'right' );
		$html[] = '</div>'; //== [ End Right ]

		$html[] = '</div>';
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function banners_render( $banners, $position = 'left' ) {
		if ( empty( $banners ) ) {
			return;
		}
		$banner_output = '';
		switch ( $position ) {
			case 'left':
				$banner_output .= '<div class="box-banner">';
				foreach ( $banners as $banner ) {
					$banner_effect = oew_get_value_in_array( $banner, 'banner_effect' );

					$banner_output .= '<div class="item-banner effect-' . $banner_effect . '"><div class="item-effect">';
					$banner_output .= Group_Control_Image_Size::get_attachment_image_html( $banner );
					$banner_output .= '</div></div>';
				}
				$banner_output .= '</div>';
				break;
			case 'right':
				$banner_effect = oew_get_value_in_array( $banners, 'banner_effect' );

				$banner_output .= '<div class="item-banner effect-' . $banner_effect . '"><div class="item-effect">';
				$banner_output .= Group_Control_Image_Size::get_attachment_image_html( $banners );
				$banner_output .= '</div></div>';
				break;
		}

		return $banner_output;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Banner_With_Testimonials() );
