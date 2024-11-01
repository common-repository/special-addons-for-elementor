<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 2/11/2020
 * Time: 4:45 PM
 */

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! function_exists( 'oew_elementor_option_button_style' ) ) {
	function oew_elementor_option_button_style( $oew, $params, $enable_section = true ) {
		$button_selectors = $params['selector'] !== '' ? $params['selector'] : '';
		$button_name      = 'button';
		if ( $params['indent_position'] === 'repeater' ) {
			$button_selectors = $params['selector'] !== '' ? $params['selector'] : '{{CURRENT_ITEM}}';
			$button_name      = 'button_repeater';
		}

		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_' . $button_name . '_style',
				[
					'label' => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
		}

		if ( ! $enable_section && $params['divider'] ) {
			$oew->add_control(
				$button_name . '_divider_style',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		if ( ! $enable_section ) {
			$oew->add_control(
				$button_name . '_heading_style',
				[
					'label' => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
					'type'  => \Elementor\Controls_Manager::HEADING,
				]
			);
		}

		$oew->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => $button_name . '_typography',
				'selector' => '{{WRAPPER}} .oew-default-btn a',
			]
		);

		$oew->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => $button_name . '_text_shadow',
				'selector' => '{{WRAPPER}} .oew-default-btn a',
			]
		);

		$oew->start_controls_tabs( 'tabs_' . $button_name . '_style' );

		$oew->start_controls_tab(
			'tab_' . $button_name . '_normal',
			[
				'label' => esc_html__( 'Normal', 'ocanus-elementor-widgets' ),
			]
		);

		$oew->add_control(
			$button_name . '_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$oew->add_control(
			$button_name . '_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$oew->end_controls_tab();

		$oew->start_controls_tab(
			'tab_' . $button_name . '_hover',
			[
				'label' => esc_html__( 'Hover', 'ocanus-elementor-widgets' ),
			]
		);

		$oew->add_control(
			$button_name . '_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:hover, {{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:hover svg, {{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$oew->add_control(
			$button_name . '_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$oew->add_control(
			$button_name . '_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$oew->end_controls_tabs();

		$oew->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => $button_name . '_border',
				'selector'  => '{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a',
				'separator' => 'before',
			]
		);

		$oew->add_control(
			$button_name . '_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$oew->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => $button_name . '_box_shadow',
				'selector' => '{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a',
			]
		);

		$oew->add_responsive_control(
			$button_name . '_text_padding',
			[
				'label'      => esc_html__( 'Padding', 'ocanus-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} ' . $button_selectors . ' .oew-default-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}