<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 27/08/2021
 * Time: 5:23 CH
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! function_exists( 'oew_elementor_option_icon_content' ) ) {
	function oew_elementor_option_icon_content( $oew, $enable_section = true ) {
		if ($enable_section) {
			$oew->start_controls_section(
				'section_icon_content',
				[
					'label' => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}

		$oew->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon Type', 'ocanus-helper' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => 'Default',
					'image'   => 'Image',
				],
			]
		);

		$oew->add_control(
			'icon_default',
			[
				'label'            => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'condition'        => [
					'icon_type' => 'default',
				],
			]
		);

		$oew->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Icon Image', 'ocanus-helper' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$oew->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'icon_image',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		if ($enable_section) {
			$oew->end_controls_section();
		}
	}
}