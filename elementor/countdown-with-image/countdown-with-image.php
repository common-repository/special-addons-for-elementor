<?php

use Elementor\Group_Control_Image_Size;

class Oew_Widget_Countdown_With_Image extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-countdown-with-image';
	}

	public function get_title() {
		return esc_html__( 'Countdown With Image', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-countdown oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-countdown-with-image' ];
	}

	public function get_style_depends() {
		return [ 'oew-countdown-with-image' ];
	}

	protected function add_layout_heading_controls() {
		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => true,
		] );
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_image_content( $this, false, false );

		$this->add_control(
			'date_time',
			[
				'label' => esc_html__( 'Date Time', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::DATE_TIME,
			]
		);

		$this->add_control(
			'icon_layout_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label' => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		oew_elementor_option_icon_content( $this, false );

		oew_elementor_option_button_content( $this, [
			'indent_position' => '',
			'divider'         => true,
			'align'           => false,
			'icon'            => false,
		], false );

		$this->end_controls_section();

	}

	protected function add_style_heading_controls() {
		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => true,
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color_heading',
			[
				'label' => esc_html__( 'Countdown', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-countdown .oew-data' => 'color: {{VALUE}}; background: {{VALUE}};',
				]
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'number',
			'label'    => esc_html__( 'Number', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-countdown .oew-data .oew-time'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'text',
			'label'    => esc_html__( 'Text', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-countdown .oew-data .oew-text'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'icon',
			'label'    => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.icon'
		], false );

		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => true,
			'selector'        => ''
		], false );

		$this->end_controls_section();

	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_heading_controls();
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_content_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$date_time = oew_get_value_in_array( $settings, 'date_time' );
		$gmt       = get_option( 'gmt_offset' );
		$now       = current_time( 'timestamp' );
		$end       = strtotime( date($date_time) );

		$dataCountDown = array(
			array(
				'class' => 'oew-days',
				'time'  => 0,
				'text'  => esc_html__( 'Days', 'ocanus-elementor-widgets' )
			),
			array(
				'class' => 'oew-hours',
				'time'  => 0,
				'text'  => esc_html__( 'Hours', 'ocanus-elementor-widgets' )
			),
			array(
				'class' => 'oew-mins',
				'time'  => 0,
				'text'  => esc_html__( 'Mins', 'ocanus-elementor-widgets' )
			),
			array(
				'class' => 'oew-secs',
				'time'  => 0,
				'text'  => esc_html__( 'Secs', 'ocanus-elementor-widgets' )
			)
		);
		$class_atts    = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-countdown-with-image',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = '<div class="oew-row">';

		$html[] = '<div class="column oew-col-12 oew-col-md-6">';
		$html[] = '<div class="oew-countdown-content">';
		$html[] = oew_render_heading_title( $settings );

		$html[] = '<div class="oew-countdown" data-end="' . esc_attr( $end ) . '" data-gmt="' . esc_attr( $gmt ) . '">';
		foreach ( $dataCountDown as $countDown ) {
			$class    = oew_get_value_in_array( $countDown, 'class' );
			$dataTime = oew_get_value_in_array( $countDown, 'time' );
			$dataText = oew_get_value_in_array( $countDown, 'text' );

			$html[] = '<div class="oew-data">';
			$html[] = '<span class="oew-time ' . esc_attr( $class ) . '">' . esc_attr( $dataTime ) . '</span>';
			$html[] = '<span class="oew-text">' . esc_attr( $dataText ) . '</span>';
			$html[] = '</div>';
		}
		$html[] = '</div>';

		$html[] = oew_render_icon( $settings );
		$html[] = oew_render_button( $settings );

		$html[] = '</div>';
		$html[] = '</div>';

		$html[] = '<div class="column oew-col-12 oew-col-md-6">';
		$html[] = '<div class="oew-image">';
		$html[] = Group_Control_Image_Size::get_attachment_image_html( $settings );
		$html[] = '</div>';
		$html[] = '</div>';

		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Countdown_With_Image() );
