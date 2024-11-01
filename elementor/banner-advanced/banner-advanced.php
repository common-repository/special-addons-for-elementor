<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 9/5/2021
 * Time: 1:42 AM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Banner_Advanced extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-banner-advanced';
	}

	public function get_title() {
		return esc_html__( 'Banner Advanced', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-masonry oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

//	public function get_script_depends() {
//		return [ 'oew-banner-advanced' ];
//	}

	public function get_style_depends() {
		return [ 'oew-banner-advanced' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => __( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
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

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$repeater->add_responsive_control(
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
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .item-image' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'banner_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .item-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'content_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_responsive_control(
			'content_position',
			[
				'label'   => esc_html__( 'Content Position', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
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
				'default' => 'left',
			]
		);

		$repeater->add_control(
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
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'sale_price',
			[
				'label' => esc_html__( 'Sale Price', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		oew_elementor_option_button_content( $repeater, [
			'indent_position' => 'repeater',
			'divider'         => true,
			'align'           => false,
			'icon'            => true,
		], false );

		$this->add_control(
			'items',
			[
				'label'  => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'ocanus-elementor-widgets' ),
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
			'name'     => 'content',
			'label'    => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.content'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'price',
			'label'    => esc_html__( 'Price', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-price-amount'
		], false );

		$this->add_control(
			'color_price_line_through',
			[
				'label'     => esc_html__( 'Price Line Through Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-price-amount:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'sale_price',
			'label'    => esc_html__( 'Sale Price', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-price-amount.sale-price'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_button_controls() {
		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => false,
			'selector'        => ''
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
		$this->add_style_button_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$c          = 1;
		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-banner-advanced',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				if ( $c === 1 ) {
					$html[] = '<div class="oew-row">'; //== [ start horizontal row containing 5 items ]
					$html[] = '<div class="oew-col-12 oew-col-lg-3">';
					$html[] = $this->render_item_template( $item, '' );
					$html[] = '</div>';
				} else {
					$html[] = $c === 2 ? '<div class="oew-col-12 oew-col-lg-9"><div class="oew-row">' : '';
					$html[] = $this->render_item_template( $item, 'oew-col-12' );
					$html[] = $c === 5 ? '</div></div></div>' : ''; //== [ End horizontal row containing 5 items ]
				}

				$c = $c === 6 ? 1 : $c;
				$c ++;
			}
		}

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function render_item_template( $item, $column ) {
		$id               = oew_get_value_in_array( $item, '_id' );
		$content_position = oew_get_value_in_array( $item, 'content_position' );
		$title_tag        = oew_get_value_in_array( $item, 'title_tag' );
		$title            = oew_get_value_in_array( $item, 'title' );
		$content          = oew_get_value_in_array( $item, 'content' );
		$price            = oew_get_value_in_array( $item, 'price' );
		$sale_price       = oew_get_value_in_array( $item, 'sale_price' );

		$classes = array(
			'column',
			$column,
			'content-position-' . $content_position,
			'elementor-repeater-item-' . $id,
		);

		$item_html = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="item-inner">';
		$item_html .= '<div class="item-image">' . Group_Control_Image_Size::get_attachment_image_html( $item ) . '</div>';
		$item_html .= '<div class="item-content">';
		$item_html .= $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
		$item_html .= $content ? '<div class="content">' . wpautop( $content ) . '</div>' : '';
		$item_html .= oew_render_button( $item );
		if ( $price || $sale_price ) {
			$item_html .= '<div class="oew-price-wrapper">';
			$item_html .= $price ? '<div class="oew-price-amount">' . $price . '</div>' : '';
			$item_html .= $sale_price ? '<div class="oew-price-amount sale-price">' . $sale_price . '</div>' : '';
			$item_html .= '</div>';
		}
		$item_html .= '</div>';

		$item_html .= '</div></div>';

		return $item_html;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Banner_Advanced() );