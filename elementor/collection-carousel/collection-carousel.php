<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 9/9/2021
 * Time: 1:52 PM
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Oew_Widget_Collection_Carousel extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew-collection-carousel';
	}

	public function get_title() {
		return esc_html__( 'Collection Carousel', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-slides oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-script', 'oew-collection-carousel' ];
	}

	public function get_style_depends() {
		return [ 'oew-collection-carousel' ];
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

		$this->add_control(
			'description_tag',
			[
				'label'   => esc_html__( 'Description Tag', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'div',
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

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater = new \Elementor\Repeater();

//        oew_elementor_option_image_content( $repeater, false, false );

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

		$repeater->add_control(
			'title_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
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

		$repeater->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
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

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 1,
			'column'         => false,
			'arrows_skin'    => false,
			'progress'       => false
		] );
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
			'selector' => '.oew-item-title',
		], false );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'description',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider'  => true,
			'selector' => '.oew-item-desc',
		], false );

		$this->end_controls_section();
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => false,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_heading_controls();
		$this->add_layout_items_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_heading_controls();
		$this->add_style_items_controls();
		$this->add_style_slider_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		$title_tag       = oew_get_value_in_array( $settings, 'title_tag' );
		$description_tag = oew_get_value_in_array( $settings, 'description_tag' );
		$button_text     = oew_get_value_in_array( $settings, 'button_text' );

		$show_arrows             = oew_get_value_in_array( $settings, 'show_arrows' );
		$pagination              = oew_get_value_in_array( $settings, 'pagination' );
		$speed                   = oew_get_value_in_array( $settings, 'speed' );
		$autoplay                = oew_get_value_in_array( $settings, 'autoplay' );
		$autoplay_speed          = oew_get_value_in_array( $settings, 'autoplay_speed' );
		$loop                    = oew_get_value_in_array( $settings, 'loop' );

		$data_slide = array(
			'"slidesToShow": 1',
			'"slidesToScroll": 1',
			'"speed": ' . $speed,
			$loop === 'yes' ? '"infinite": true' : '',
			$autoplay === 'yes' ? '"autoplay": true' : '',
			$autoplay === 'yes' && $autoplay_speed !== '' ? '"autoplaySpeed": ' . $autoplay_speed : '',
			$show_arrows !== '' ? '"arrows": true' : '"arrows": false',
			$pagination === 'bullets' ? '"dots": true' : '',
			'"centerMode": true',
			'"centerPadding": "200px"',
			'"responsive": [{ "breakpoint": 1024, "settings": {"centerPadding": "100px"} },{ "breakpoint": 767, "settings": {"centerMode": false,"centerPadding": "0"} }]'
		);

		$slide_attributes = "data-slick='{" . implode( ',', $data_slide ) . "}'";

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-widget-collection-carousel',
		);

		$html   = array();
		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';
		$html[] = oew_render_heading_title( $settings );

		if ( $items ) {
			$html[] = '<div class="oew-slick" ' . $slide_attributes . '>';
			foreach ( $items as $item ) {
				$id          = oew_get_value_in_array( $item, '_id' );
				$image       = oew_get_value_in_array( $item, 'image' );
				$title       = oew_get_value_in_array( $item, 'title' );
				$description = oew_get_value_in_array( $item, 'description' );
				$button_link = oew_get_value_in_array( $item, 'button_link' );

				$button  = array(
					$button_link['url'] !== '' ? 'href="' . $button_link['url'] . '"' : '',
					$button_link['is_external'] === 'on' ? 'target="_blank"' : '',
					$button_link['nofollow'] === 'on' ? 'rel="nofollow"' : '',
					$button_link['custom_attributes'] !== '' ? $button_link['custom_attributes'] : '',
				);
				$classes = array(
					'oew-item-content',
					'elementor-repeater-item-' . $id,
				);

				$html[] = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';

				$html[] = '<div class="oew-item-media">';
				$html[] = $button_link ? '<a ' . implode( ' ', array_filter( $button ) ) . '>' : '';
				$html[] = '<img src="' . oew_get_value_in_array( $image, 'url' ) . '">';
				$html[] = $button_link ? '</a>' : '';
				$html[] = '</div>';

				$html[] = '<div class="oew-item-content">';
				if ( $title ) {
					$html[] = '<' . $title_tag . ' class="oew-item-title">';
					$html[] = $button_link ? '<a ' . implode( ' ', array_filter( $button ) ) . '>' . $title . '</a>' : '<span>' . $title . '</span>';
					$html[] = '</' . $title_tag . '>';
				}
				$html[] = $description ? '<' . $description_tag . ' class="oew-item-desc">' . $description . '</' . $description_tag . '>' : '';
				if ( $button_text && $button_link['url'] !== '' ) {
					$html[] = '<div class="oew-default-btn">';
					$html[] = '<a ' . implode( ' ', array_filter( $button ) ) . ' role="button">';
					$html[] = '<span class="oew-button-text">' . esc_attr( $button_text ) . '</span>';
					$html[] = '</a>';
					$html[] = '</div>';
				}
				$html[] = '</div>';

				$html[] = '</div>';
			}
			$html[] = '</div>';
		}

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));

	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Collection_Carousel() );