<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 30/08/2021
 * Time: 5:53 CH
 */

class Oew_Widget_Gallery_Masonry extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_gallery_masonry';
	}

	public function get_title() {
		return esc_html__( 'Gallery Masonry', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-gallery-masonry oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-gallery-masonry' ];
	}

	public function get_style_depends() {
		return [ 'oew-gallery-masonry' ];
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
			'description' => true,
		], false );

		$this->add_control(
			'gallery_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'gallery',
			[
				'label' => __( 'Gallery', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::GALLERY,
			]
		);

		$this->end_controls_section();
	}

	protected function add_content_style_controls() {
		oew_elementor_option_heading_style( $this, [
			'divider'     => false,
			'description' => true,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();

		//== [ Style Tab ]
		$this->add_content_style_controls();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$gallery    = $settings['gallery'];
		$first_item = array_shift( $gallery );
		$first_list = array_slice( $gallery, 0, 6 );
		$last_list  = array_slice( $gallery, 7 );

		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-gallery-masonry',
		);

		$html = array();

		$html[] = '<div class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';
		$html[] = oew_render_heading_title( $settings );

		if ( ! empty( $gallery ) ) {
			//== [ if there are 7 items then show masonry layout ]
			$html[] = '<div class="oew-gallery-wrapper masonry">';
			//== [ First Item ]
			$html[] = '<div class="first-item-image"><div class="item-image">';
			$html[] = '<a href="' . oew_get_value_in_array( $first_item, 'url' ) . '" class="oew-action">';
			$html[] = '<img src="' . oew_get_value_in_array( $first_item, 'url' ) . '" alt="image-' . oew_get_value_in_array( $first_item, 'id' ) . '">';
			$html[] = '</a>';
			$html[] = '</div></div>'; //== [ End First ]

			$html[] = '<div class="list-item-image">';
			foreach ( $first_list as $key => $item ) {
				$classes = array(
					'item-image',
					$key === 1 || $key === 5 ? 'rectangle' : '',
				);
				$html[]  = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';
				$html[]  = '<a href="' . oew_get_value_in_array( $item, 'url' ) . '" class="oew-action">';
				$html[]  = '<img src="' . oew_get_value_in_array( $item, 'url' ) . '" alt="image-' . oew_get_value_in_array( $item, 'id' ) . '">';
				$html[]  = '</a>';
				$html[]  = '</div>';
			}
			$html[] = '</div>'; //== [ End List Item ]
			$html[] = '</div>';

			//== [ if more than 7 items then show layout grid ]
			if ( ! empty( $last_list ) ) {
				$html[] = '<div class="oew-gallery-wrapper grid">';
				foreach ( $last_list as $item ) {
					$classes = array(
						'item-image',
					);
					$html[]  = '<div class="' . implode( ' ', array_filter( $classes ) ) . '">';
					$html[]  = '<a href="' . oew_get_value_in_array( $item, 'url' ) . '" class="oew-action">';
					$html[]  = '<img src="' . oew_get_value_in_array( $item, 'url' ) . '" alt="image-' . oew_get_value_in_array( $item, 'id' ) . '">';
					$html[]  = '</a>';
					$html[]  = '</div>';
				}
				$html[] = '</div>';
			}
		}

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Gallery_Masonry() );