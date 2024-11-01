<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 29/08/2021
 * Time: 12:29 SA
 */

use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! function_exists( 'oew_elementor_option_heading_style' ) ) {
	function oew_elementor_option_heading_style( $oew, $params, $enable_section = true ) {
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_style_heading',
				[
					'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
		}

		if ( ! $enable_section && $params['divider'] ) {
			$oew->add_control(
				'heading_divider_style',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		$oew->add_control(
			'heading_heading_style',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$oew->add_responsive_control(
			'heading_margin',
			[
				'label'      => esc_html__( 'Margin', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .oew-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$oew->add_responsive_control(
			'heading_padding',
			[
				'label'      => esc_html__( 'Padding', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .oew-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$oew->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_heading_title',
				'selector' => '{{WRAPPER}} .oew-section-title .oew-heading-title',
			]
		);

		$oew->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow_heading',
				'selector' => '{{WRAPPER}} .oew-section-title .oew-heading-title',
			]
		);

		$oew->add_control(
			'color_heading',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title .oew-heading-title' => 'color: {{VALUE}};'
				]
			]
		);

		if ( $params['description'] ) {
			$oew->add_control(
				'description_divider',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);

			$oew->add_control(
				'description_heading_style',
				[
					'label' => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
					'type'  => \Elementor\Controls_Manager::HEADING,
				]
			);

			$oew->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'typography_description',
					'selector' => '{{WRAPPER}} .oew-section-title .oew-description',
				]
			);

			$oew->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name'     => 'text_description',
					'selector' => '{{WRAPPER}} .oew-section-title .oew-description',
				]
			);

			$oew->add_control(
				'color_description',
				[
					'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .oew-section-title .oew-description' => 'color: {{VALUE}};'
					]
				]
			);
		}

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}