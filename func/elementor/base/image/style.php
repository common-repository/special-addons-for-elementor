<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 2/11/2020
 * Time: 4:45 PM
 */

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if (!function_exists('oew_elementor_option_image_style')) {
	function oew_elementor_option_image_style($oew, $enable_section = true) {
        if ($enable_section) {
            $oew->start_controls_section(
                'section_image_style',
                [
                    'label' => esc_html__( 'Image', 'ocanus-elementor-widgets' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
        }

        $oew->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__('Width', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lrewards-shortcode img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $oew->add_responsive_control(
			'image_space',
			[
				'label' => esc_html__('Max Width', 'ocanus-elementor-widgets') . ' (%)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lrewards-shortcode img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $oew->add_control(
			'separator_panel_style',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

        $oew->start_controls_tabs('image_effects');

        $oew->start_controls_tab('normal',
			[
				'label' => esc_html__('Normal', 'ocanus-elementor-widgets'),
			]
		);

        $oew->add_control(
			'image_opacity',
			[
				'label' => esc_html__('Opacity', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lrewards-shortcode img' => 'opacity: {{SIZE}};',
				],
			]
		);

        $oew->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .lrewards-shortcode img',
			]
		);

        $oew->end_controls_tab();

        $oew->start_controls_tab('hover',
			[
				'label' => esc_html__('Hover', 'ocanus-elementor-widgets'),
			]
		);

        $oew->add_control(
			'opacity_hover',
			[
				'label' => esc_html__('Opacity', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

        $oew->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-image:hover img',
			]
		);

        $oew->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lrewards-shortcode img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

        $oew->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

        $oew->end_controls_tab();

        $oew->end_controls_tabs();

        $oew->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .lrewards-shortcode img',
				'separator' => 'before',
			]
		);

        $oew->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'ocanus-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .lrewards-shortcode img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $oew->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .lrewards-shortcode img',
			]
		);

        if ($enable_section) {
            $oew->end_controls_section();
        }
	}
}