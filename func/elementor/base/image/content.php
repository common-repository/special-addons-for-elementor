<?php
/**
 * Created by vagrant.
 * User: vagrant
 * Date: 2/11/2020
 * Time: 4:44 PM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! function_exists( 'oew_elementor_option_image_content' ) ) {
	function oew_elementor_option_image_content( $oew, $enable_align = true, $enable_section = true ) {
		if ( $enable_section ) {
			$oew->start_controls_section(
				'section_image_content',
				[
					'label' => esc_html__( 'Image', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		$oew->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$oew->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		if ( $enable_align ) {
			$oew->add_responsive_control(
				'image_align',
				[
					'label'     => esc_html__( 'Alignment', 'ocanus-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => [
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
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);
		}

		$oew->add_control(
			'image_view',
			[
				'label'   => esc_html__( 'View', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		if ( $enable_section ) {
			$oew->end_controls_section();
		}
	}
}