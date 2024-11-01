<?php

class Oew_Widget_Item_Infor_Popup extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-item-infor-popup';
	}

	public function get_title() {
		return esc_html__( 'Item Infor Popup', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-table oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-item-infor-popup' ];
	}

	public function get_style_depends() {
		return [ 'oew-item-infor-popup' ];
	}

	protected function add_layout_items_controls() {
		$this->start_controls_section(
			'section_layout_items',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_image_content( $this, false, false );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-item-popup-wrap {{CURRENT_ITEM}},{{WRAPPER}} .oew-item-popup-wrap {{CURRENT_ITEM}} .bullets' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'position_divider_style',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'position',
			[
				'label'   => esc_html__( 'Choose position', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'default' => 'tl',
				'options' => [
					'tl'     => esc_html__( 'Top left', 'ocanus-elementor-widgets' ),
					'tc'     => esc_html__( 'Top center', 'ocanus-elementor-widgets' ),
					'tr'     => esc_html__( 'Top right', 'ocanus-elementor-widgets' ),
					'br'     => esc_html__( 'Bottom right', 'ocanus-elementor-widgets' ),
					'bl'     => esc_html__( 'Bottom left', 'ocanus-elementor-widgets' ),
					'bc'     => esc_html__( 'Bottom center', 'ocanus-elementor-widgets' ),
					'custom' => esc_html__( 'Custom', 'ocanus-elementor-widgets' ),
				]
			]
		);

		$repeater->add_responsive_control(
			'position_top',
			[
				'label'      => esc_html__( 'Top', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 300,
					],
					'%'  => [
						'min'  => 0.1,
						'max'  => 100,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .oew-item-popup-wrap {{CURRENT_ITEM}}.custom' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'position' => 'custom',
				]
			]
		);

		$repeater->add_responsive_control(
			'position_left',
			[
				'label'      => esc_html__( 'Left', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 300,
					],
					'%'  => [
						'min'  => 0.1,
						'max'  => 100,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .oew-item-popup-wrap {{CURRENT_ITEM}}.custom' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'position' => 'custom',
				]
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Item', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_items_controls() {
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Items', 'ocanus-widget-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'item_title',
			'label'    => esc_html__( 'Title', 'ocanus-widget-elementor' ),
			'divider'  => false,
			'selector' => '.oew-popup-item-content .oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'item_description',
			'label'    => esc_html__( 'Description', 'ocanus-widget-elementor' ),
			'divider'  => false,
			'selector' => '.oew-popup-item-content .oew-description'
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_items_controls();

		//== [ Style Tab ]
		$this->add_style_items_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$bg_image     = oew_get_value_in_array( $settings, 'image' );
		$bg_image_url = oew_get_value_in_array( $bg_image, 'url' );

		$html = array();

		$class_atts = array(
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-item-infor-popup',
		);

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';
		$html[] = '<div class="oew-item-popup-wrap">';
		$html[] = $bg_image_url ? '<img src="' . $bg_image_url . '" alt="">' : '';

		if ( $items ) {
			foreach ( $items as $item ) {
				$id          = oew_get_value_in_array( $item, '_id' );
				$title_tag   = oew_get_value_in_array( $item, 'title_tag' );
				$title       = oew_get_value_in_array( $item, 'title' );
				$description = oew_get_value_in_array( $item, 'description' );
				$position    = oew_get_value_in_array( $item, 'position' );

				$classes = array(
					'oew-popup-item',
					'elementor-repeater-item-' . $id,
					$position
				);

				$html[] = '<div id="oew-popup-item-' . $id . '" class="' . implode( ' ', array_filter( $classes ) ) . '">';
				$html[] = '<div class="oew-popup-item-content">';
				$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
				$html[] = $description ? '<p class="oew-description">' . $description . '</p>' : '';
				$html[] = '</div>';
				$html[] = '<em class="animated animation infinite animation-delay-100 bullets"></em>';
				$html[] = '</div>';
			}
		}

		$html[] = '</div>';
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Item_Infor_Popup() );
