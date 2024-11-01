<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 04/09/2021
 * Time: 1:55 SA
 */

use Elementor\Group_Control_Image_Size;

class Oew_Widget_Banner_Grid extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-banner-grid';
	}

	public function get_title() {
		return esc_html__( 'Banner Grid', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-banner-grid' ];
	}

	public function get_style_depends() {
		return [ 'oew-banner-grid' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'medium',
				'separator' => 'none',
			]
		);

		$repeater->add_responsive_control(
			'content_position',
			[
				'label'   => esc_html__( 'Content Position', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
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
				'default' => 'left',
			]
		);

		$repeater->add_control(
			'color_content',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .item-content .oew-title, {{WRAPPER}} {{CURRENT_ITEM}} .item-content .content' => 'color: {{VALUE}}'
				]
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
			'content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		oew_elementor_option_button_content( $repeater, [
			'indent_position' => 'repeater',
			'divider'         => false,
			'align'           => false,
			'icon'            => true,
		], false );

		$repeater->add_control(
			'custom_style_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'custom_heading_style',
			[
				'label' => esc_html__( 'Custom Style', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$repeater->add_responsive_control(
			'title_repeater_font_size',
			[
				'label' => esc_html__('Title Size', 'ocanus-elementor-widgets'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
					'vw' => [
						'min'  => 0.1,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-title' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$repeater->add_responsive_control(
			'content_repeater_font_size',
			[
				'label'      => esc_html__( 'Content Size', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
					'vw' => [
						'min'  => 0.1,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .content' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$repeater->add_control(
			'button_repeater_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'button_custom_heading_style',
			[
				'label' => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$repeater->start_controls_tabs( 'tabs_button_style' );

		$repeater->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'ocanus-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'ocanus-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:hover, {{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:hover svg, {{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tabs();

		$this->add_control(
			'items',
			[
				'label'  => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);

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
			'name'     => 'title_all',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'content_all',
			'label'    => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.content'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_button_controls() {
		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => false,
			'selector'        => ''
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();

		//== [ Style Tab ]
//		$this->add_style_content_controls();
		$this->add_style_button_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-banner-grid',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';
		if ( ! empty( $items ) ) {
			$html[] = '<div class="content-wrapper">';
			foreach ( $items as $item ) {
				$id               = oew_get_value_in_array( $item, '_id' );
				$content_position = oew_get_value_in_array( $item, 'content_position' );
				$title_tag        = oew_get_value_in_array( $item, 'title_tag' );
				$title            = oew_get_value_in_array( $item, 'title' );
				$content          = oew_get_value_in_array( $item, 'content' );

				$classes = array(
					'column',
					'content-position-' . $content_position,
					'elementor-repeater-item-' . $id,
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="item-inner">';
				$html[] = '<div class="item-image">' . Group_Control_Image_Size::get_attachment_image_html( $item ) . '</div>';
				$html[] = '<div class="item-content">';
				$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . esc_attr( $title ) . '</' . $title_tag . '>' : '';
				$html[] = $content ? '<div class="content">' . wpautop( $content ) . '</div>' : '';
				$html[] = oew_render_button( $item );
				$html[] = '</div>';
				$html[] = '</div></div>';
			}
			$html[] = '</div>';
		}
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Banner_Grid() );