<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 2/11/2020
 * Time: 4:44 PM
 */

if ( ! function_exists( 'oew_elementor_option_button_content' ) ) {
	function oew_elementor_option_button_content( $oew, $params, $enable_section = true ) {
		$button_selectors = '{{WRAPPER}} .oew-default-btn';
		if ( $params['indent_position'] === 'repeater' ) {
			$button_selectors = '{{WRAPPER}} {{CURRENT_ITEM}} .oew-default-btn';
		}

		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_button_content',
				[
					'label' => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		if ( ! $enable_section && $params['divider'] ) {
			$oew->add_control(
				'button_divider',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		if ( ! $enable_section ) {
			$oew->add_control(
				'button_heading_content',
				[
					'label' => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
					'type'  => \Elementor\Controls_Manager::HEADING,
				]
			);
		}

		$oew->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'Click here', 'ocanus-elementor-widgets' ),
				'placeholder' => esc_html__( 'Click here', 'ocanus-elementor-widgets' ),
			]
		);

		$oew->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Button Link', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ocanus-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		if ( $params['align'] ) {
			$oew->add_responsive_control(
				'button_align',
				[
					'label'        => esc_html__( 'Alignment', 'ocanus-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::CHOOSE,
					'options'      => [
						'left'    => [
							'title' => esc_html__( 'Left', 'ocanus-elementor-widgets' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center'  => [
							'title' => esc_html__( 'Center', 'ocanus-elementor-widgets' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right'   => [
							'title' => esc_html__( 'Right', 'ocanus-elementor-widgets' ),
							'icon'  => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'ocanus-elementor-widgets' ),
							'icon'  => 'eicon-text-align-justify',
						],
					],
					'prefix_class' => 'oew-button-align-',
					'default'      => 'left',
				]
			);
		}
		if ( $params['icon'] ) {
			$oew->add_control(
				'button_selected_icon',
				[
					'label'            => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
					'type'             => \Elementor\Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'skin'             => 'inline',
					'label_block'      => false,
				]
			);

			$oew->add_control(
				'button_icon_align',
				[
					'label'     => esc_html__( 'Icon Position', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => esc_html__( 'Before', 'ocanus-elementor-widgets' ),
						'right' => esc_html__( 'After', 'ocanus-elementor-widgets' ),
					],
					'condition' => [
						'button_selected_icon[value]!' => '',
					],
				]
			);


			$oew->add_control(
				'button_icon_indent',
				[
					'label'     => esc_html__( 'Icon Spacing', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						$button_selectors . ' .align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						$button_selectors . ' .align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}

		$oew->add_control(
			'button_css_class',
			[
				'label'       => esc_html__( 'Button Class', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => '',
				'label_block' => false,
				'separator'   => 'before',
			]
		);

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}