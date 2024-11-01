<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 24/08/2021
 * Time: 8:21 CH
 */

class Oew_Widget_Instagram extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_instagram';
	}

	public function get_title() {
		return esc_html__( 'Instagram', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-instagram-likes oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-script' ];
	}

	public function get_style_depends() {
		return [ 'oew-instagram' ];
	}

	protected function add_layout_general_controls() {
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__( 'General', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => __( 'Heading Tag', 'ocanus-elementor-widgets' ),
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
			'heading',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'config_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'access_token',
			[
				'label' => esc_html__( 'Access Token', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'number_image',
			[
				'label'   => esc_html__( 'Number Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 5,
			'column'         => true,
			'arrows_skin'    => true,
			'progress'       => true
		] );
	}

	protected function add_content_style_controls() {
		oew_elementor_option_typo_style( $this, [
			'name'     => 'heading_title',
			'label'    => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-heading-title'
		] );
	}

	protected function add_slider_style_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => true,
			'background_arrow' => true,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_general_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_content_style_controls();
		$this->add_slider_style_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$access_token = oew_get_value_in_array( $settings, 'access_token' );
		$number_image = oew_get_value_in_array( $settings, 'number_image' );

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this ) . "}'";
		$instagram_photos = oew_get_instagram_photos( $access_token, false, $number_image );
		$count            = is_array( $instagram_photos ) ? count( $instagram_photos ) : 1;

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-instagram',
		);

		$html = array();

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );

		$html[] = '<div class="instagram-items oew-slick-style">';
		if ( ! empty( $instagram_photos ) && ! isset( $instagram_photos->errors ) ) {
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			foreach ( $instagram_photos as $photo ) {
				$code  = oew_get_value_in_array( $photo, 'code' );
				$image = oew_get_value_in_array( $photo, 'image' );
				$url   = oew_get_value_in_array( $photo, 'url' );
				$alt   = oew_get_value_in_array( $photo, 'alt' );

				$html[] = '<div class="insta-item">';
				$html[] = '<a href="' . $url . '" target="_blank" rel="noopener nofollow">';
				$html[] = '<img src="' . $image . '" alt="' . $alt . '">';
				$html[] = '</a>';
				$html[] = '</div>';
			}
			$html[] = '</div>';
		}
		$html[] = '</div>';
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Instagram() );