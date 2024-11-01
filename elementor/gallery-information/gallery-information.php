<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 29/08/2021
 * Time: 11:51 CH
 */

use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Gallery_Information extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_gallery_information';
	}

	public function get_title() {
		return esc_html__( 'Gallery Information', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-group oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-gallery-information' ];
	}

	public function get_style_depends() {
		return [ 'oew-gallery-information' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		oew_elementor_option_heading_content( $this, [
			'name'        => 'heading',
			'label'       => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'     => false,
			'description' => false,
		], false );

		oew_elementor_option_button_content( $this, [
			'indent_position' => '',
			'divider'         => true,
			'align'           => false,
			'icon'            => false,
		], false );

		$this->end_controls_section();
	}

	protected function add_layout_items_controls() {
		$this->start_controls_section(
			'section_items_content',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		oew_elementor_option_image_content( $repeater, false, false );

		$repeater->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Gallery', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::GALLERY,
			]
		);

		$repeater->add_control(
			'gallery_warning_text',
			[
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Display up to 3 images', 'ocanus-elementor-widgets' ),
				'content_classes' => 'oew-warning',
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'gallery',
				'default'   => 'medium',
				'separator' => 'none',
			]
		);

		$repeater->add_control(
			'title_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
			'description',
			[
				'label' => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		oew_elementor_option_button_content( $repeater, [
			'indent_position' => 'repeater',
			'divider'         => true,
			'align'           => false,
			'icon'            => false,
		], false );

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

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_heading_style',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_heading_title',
				'selector' => '{{WRAPPER}} .oew-section-title .oew-heading-title',
			]
		);

		$this->add_responsive_control(
			'text_shadow_heading',
			[
				'label'     => esc_html__( 'Text Shadow', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title .oew-heading-title' => 'text-shadow: 2px 0 0 {{VALUE}}, -2px 0 0 {{VALUE}}, 0 2px 0 {{VALUE}}, 0 -2px 0 {{VALUE}}, 1px 1px {{VALUE}}, -1px -1px 0 {{VALUE}}, 1px -1px 0 {{VALUE}}, -1px 1px 0 {{VALUE}}'
				]
			]
		);

		$this->add_responsive_control(
			'color_heading',
			[
				'label'     => esc_html__( 'Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .oew-section-title .oew-heading-title' => 'color: {{VALUE}}'
				]
			]
		);

		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => true,
			'selector'        => '.gallery-container >'
		], false );

		$this->end_controls_section();
	}

	protected function add_style_items_controls() {
		$this->start_controls_section(
			'section_style_items',
			[
				'label' => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '{{WRAPPER}} .item-detail .oew-title'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'description',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '{{WRAPPER}} .item-detail .oew-description'
		], false );

		oew_elementor_option_button_style( $this, [
			'indent_position' => 'repeater',
			'divider'         => true,
			'selector'        => '.content-wrapper'
		], false );

		$this->end_controls_section();
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_items_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
		$this->add_style_items_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$html = array();

		$icon_contact = '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M15 2H19C19.2652 2 19.5196 2.10536 19.7071 2.29289C19.8946 2.48043 20 2.73478 20 3V19C20 19.2652 19.8946 19.5196 19.7071 19.7071C19.5196 19.8946 19.2652 20 19 20H1C0.734784 20 0.48043 19.8946 0.292893 19.7071C0.105357 19.5196 0 19.2652 0 19V3C0 2.73478 0.105357 2.48043 0.292893 2.29289C0.48043 2.10536 0.734784 2 1 2H5V0H7V2H13V0H15V2ZM18 10H2V18H18V10ZM13 4H7V6H5V4H2V8H18V4H15V6H13V4ZM4 12H6V14H4V12ZM9 12H11V14H9V12ZM14 12H16V14H14V12Z"/></svg>';
		$class_atts   = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-gallery-information',
		);

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );

		$html[] = '<div class="gallery-container">';

		if ( $items ) {
			$html[] = '<div class="content-wrapper oew-row">';
			foreach ( $items as $item ) {
				$id          = oew_get_value_in_array( $item, '_id' );
				$gallery     = oew_get_value_in_array( $item, 'gallery' );
				$title_tag   = oew_get_value_in_array( $item, 'title_tag' );
				$title       = oew_get_value_in_array( $item, 'title' );
				$description = oew_get_value_in_array( $item, 'description' );
				$button_link = oew_get_value_in_array( $item, 'button_link' );

				$button = array(
					$button_link['url'] !== '' ? 'href="' . $button_link['url'] . '"' : '',
					$button_link['is_external'] === 'on' ? 'target="_blank"' : '',
					$button_link['nofollow'] === 'on' ? 'rel="nofollow"' : '',
					$button_link['custom_attributes'] !== '' ? $button_link['custom_attributes'] : '',
				);

				$classes = array(
					'column',
					'oew-col-12',
					'oew-col-sm-6',
					'oew-col-md-12',
					'elementor-repeater-item-' . $id,
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '"><div class="item-row oew-row">';
				$html[] = '<div class="item-content-information oew-col-12 oew-col-xl-6">';
				$html[] = '<div class="item">';
				$html[] = '<div class="item-thumb">';
				$html[] = $button_link['url'] ? '<a ' . implode( ' ', array_filter( $button ) ) . '>' : '';
				$html[] = Group_Control_Image_Size::get_attachment_image_html( $item );
				$html[] = $button_link['url'] ? '</a>' : '';
				$html[] = '</div>';
				$html[] = '<div class="item-detail">';
				$html[] = $title ? '<' . $title_tag . ' class="oew-title">' . $title . '</' . $title_tag . '>' : '';
				$html[] = $description ? '<p class="oew-description">' . $description . '</p>' : '';
				$html[] = oew_render_button( $item );
				$html[] = '</div>'; //== [ End Item Detail ]
				$html[] = '</div>';
				$html[] = '</div>'; //== [ End Content Information ]

				if ( $gallery && ! wp_is_mobile() ) {
					$gal = 1;

					$html[] = '<div class="item-content-gallery oew-col-12 oew-col-lg-6"><div class="gallery-row">';
					foreach ( $gallery as $gal_item ) {
						$html[] = '<div class="gal-column"><div class="gal-item">';
						$html[] = '<img src="' . oew_image_resize( oew_get_value_in_array( $gal_item, 'url' ), 250, 250, true ) . '" alt="gallery-' . oew_get_value_in_array( $gal_item, 'id' ) . '">';
						$html[] = '</div></div>';
						if ( $gal >= 3 ) {
							break;
						}

						$gal ++;
					}
					$html[] = '</div></div>'; //== [ End Content Gallery ]
				}

				$html[] = '</div></div>'; //== [ End Column ]
			}
			$html[] = '</div>';
		}

		//== [ Contact ]
		$html[] = oew_render_button( $settings, [ 'position' => 'left', 'icon' => $icon_contact ] );

		$html[] = '</div>'; //== [ End Gallery Container ]

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Gallery_Information() );