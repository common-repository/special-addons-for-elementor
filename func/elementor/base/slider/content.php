<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 26/08/2021
 * Time: 11:14 CH
 */

if ( ! function_exists( 'oew_elementor_option_slider_content' ) ) {
	function oew_elementor_option_slider_content( $oew, $params, $enable_section = true ) {
		$column_max = isset( $params['column_max'] ) ? $params['column_max'] : 6;
		$progress   = isset( $params['progress'] ) ? $params['progress'] : true;
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_slider_content',
				[
					'label' => $params['label'],
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		if ( $params['column'] ) {
			$slides_to_show = range( 1, $column_max );
			$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
			$oew->add_responsive_control(
				'slides_to_show',
				[
					'type'               => \Elementor\Controls_Manager::SELECT,
					'label'              => esc_html__( 'Slides Per View', 'ocanus-elementor-widgets' ),
					'default'            => $params['slides_default'],
					'options'            => [ '' => esc_html__( 'Default', 'ocanus-elementor-widgets' ) ] + $slides_to_show,
					'frontend_available' => true,
				]
			);

			$oew->add_responsive_control(
				'slides_to_scroll',
				[
					'type'               => \Elementor\Controls_Manager::SELECT,
					'label'              => esc_html__( 'Slides to Scroll', 'ocanus-elementor-widgets' ),
					'default'            => 1,
					'options'            => [ '' => esc_html__( 'Default', 'ocanus-elementor-widgets' ) ] + $slides_to_show,
					'frontend_available' => true,
				]
			);
		}

		if ( $params['arrows_skin'] ) {
			$oew->add_control(
				'show_arrows',
				[
					'type'         => \Elementor\Controls_Manager::SELECT,
					'label'        => esc_html__( 'Arrows', 'ocanus-elementor-widgets' ),
					'default'      => '',
					'options'      => [
						''  => esc_html__( 'None', 'ocanus-elementor-widgets' ),
						'1' => esc_html__( 'Skin 1', 'ocanus-elementor-widgets' ),
						'2' => esc_html__( 'Skin 2', 'ocanus-elementor-widgets' ),
					],
					'prefix_class' => 'oew-navigation oew-navigation-skin-',
					'render_type'  => 'template',
				]
			);
		} else {
			$oew->add_control(
				'show_arrows',
				[
					'type'      => \Elementor\Controls_Manager::SWITCHER,
					'label'     => esc_html__( 'Arrows', 'ocanus-elementor-widgets' ),
					'default'   => 'yes',
					'label_off' => esc_html__( 'Hide', 'ocanus-elementor-widgets' ),
					'label_on'  => esc_html__( 'Show', 'ocanus-elementor-widgets' ),
				]
			);
		}

		if ( $progress ) {
			$oew->add_control(
				'pagination',
				[
					'label'        => esc_html__( 'Pagination', 'ocanus-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'default'      => 'bullets',
					'options'      => [
						''            => esc_html__( 'None', 'ocanus-elementor-widgets' ),
						'bullets'     => esc_html__( 'Dots', 'ocanus-elementor-widgets' ),
						'progressbar' => esc_html__( 'Progress', 'ocanus-elementor-widgets' ),
					],
					'prefix_class' => 'oew-pagination-type-',
					'render_type'  => 'template',
				]
			);
		} else {
			$oew->add_control(
				'pagination',
				[
					'label'        => esc_html__( 'Pagination', 'ocanus-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'default'      => 'bullets',
					'options'      => [
						''        => esc_html__( 'None', 'ocanus-elementor-widgets' ),
						'bullets' => esc_html__( 'Dots', 'ocanus-elementor-widgets' ),
					],
					'prefix_class' => 'oew-pagination-type-',
					'render_type'  => 'template',
				]
			);
		}

		$oew->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Transition Duration', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$oew->add_control(
			'autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$oew->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$oew->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Infinite Loop', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}