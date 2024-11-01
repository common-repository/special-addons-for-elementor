<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 24/08/2021
 * Time: 8:12 CH
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Big_Step extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_big_step';
	}

	public function get_title() {
		return esc_html__( 'Big Step', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-parallax oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [];
	}

	public function get_style_depends() {
		return [ 'oew-big-step' ];
	}

	protected function add_layout_content_controls() {
		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => true,
		] );

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		oew_elementor_option_icon_content( $repeater, false );

		$repeater->add_control(
			'content_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'sub_title_tag',
			[
				'label'   => esc_html__( 'Sub Title Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h5',
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

		$repeater->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'ocanus-elementor-widgets' ),
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

		$repeater->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{sub_title}}}',
			]
		);

		$this->end_controls_section();
	}

	protected function add_content_style_controls() {
		oew_elementor_option_heading_style( $this, [
			'divider' => false,
			'description' => true,
		] );

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'sub_title',
			'label'    => esc_html__( 'Sub Title', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.sub-title'
		], false );


		oew_elementor_option_typo_style( $this, [
			'name'     => 'text',
			'label'    => esc_html__( 'Text', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.content'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'icon',
			'label'    => esc_html__( 'Icon', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.icon'
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_content_style_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$items = $settings['items'];

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-big-step',
		);

		$html = array();

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title($settings);

		if ( $items ) {
			$html[] = '<div class="columns">';
			foreach ( $items as $item ) {
				$id            = oew_get_value_in_array( $item, '_id' );
				$sub_title_tag = oew_get_value_in_array( $item, 'sub_title_tag' );
				$title_tag     = oew_get_value_in_array( $item, 'title_tag' );
				$sub_title     = oew_get_value_in_array( $item, 'sub_title' );
				$title         = oew_get_value_in_array( $item, 'title' );
				$content       = oew_get_value_in_array( $item, 'content' );

				$classes = array(
					'column',
					'elementor-repeater-item-' . $id,
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';
				$html[] = '<div class="column-inner">';
				$html[] = '<div class="column-thumb">' . Group_Control_Image_Size::get_attachment_image_html( $item ) . '</div>';

				$html[] = '<div class="column-content">';
				$html[] = oew_render_icon( $item );
				$html[] = $sub_title ? '<' . $sub_title_tag . ' class="sub-title">' . $sub_title . '</' . $sub_title_tag . '>' : '';
				$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
				$html[] = $content ? '<div class="content">' . wpautop( $content ) . '</div>' : '';
				$html[] = '</div>';

				$html[] = '</div>';
				$html[] = '</div>';
			}
			$html[] = '</div>';
		}
		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Big_Step() );