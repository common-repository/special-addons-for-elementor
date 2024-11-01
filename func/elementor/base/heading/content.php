<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 29/08/2021
 * Time: 12:25 SA
 */

if ( ! function_exists( 'oew_elementor_option_heading_content' ) ) {
	function oew_elementor_option_heading_content( $oew, $params, $enable_section = true ) {
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_content_' . $params['name'],
				[
					'label' => $params['label'],
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		if ( ! $enable_section && $params['divider'] ) {
			$oew->add_control(
				$params['name'] . '_divider',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		if ( ! $enable_section && $params['label'] !== '' ) {
			$oew->add_control(
				$params['name'] . '_heading_content',
				[
					'label' => $params['label'],
					'type'  => \Elementor\Controls_Manager::HEADING,
				]
			);
		}

		$oew->add_control(
			'heading_tag',
			[
				'label'   => esc_html__( 'Heading Tag', 'ocanus-helper' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
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

		if ( $params['description'] ) {
			$oew->add_control(
				'description_tag',
				[
					'label'   => esc_html__( 'Description Tag', 'ocanus-helper' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'p',
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
		}

		$oew->add_control(
			'section_title_align',
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
				'prefix_class' => 'oew-section-title-align-',
				'default'      => 'left',
			]
		);

		$oew->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'ocanus-helper' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		if ( $params['description'] ) {
			$oew->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'ocanus-helper' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				]
			);
		}

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}