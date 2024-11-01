<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

class Oew_Widget_Gallery_Content extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-gallery-content';
	}

	public function get_title() {
		return esc_html__( 'Gallery Content', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-gallery-content' ];
	}

	public function get_style_depends() {
		return [ 'oew-gallery-content' ];
	}

	protected function add_layout_heading_controls() {
		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => false,
		] );
	}

	protected function add_layout_items_controls() {
		$this->start_controls_section(
			'section_items_content',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
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

		$repeater = new \Elementor\Repeater();

		oew_elementor_option_image_content( $repeater, false, false );

		$repeater->add_control(
			'title_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'item_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .item-row' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'UNIQUE DESIGN IN MODERN YACHT STYLE', 'ocanus-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'ocanus-elementor-widgets' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Item', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_heading_controls() {
		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => false,
		] );
	}

	protected function add_style_items_controls() {
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.item .item-detail .oew-title',
		], false );

		$this->add_control(
			'separation-line-color',
			[
				'label'     => esc_html__( 'Separation Line Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item .item-detail .separation-line' => 'border-color: {{VALUE}}',
				],
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'item_description',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => ' .item .item-detail .oew-description',
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_heading_controls();
		$this->add_layout_items_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_items_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$title_tag   = oew_get_value_in_array( $settings, 'title_tag' );

		$html       = array();
		$i          = 1;
		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-gallery-content',
		);

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );

		$html[] = '<div class="gallery-container">';

		if ( $items ) {
			$html[] = '<div class="content-wrapper oew-row">';
			foreach ( $items as $item ) {
				$id          = oew_get_value_in_array( $item, '_id' );
				$title       = oew_get_value_in_array( $item, 'title' );
				$description = oew_get_value_in_array( $item, 'description' );

				$classes = array(
					'column',
					'oew-col-12',
					'oew-col-xl-6',
					'oew-col-sm-12',
					'elementor-repeater-item-' . $id,
					$i == 3 || $i == 4 ? 'reverse' : '',
					$i == 2 || $i == 4 ? 'right' : '',
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="item-row oew-row">';
				$html[] = '<div class="item">';
				$html[] = '<div class="item-thumb">';
				$html[] = Group_Control_Image_Size::get_attachment_image_html( $item );
				$html[] = '</div>';
				$html[] = '<div class="item-detail">';
				$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
				$html[] = '<hr class="separation-line">';
				$html[] = $description ? '<p class="oew-description">' . $description . '</p>' : '';
				$html[] = '</div>';
				$html[] = '</div>';
				$html[] = '</div></div>';

				$i = $i === 5 ? 1 : $i;
				$i ++;
			}
			$html[] = '</div>';
		}
		$html[] = '</div>';

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Gallery_Content() );
