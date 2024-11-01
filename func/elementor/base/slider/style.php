<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 26/08/2021
 * Time: 11:17 CH
 */

if ( ! function_exists( 'oew_elementor_option_slider_style' ) ) {
	function oew_elementor_option_slider_style( $oew, $params, $enable_section = true ) {
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_style_' . $params['name'],
				[
					'label' => $params['label'],
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
		}

		$oew->add_control(
			'arrow_heading',
			[
				'label' => esc_html__( 'Navigation', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		if ( $params['position_arrow'] ) {
			$oew->add_control(
				'arrow_position',
				[
					'label'        => esc_html__( 'Position', 'ocanus-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'default'      => 'inside',
					'options'      => [
						'inside'  => esc_html__( 'Inside', 'ocanus-elementor-widgets' ),
						'outside' => esc_html__( 'Outside', 'ocanus-elementor-widgets' ),
					],
					'prefix_class' => 'oew-arrow-type-',
					'render_type'  => 'template',
				]
			);
		}

		$oew->add_control(
			'color_arrow',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-arrow-controls .arrow-nav svg' => 'fill: {{VALUE}}',
				]
			]
		);

		if ( $params['background_arrow'] ) {
			$oew->add_control(
				'background_arrow',
				[
					'label'     => esc_html__( 'Background', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .oew-slick-style .slick-arrow'        => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .oew-slick-style .slick-arrow:before' => 'box-shadow: 0 0 0 1px {{VALUE}}',
					]
				]
			);
		}

		$oew->add_control(
			'color_arrow_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-slick-style .slick-arrow:hover'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-arrow-controls .arrow-nav:hover svg' => 'fill: {{VALUE}}',
				]
			]
		);

		if ( $params['background_arrow'] ) {
			$oew->add_control(
				'background_arrow_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .oew-slick-style .slick-arrow:hover'        => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .oew-slick-style .slick-arrow:hover:before' => 'box-shadow: 0 0 0 1px {{VALUE}}',
					]
				]
			);
		}

		$oew->add_control(
			'dots_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$oew->add_control(
			'dots_heading',
			[
				'label' => esc_html__( 'Pagination', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$oew->add_control(
			'dots_position',
			[
				'label'        => esc_html__( 'Position', 'ocanus-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'inside',
				'options'      => [
					'inside'  => esc_html__( 'Inside', 'ocanus-elementor-widgets' ),
					'outside' => esc_html__( 'Outside', 'ocanus-elementor-widgets' ),
				],
				'prefix_class' => 'oew-dots-type-',
				'render_type'  => 'template',
			]
		);

		$oew->add_control(
			'color_dots',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button:after, {{WRAPPER}} .progress' => 'background-color: {{VALUE}}'
				]
			]
		);

		$oew->add_control(
			'active_dot',
			[
				'label'     => esc_html__( 'Color Active', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-dots li.slick-active button:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .progress'                                => 'background-image: linear-gradient(to right, {{VALUE}}, {{VALUE}})',
				]
			]
		);

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}