<?php

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

class Oew_Widget_Info_Special extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-info-special';
	}

	public function get_title() {
		return esc_html__( 'Info Special', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-info-box oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-info-special' ];
	}

	public function get_style_depends() {
		return [ 'oew-info-special' ];
	}

	protected function add_layout_heading_controls() {
		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => true,
			'description' => true,
		] );
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_image_content( $this, false, false );

		$this->add_control(
			'item_1_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'item_1_content',
			[
				'label' => esc_html__( 'Item 1', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'image_1',
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

		$this->add_control(
			'title_1',
			[
				'label'   => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'title item', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_1',
			[
				'label'       => esc_html__( 'Link', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'description_1',
			[
				'label'   => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'item_2_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'item_2_content',
			[
				'label' => esc_html__( 'Item 2', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'image_2',
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

		$this->add_control(
			'title_2',
			[
				'label'   => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'title item', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_2',
			[
				'label'       => esc_html__( 'Link', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'description_2',
			[
				'label'   => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'item_3_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'item_3_content',
			[
				'label' => esc_html__( 'Item 3', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'image_3',
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

		$this->add_control(
			'title_3',
			[
				'label'   => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'title item', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_3',
			[
				'label'       => esc_html__( 'Link', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'description_3',
			[
				'label'   => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'ocanus-elementor-widgets' ),
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_heading_controls() {
		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => true,
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title_item_info_special',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.items .oew-item-info .oew-item-title a',
		], false, true );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'description_item',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-item-desc',
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_heading_controls();
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_content_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-info-special',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner" >';

		$html[] = oew_render_heading_title( $settings );

		$html[] = '<div class="oew-row">';

		$html[] = '<div class="column oew-col-12 oew-col-md-4 p-0">';
		$html[] = '<div class="image-left">';
		$html[] = Group_Control_Image_Size::get_attachment_image_html( $settings );
		$html[] = '</div>';
		$html[] = '</div>';

		$html[] = '<div class="column oew-col-12 oew-col-md-8">';

		for ( $i = 1; $i < 4; $i ++ ) {
			$image       = oew_get_value_in_array( $settings, 'image_' . $i . '' );
			$title       = oew_get_value_in_array( $settings, 'title_' . $i . '' );
			$link        = oew_get_value_in_array( $settings, 'link_' . $i . '' );
			$description = oew_get_value_in_array( $settings, 'description_' . $i . '' );

			$html[] = '<div class="items item_' . $i . '">';
			$html[] = '<div class="oew-item-image"><img src="' . oew_get_value_in_array( $image, 'url' ) . '">';
			$html[] = '</div>';
			$html[] = '<div class="oew-item-info">';
			$html[] = '<div class="oew-item-title">';
			$html[] = '<a href="' . $link['url'] . '">' . $title . '</a>';
			$html[] = '</div>';
			$html[] = '<div class="oew-item-desc">' . $description . '</div>';
			$html[] = '</div>';
			$html[] = '</div>';

		}
		$html[] = '</div>';

		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Info_Special() );