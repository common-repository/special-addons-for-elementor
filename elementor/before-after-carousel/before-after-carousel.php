<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 30/08/2021
 * Time: 10:25 CH
 */

use Elementor\Group_Control_Image_Size;

class Oew_Before_After_Carousel extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'oew-before-after-carousel', OEW_ELEMENTOR_WIDGET_ELEMENTOR_URL . 'before-after-carousel/js/before-after-carousel.js', [ 'elementor-frontend' ], OEW_PLUGIN_VERSION, true );
//		wp_register_script( 'script-handle', 'path/to/file.js', [ 'elementor-frontend' ], '1.0.0', true );
		wp_enqueue_script( 'oew-script', OEW_ELEMENTOR_WIDGET_DIR_URL . 'assets/js/script.js', [ 'elementor-frontend' ], OEW_PLUGIN_VERSION, true );
	}

	public function get_name() {
		return 'oew-before-after-carousel';
	}

	public function get_title() {
		return esc_html__( 'Before After Carousel', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-image-before-after oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'oew-slick-script', 'oew-script', 'oew-before-after-carousel' ];
	}

	public function get_style_depends() {
		return [ 'oew-before-after-carousel' ];
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
			'before_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'before_text',
			[
				'label'   => esc_html__( 'Before Text', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Before', 'ocanus-elementor-widgets' )
			]
		);

		$this->add_control(
			'after_text',
			[
				'label'   => esc_html__( 'After Text', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'After', 'ocanus-elementor-widgets' )
			]
		);

		$this->add_control(
			'number_slide',
			[
				'label'   => esc_html__( 'Number Slide', 'ocanus-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '5'
			]
		);

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

		$repeater->add_control(
			'before_image',
			[
				'label' => esc_html__( 'Before Image', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'before_image',
				'default'   => 'full',
				'separator' => 'none',
			]
		);

		$repeater->add_control(
			'after_image',
			[
				'label' => esc_html__( 'After Image', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'after_image',
				'default'   => 'full',
				'separator' => 'none',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'item_list',
			[
				'label'  => __( 'Table List', 'ocanus-elementor-widgets' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function add_layout_slider_controls() {
		oew_elementor_option_slider_content( $this, [
			'label'          => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'slides_default' => 4,
			'column'         => true,
			'arrows_skin'    => true,
			'progress'       => true
		] );
	}

	protected function add_style_slider_controls() {
		oew_elementor_option_slider_style( $this, [
			'name'             => 'slider',
			'label'            => esc_html__( 'Slider', 'ocanus-elementor-widgets' ),
			'position_arrow'   => false,
			'background_arrow' => true,
		] );
	}

	protected function register_controls() {
		//== [ Content Tab ]
		$this->add_layout_content_controls();
		$this->add_layout_items_controls();
		$this->add_layout_slider_controls();

		//== [ Style Tab ]
		$this->add_style_slider_controls();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$table_list = $settings['item_list'];

		$before_text = oew_get_value_in_array( $settings, 'before_text' );
		$after_text  = oew_get_value_in_array( $settings, 'after_text' );

		$slide_attributes = "data-slick='{" . oew_render_data_slider( $this, true ) . "}'";

		$ID         = 'oew-before-after-carousel-' . $this->get_id();
		$class_atts = array(
			'oew-elementor-widget',
			'oew-elementor-widget-' . $this->get_id(),
			'oew-elementor-before-after-carousel',
		);

		$html   = array();
		$html[] = '<div id="' . $ID . '" class="' . implode( ' ', $class_atts ) . '"><div class="oew-elementor-inner">';

		$html[] = oew_render_heading_title( $settings );
		if ( ! empty( $table_list ) ) {
			$html[] = '<div class="oew-slick-style">';
			$html[] = '<div class="oew-items oew-slick" ' . $slide_attributes . '>';
			foreach ( $table_list as $table ) {
				$title        = oew_get_value_in_array( $table, 'title' );
				$before_image = oew_get_value_in_array( $table, 'before_image' );
				$after_image  = oew_get_value_in_array( $table, 'after_image' );

				$html[] = '<div class="oew-item">';
				$html[] = '<div class="item-content">';

				$html[] = '<div class="weeks-block acne-treatment">';
				$html[] = '<div>' . esc_attr( $before_text ) . '</div><div>' . esc_attr( $after_text ) . '</div>';
				$html[] = '</div>';

				$html[] = '<div class="before-after-block">';
				$html[] = '<div class="before-after-container left">';
				$html[] = '<img src="' . oew_image_resize( oew_get_value_in_array( $before_image, 'url' ), 300, 300 ) . '" alt="image-' . oew_get_value_in_array( $before_image, 'id' ) . '">';
//				$html[] = Group_Control_Image_Size::get_attachment_image_html( $table, 'before_image' );
				$html[] = '</div>';
				$html[] = '<div class="before-after-container right">';
				$html[] = '<img src="' . oew_image_resize( oew_get_value_in_array( $after_image, 'url' ), 300, 300 ) . '" alt="image-' . oew_get_value_in_array( $after_image, 'id' ) . '">';
//				$html[] = Group_Control_Image_Size::get_attachment_image_html( $table, 'after_image' );
				$html[] = '</div>';
				$html[] = '</div>';

				if ( $title ) {
					$html[] = '<div class="name-block">';
					$html[] = '<p class="name">' . esc_attr( $title ) . '</p>';
					$html[] = '</div>';
				}

				$html[] = '</div>';
				$html[] = '</div>';
			}
			$html[] = '</div>';

			$html[] = oew_render_slider_ui_control( [
				'layout'     => 'pagination',
				'pagination' => oew_get_value_in_array( $settings, 'pagination' )
			] );
			$html[] = oew_render_slider_ui_control( [
				'layout'     => 'navigation',
				'navigation' => oew_get_value_in_array( $settings, 'show_arrows' )
			] );

			$html[] = '</div>';
		}

		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}

	public function content_template() { ?>
        <# var id = '<?php echo $this->get_id(); ?>'; #>
        <# ( function( $ ) {
        <!--            $('.oew-slick').slick();-->
        }( jQuery ) ); #>
	<?php }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Before_After_Carousel() );