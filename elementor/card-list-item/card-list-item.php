<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 29/08/2021
 * Time: 2:15 CH
 */

use Elementor\Group_Control_Image_Size;

class Oew_Widget_Card_List_Item extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_card_list_item';
	}

	public function get_title() {
		return esc_html__( 'Card List Item', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-table oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-script' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'oew-card-list-item' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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

		$repeater->add_control(
			'bg_position',
			[
				'label'   => esc_html__( 'Background Position', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '139px -85px'
			]
		);

		$repeater->add_control(
			'tick_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .card-info-list svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
			'item_list_1',
			[
				'label' => esc_html__( 'Item List 1', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'item_list_2',
			[
				'label' => esc_html__( 'Item List 2', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'item_list_3',
			[
				'label' => esc_html__( 'Item List 3', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'tags_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'tags_title',
			[
				'label' => esc_html__( 'Tags Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'tag_1',
			[
				'label' => esc_html__( 'Tag 1', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'tag_2',
			[
				'label' => esc_html__( 'Tag 2', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'tag_3',
			[
				'label' => esc_html__( 'Tag 3', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		oew_elementor_option_button_content( $repeater, [
			'indent_position' => 'repeater',
			'divider'         => true,
			'align'           => false,
			'icon'            => false,
		], false );

		$this->add_control(
			'item_list',
			[
				'label'       => __( 'Table List', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 4,
			'column'         => true,
			'arrows_skin'    => false,
			'progress'       => false
		] );
	}

	protected function add_content_style_controls() {
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-elementor-card-list-item .card-title, .oew-elementor-card-list-item .tags-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'item_list',
			'label'    => esc_html__( 'Item List', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-elementor-card-list-item .card-info-list li'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'tags',
			'label'    => esc_html__( 'Tags', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-elementor-card-list-item .tags ul li'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'button',
			'label'    => esc_html__( 'Button', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-elementor-card-list-item .oew-default-btn a'
		], false, true );

		$this->end_controls_section();
	}

	protected function add_slider_style_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => false,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_content_style_controls();
		$this->add_slider_style_controls();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$card_list = $settings['item_list'];

		$tick_icon        = '<svg width="12" height="10" viewBox="0 0 12 10" fill="black" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 9L4.14645 9.35355L4.53846 9.74557L4.88806 9.3153L4.5 9ZM0.646447 5.85355L4.14645 9.35355L4.85355 8.64645L1.35355 5.14645L0.646447 5.85355ZM4.88806 9.3153L11.3881 1.3153L10.6119 0.684704L4.11194 8.6847L4.88806 9.3153Z"/></svg>';
		$btn_icon         = '<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><g><path d="M4.43613 11.0715H13.9491L9.79302 15.2275C9.46087 15.5597 9.46087 16.1047 9.79302 16.4369C10.1252 16.769 10.6617 16.769 10.9938 16.4369L16.6062 10.8245C16.9384 10.4923 16.9384 9.95581 16.6062 9.62366L11.0024 4.00276C10.8432 3.84328 10.6272 3.75366 10.402 3.75366C10.1767 3.75366 9.96065 3.84328 9.80154 4.00276C9.46939 4.3349 9.46939 4.87144 9.80154 5.20359L13.9491 9.36817H4.43613C3.96772 9.36817 3.58447 9.75141 3.58447 10.2198C3.58447 10.6882 3.96772 11.0715 4.43613 11.0715Z"/></g></svg>';
		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this, true ) . "}'";

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-card-list-item',
		);

		$html = array();

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		if ( ! empty( $card_list ) ) {
			$icon_prev = '<i><svg width="37" height="37" viewBox="0 0 37 37" xmlns="http://www.w3.org/2000/svg"><g><path d="M28.9698 16.9583L11.7494 16.9583L19.2727 9.435C19.874 8.83375 19.874 7.84708 19.2727 7.24583C18.6715 6.64458 17.7002 6.64458 17.099 7.24583L6.93939 17.4054C6.33814 18.0067 6.33814 18.9779 6.93939 19.5792L17.0836 29.7542C17.3716 30.0428 17.7626 30.2051 18.1704 30.2051C18.5782 30.2051 18.9693 30.0428 19.2573 29.7542C19.8586 29.1529 19.8586 28.1817 19.2573 27.5804L11.7494 20.0417L28.9698 20.0417C29.8177 20.0417 30.5115 19.3479 30.5115 18.5C30.5115 17.6521 29.8177 16.9583 28.9698 16.9583Z"/></g></svg></i>';
			$icon_next = '<i><svg width="37" height="37" viewBox="0 0 37 37" xmlns="http://www.w3.org/2000/svg"><g><path d="M8.03013 20.0417H25.2505L17.7272 27.565C17.126 28.1663 17.126 29.1529 17.7272 29.7542C18.3285 30.3554 19.2997 30.3554 19.901 29.7542L30.0605 19.5946C30.6618 18.9933 30.6618 18.0221 30.0605 17.4208L19.9164 7.24584C19.6283 6.95716 19.2373 6.79492 18.8295 6.79492C18.4217 6.79492 18.0307 6.95716 17.7426 7.24584C17.1414 7.84709 17.1414 8.81834 17.7426 9.41959L25.2505 16.9583H8.03013C7.18221 16.9583 6.48846 17.6521 6.48846 18.5C6.48846 19.3479 7.18221 20.0417 8.03013 20.0417Z"/></g></svg></i>';

			$html[] = '<div class="oew-card-list oew-slick-style">';
			$html[] = oew_render_slider_ui_control( [
				'layout'         => 'navigation',
				'navi_icon_prev' => $icon_prev,
				'navi_icon_next' => $icon_next,
				'navigation'     => oew_get_value_in_array( $settings, 'show_arrows' )
			] );
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			foreach ( $card_list as $card ) {
				$id         = oew_get_value_in_array( $card, '_id' );
				$title      = oew_get_value_in_array( $card, 'title' );
				$item_1     = oew_get_value_in_array( $card, 'item_list_1' );
				$item_2     = oew_get_value_in_array( $card, 'item_list_2' );
				$item_3     = oew_get_value_in_array( $card, 'item_list_3' );
				$tags_title = oew_get_value_in_array( $card, 'tags_title' );
				$tag_1      = oew_get_value_in_array( $card, 'tag_1' );
				$tag_2      = oew_get_value_in_array( $card, 'tag_2' );
				$tag_3      = oew_get_value_in_array( $card, 'tag_3' );

				$classes = array(
					'card-item',
					'elementor-repeater-item-' . $id,
				);

				if ( oew_get_value_in_array( $card, 'image' ) ) {
					$image = oew_get_value_in_array( $card, 'image' );
					$url   = oew_get_value_in_array( $image, 'url' );

					$style = 'background-image: url(' . $url . ');background-position: ' . oew_get_value_in_array( $card, 'bg_position' );
				} else {
					$style = '';
				}

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="card-inner" style="' . $style . '">';

				$html[] = '<div class="card-title">' . esc_attr( $title ) . '</div>';

				$html[] = '<ul class="card-info-list">';
				$html[] = $item_1 ? '<li>' . $tick_icon . '<span>' . esc_attr( $item_1 ) . '</span></li>' : '';
				$html[] = $item_2 ? '<li>' . $tick_icon . '<span>' . esc_attr( $item_2 ) . '</span></li>' : '';
				$html[] = $item_3 ? '<li>' . $tick_icon . '<span>' . esc_attr( $item_3 ) . '</span></li>' : '';
				$html[] = '</ul>';

				//== [ Tags ]
				$html[] = '<div class="tags">';
				$html[] = '<div class="tags-title">' . esc_attr( $tags_title ) . '</div>';
				$html[] = '<ul class="tags-content">';
				$html[] = $tag_1 ? '<li><span>' . esc_attr( $tag_1 ) . '</span></li>' : '';
				$html[] = $tag_2 ? '<li><span>' . esc_attr( $tag_2 ) . '</span></li>' : '';
				$html[] = $tag_3 ? '<li><span>' . esc_attr( $tag_3 ) . '</span></li>' : '';
				$html[] = '</ul>';
				$html[] = '</div>';

				$html[] = oew_render_button( $card, [ 'position' => 'right', 'icon' => $btn_icon ] );

				$html[] = '</div></div>';
			}
			$html[] = '</div>';
			$html[] = '</div>';
		}

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Card_List_Item() );