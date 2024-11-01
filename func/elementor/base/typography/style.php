<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 2/17/2020
 * Time: 11:22 AM
 */

use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

if ( ! function_exists( 'oew_elementor_option_typo_style' ) ) {
	function oew_elementor_option_typo_style( $oew, $params, $enable_section = true, $enale_hover = false ) {
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_style_' . $params['name'],
				[
					'label' => $params['label'],
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
		}

		if ( !$enable_section && $params['divider'] ) {
			$oew->add_control(
				$params['name'] . '_divider',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		if ( ! $enable_section && $params['label'] !== '' ) {
			$oew->add_control(
				$params['name'] . '_heading_style',
				[
					'label' => $params['label'],
					'type'  => \Elementor\Controls_Manager::HEADING,
				]
			);
		}

		$oew->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_' . $params['name'],
				'selector' => '{{WRAPPER}} ' . $params['selector'],
			]
		);

		$oew->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'text_shadow_' . $params['name'],
				'selector' => '{{WRAPPER}} ' . $params['selector'],
			]
		);

		$oew->add_control(
			'color_' . $params['name'],
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $params['selector'] => 'color: {{VALUE}};'
				]
			]
		);

		if ( $enale_hover ) {
			$oew->add_control(
				'color_hover_' . $params['name'],
				[
					'label'     => esc_html__( 'Hover Color', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ' . $params['selector'] . ':hover' => 'color: {{VALUE}};'
					]
				]
			);
		}

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}