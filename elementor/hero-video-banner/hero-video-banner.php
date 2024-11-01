<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 24/08/2021
 * Time: 8:09 CH
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Hero_Video_Banner extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_video_bannner';
	}

	public function get_title() {
		return esc_html__( 'Hero Video Banner', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-banner oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-hero-video-banner' ];
	}

	public function get_style_depends() {
		return [ 'oew-hero-video-banner' ];
	}

	protected function add_layout_content_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'
				],
			]
		);

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

		$repeater->add_control(
			'heading_tag',
			[
				'label'   => esc_html__( 'Heading Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'span',
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
			'heading',
			[
				'label' => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
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
			'button_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'Click here', 'ocanus-elementor-widgets' ),
				'placeholder' => esc_html__( 'Click here', 'ocanus-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Button Link', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'ocanus-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$repeater->add_responsive_control(
			'button_align',
			[
				'label'        => esc_html__( 'Alignment', 'ocanus-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => esc_html__( 'Left', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'ocanus-elementor-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => 'left',
			]
		);

		$repeater->add_control(
			'button_selected_icon',
			[
				'label'            => esc_html__( 'Button Icon', 'ocanus-elementor-widgets' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
			]
		);

		$repeater->add_control(
			'button_icon_align',
			[
				'label'     => esc_html__( 'Icon Position', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => esc_html__( 'Before', 'elementor' ),
					'right' => esc_html__( 'After', 'elementor' ),
				],
				'condition' => [
					'button_selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => esc_html__( 'Items', 'ocanus-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{heading}}}',
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_video_controls() {
		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__( 'Video', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'video_type',
			[
				'label'   => __( 'Video Type', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'mp4',
				'options' => [
					'mp4'     => 'Mp4',
					'youtube' => 'Youtube',
				],
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label'   => esc_html__( 'Logo Image', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'video_preview',
			[
				'label'     => esc_html__( 'Video Preview Image', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'video_type' => 'mp4',
				],
			]
		);

		$this->add_control(
			'video_url',
			[
				'label'     => esc_html__( 'Video Url', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'video_type' => 'mp4',
				],
			]
		);

		$this->add_control(
			'youtube_id',
			[
				'label'     => esc_html__( 'Youtube ID', 'ocanus-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'video_type' => 'youtube',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_additional_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Additional Options', 'ocanus-elementor-widgets' ),
			'slides_default' => 1,
			'column'         => false,
			'arrows_skin'    => true,
			'progress'       => true
		] );
	}

	protected function add_style_content_controls() {
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		oew_elementor_option_typo_style( $this, [
			'name'     => 'heading',
			'label'    => esc_html__( 'Heading', 'ocanus-elementor-widgets' ),
			'divider'  => false,
			'selector' => '.oew-hero-slides-item-heading'
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'text',
			'label'    => esc_html__( 'Text', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-hero-slides-item-text'
		], false );

		$this->end_controls_section();

		oew_elementor_option_button_style( $this, [
			'indent_position' => '',
			'divider'         => false,
			'selector'        => ''
		] );

		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Additional Options', 'ocanus-elementor-widgets' ),
			'position_arrow'   => true,
			'background_arrow' => true,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_video_controls();
		$this->add_layout_additional_controls();

		//== [ Style Tab ]
		$this->add_style_content_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$logo_image = oew_get_value_in_array( $settings, 'logo_image' );
		$pagination = oew_get_value_in_array( $settings, 'pagination' );
		$i          = 1;

		$video = array(
			'type'       => oew_get_value_in_array( $settings, 'video_type' ),
			'preview'    => oew_get_value_in_array( $settings, 'video_preview' ),
			'video_url'  => oew_get_value_in_array( $settings, 'video_url' ),
			'youtube_id' => oew_get_value_in_array( $settings, 'youtube_id' ),
		);

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-hero-video-banner',
		);

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this ) . "}'";

		$html = array();

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		//== [ Video ]
		$html[] = $this->render_video( $video );

		//== [ Column Main ]
		$html[] = '<div class="oew-hero-columns">';

		$html[] = '<div class="oew-hero-left">';
		$html[] = $this->render_logo( $logo_image );
		$html[] = '<div class="oew-ui-slider oew-slick-style">';
		if ( $items ) {
			$html[] = '<div class="oew-hero-slides slider-items-wrapper" ' . $slide_attributes . '>';
			foreach ( $items as $item ) {
				$html[] = $this->render_content_template( $item, $i );
				$i ++;
			}
			$html[] = '</div>';
		}
		$html[] = oew_render_slider_ui_control( [
			'layout'     => 'pagination',
			'pagination' => oew_get_value_in_array( $settings, 'pagination' )
		] );
//		if ( $pagination === 'bullets' ) {
//			$html[] = '<div class="slider-dots d-lg-none"></div>';
//		} elseif ( $pagination === 'progressbar' ) {
//			$html[] = '<div class="progress d-lg-none" role="progressbar"></div>';
//		}
		$html[] = '</div>';
		$html[] = '</div>'; //== [ End Left ]

		$html[] = '<div class="oew-hero-right">' . $this->render_logo( $logo_image ) . '</div>';

		$html[] = '</div>'; //== [ End Column Main

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	protected function render_content_template( $item_attr, $index ) {
		if ( empty( $item_attr ) ) {
			return;
		}
		$id          = oew_get_value_in_array( $item_attr, '_id' );
		$heading_tag = oew_get_value_in_array( $item_attr, 'heading_tag' );
		$heading     = oew_get_value_in_array( $item_attr, 'heading' );
		$content     = oew_get_value_in_array( $item_attr, 'content' );

		$classes = array(
			'oew-hero-slides-item',
			'slide-item',
			'elementor-repeater-item-' . $id,
			$index === 2 ? ' --reverse' : '',
			$index > 2 ? 'd-lg-none' : '',
		);

		$content_html = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';
		$content_html .= '<div class="oew-hero-slides-item-image">';
		$content_html .= Group_Control_Image_Size::get_attachment_image_html( $item_attr );
		$content_html .= '</div>';
		$content_html .= '<div class="oew-hero-slides-item-content">';
		$content_html .= '<' . $heading_tag . ' class="oew-hero-slides-item-heading">' . esc_attr( $heading ) . '</' . $heading_tag . '>';
		$content_html .= '<span class="oew-hero-slides-item-text">' . esc_attr( $content ) . '</span>';
		$content_html .= oew_render_button( $item_attr );
		$content_html .= '</div>';
		$content_html .= '</div>';

		return $content_html;
	}

	protected function render_video( $video = array() ) {
		$preview = empty( $video['preview'] ) ? ' poster="' . esc_attr( $video['preview'] ) . '"' : '';

		$video_html = '<div class="section-background">';
		if ( $video['type'] === 'mp4' ) {
			$video_html .= '<video autoplay="" muted="" loop=""' . $preview . ' class="section-background-video">';
			$video_html .= '<source type="video/mp4" src="' . esc_url( $video['video_url'] ) . '">';
			$video_html .= '</video>';
		} else {
			$video_html .= '<iframe class="section-background-video" src="https://www.youtube.com/embed/' . $video['youtube_id'] . '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		$video_html .= '<div class="section-background-video --embed"></div>';
		$video_html .= '</div>';

		return $video_html;
	}

	protected function render_logo( $logo_image ) {
		if ( empty( $logo_image['url'] ) ) {
			return;
		}
		$logo_html = '<div class="oew-hero-overlay-logo">';
		$logo_html .= '<img src="' . esc_url( $logo_image['url'] ) . '" alt="' . esc_attr( $logo_image['alt'] ) . '" class="oew-hero-overlay-logo-img">';
		$logo_html .= '</div>';

		return $logo_html;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Hero_Video_Banner() );