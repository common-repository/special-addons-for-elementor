<?php
/**
 * Created by PhpStorm.
 * User: Mystic
 * Date: 29/08/2021
 * Time: 10:57 CH
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

class Oew_Widget_Step_List extends \Elementor\Widget_Base {
	public function get_name() {
		return 'oew_step_list';
	}

	public function get_title() {
		return esc_html__( 'Step List', 'ocanus-elementor-widgets' );
	}

	public function get_icon() {
		return 'eicon-price-table oew-widget';
	}

	public function get_categories() {
		return [ 'oew-widgets' ];
	}

	public function get_script_depends() {
		return [ 'slick' ];
	}

	public function get_style_depends() {
		return [ 'slick', 'oew-step-list' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_item_general',
			[
				'label' => esc_html__( 'General', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'last_item_price',
			[
				'label' => esc_html__( 'Last Item Price', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'last_item_currency',
			[
				'label' => esc_html__( 'Last Item Currency', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'last_item_date',
			[
				'label' => esc_html__( 'Last Item Date', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'last_item_text',
			[
				'label' => esc_html__( 'Last Item Text', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_content',
			[
				'label' => esc_html__( 'Item', 'ocanus-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'ocanus-elementor-widgets' ),
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
			'desc',
			[
				'label' => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
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

		oew_elementor_option_typo_style( $this, [
			'name'     => 'title',
			'label'    => esc_html__( 'Title', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .item-history .item-title'
		] );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'desc',
			'label'    => esc_html__( 'Description', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .item-history .item-desc'
		] );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'last_item_price',
			'label'    => esc_html__( 'Last Item Price', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .included-number'
		] );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'last_item_currency',
			'label'    => esc_html__( 'Last Item Currency', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .included-sign'
		] );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'last_item_date',
			'label'    => esc_html__( 'Last Item Date', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .included-per-month'
		] );

		oew_elementor_option_typo_style( $this, [
			'name'     => 'last_item_text',
			'label'    => esc_html__( 'Last Item Text', 'ocanus-elementor-widgets' ),
			'divider ' => false,
			'selector' => '.oew-widget-history .included-price-2'
		] );
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$table_list = $settings['item_list'];

		$html = array();

		$html[] = '<div class="oew-widget-elementor oew-widget-history"><div class="oew-inner">';

		$i = 1;

		if ( ! empty( $table_list ) ) {
			$html[] = '<div class="item-histories">';

			foreach ( $table_list as $table ) {
				$html[] = '<div class="item-history">';
				$html[] = '<img class="" src="' . oew_get_value_in_array( $table, 'image' )['url'] . '" style="width: ' . oew_get_value_in_array( $table, 'image_width' ) . 'px"/>';
				$html[] = '<div class="item-title">' . oew_get_value_in_array( $table, 'title' ) . '</div>';
				$html[] = '<div class="item-desc">' . oew_get_value_in_array( $table, 'desc' ) . '</div>';

				$html[] = '<div class="item-count">' . $i . '</div>';
				$html[] = '</div>';

				$i ++;
			}

			$html[] = '</div>';
		}

		//last point
		$html[] = '<div class="item-last">';
		$html[] = '<div class="horizontal-flex"><p class="included-sign">' . oew_get_value_in_array( $settings, 'last_item_currency' ) . '</p><p class="included-number">' . oew_get_value_in_array( $settings, 'last_item_price' ) . '</p><p class="included-per-month">' . oew_get_value_in_array( $settings, 'last_item_date' ) . '</p></div>';
		$html[] = '<p class="included-price-2">' . oew_get_value_in_array( $settings, 'last_item_text' ) . '</p>';
		$html[] = '</div>';


		$html[] = '</div></div>';

        echo implode('', wp_kses_allowed_html($html));
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Oew_Widget_Step_List() );